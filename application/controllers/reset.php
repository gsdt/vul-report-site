<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 10/08/2018
 * Time: 18:49
 */
require_once APP . 'core/Controller.php';
require_once APP . 'models/UserModel.php';
require_once APP . 'models/ResetPasswordModel.php';
require_once APP . 'libs/ValidateUser.php';
class reset extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel($this->db);
        $this->resetModel = new ResetPasswordModel($this->db);
        $this->validator = new ValidateUser();
    }

    private function send_reset_email() {
        if(!isset($_POST['email'])) {
            return;
        }
        if(!$this->validator->is_valid_email($_POST['email'])){
            return 'Invalid email address.';
        }
        $user = $this->userModel->get_user_by('email', $_POST['email']);
        if(isset($user->username)){
            $token = bin2hex(random_bytes(30));
            $validator = bin2hex(random_bytes(30));
            $this->resetModel->add($user->username, $user->email, $token, $validator);
            $cmd = APP.'libs/send.py '.$user->email." ".$user->username." ".$token." &";
            exec($cmd);
        }

        return 'success';
    }

    private function is_expried($time) {


        $now = new DateTime('-1hours');
        return $now>$time;
    }

    public function index() {
        if($this->validator->is_logged_in()) {
            $this->view->error_message = 'You have logged in.';
            $this->view->render('error/index');
        }
        else {
            $status = $this->send_reset_email();
            if(isset($status)) {
                if($status === 'success') {
                    $this->view->render('reset/request_success');
                }
                else {
                    $this->view->status = $status;
                    $this->view->render('reset/index');
                }
            }
            else {
                $this->view->render('reset/index');
            }
        }
    }

    public function reset() {
        if($this->validator->is_logged_in()) {
            $this->view->error_message = 'You have logged in.';
            $this->view->render('error/index');
        }
        else {
            if(!isset($_GET['token'])){
                $_GET['token'] = 'none';
            }
            $reseter = $this->resetModel->select_by('token', $_GET['token']);
            if(!isset($reseter->username)){
                $this->view->error_message = "Your token is invalid or expried.";
                $this->view->render('error/index');
            }
            else {
                $user = $this->userModel->get_user_by('email', $reseter->email);

                if (!isset($user->username) || $user->username != $reseter->username
                    || $this->is_expried(new DateTime($reseter->date_created))) {
                    $this->view->error_message = "Your token is invalid or expried.";
                    $this->view->render('error/index');
                } else {
                    $this->view->status = $this->change_password();
                    if ($this->view->status === 'success') {
                        $this->view->render('reset/changed_success');
                    } else {
                        $this->view->reseter = $reseter;
                        $this->view->render('reset/change_password');
                    }
                }
            }
        }

    }

    private function change_password() {
        if(!isset($_POST['newpassword']) || !isset($_POST['repassword']) || !isset($_POST['validator'])){
            return;
        }

        $reseter = $this->resetModel->select_by('validator',$_POST['validator']);
        if (!isset($reseter->username)) {
            return 'Your token is invalid or expried';
        }
        $user = $this->userModel->get_user_by('email', $reseter->email);

        if (!isset($user->username) || $user->username != $reseter->username
            || $this->is_expried(new DateTime($reseter->date_created))) {
            return 'Your token is invalid or expried';
        }

        if($_POST['newpassword']!=$_POST['repassword']) {
            return 'Those passwords doesn\'t match';
        }

        if(!$this->validator->check_password_strength($_POST['newpassword'])){
            return 'Use '.MIN_PASS_LEN.' characters or more for your password.';
        }

        try {
            $this->userModel->update_user($user->username, password_hash($_POST['newpassword'], PASSWORD_DEFAULT), $user->roles, $user->email);
            $this->resetModel->remove_by_validator($reseter->validator);
        }
        catch (Exception $e) {
            return $e->getMessage();
        }

        return 'success';
    }
}