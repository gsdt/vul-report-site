<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 10/08/2018
 * Time: 10:35
 */
require_once APP.'core/Controller.php';
require_once APP.'models/UserModel.php';
require_once APP.'libs/ValidateUser.php';
class profile extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ValidateUser();
        $this->model = new UserModel($this->db);
    }

    private function update_profile($user) {
        if(isset($_POST['newpassword']) || isset($_POST['email'])) {
            // to do this function, user must be provide password except admin
            if(!$this->validator->is_admin() && empty($_POST['oldpassword'])){
                return 'You must be provide current password.';
            }
            // admin account always provide password
            if($user->roles === 'admin' && empty($_POST['oldpassword'])){
                return 'You must be provide current password.';
            }
            if(!$this->validator->is_admin() && !password_verify($_POST['oldpassword'], $user->password)){
                return 'Incorrect password.';
            }
            if(!$this->validator->is_valid_email($_POST['email'])){
                return 'Invalid email address.';
            }
            if(isset($_POST['delete'])) {   // user click delete button
                try {
                    $this->model->remove_user_by('id', $user->id);
                } catch (Exception $e) {
                    return $e->getMessage();
                }
                // if user delete themself. Logout
                if($user->id === $_SESSION['id']) header('Location: logout');
                return 'success';
            }
            // check if user want to change password
            if(!empty($_POST['newpassword'])) {
                if($_POST['newpassword'] != $_POST['repassword']) {
                    return 'Those passwords doesn\'t match.';
                }
                if(!$this->validator->check_password_strength($_POST['newpassword'])) {
                    return 'Use '.MIN_PASS_LEN.' characters or more for your password.';
                }
            }
            if(isset($_POST['update'])) {   // user click Update button
                try {
                    if (!empty($_POST['newpassword'])) {
                        $this->model->update_user($user->username, password_hash($_POST['newpassword'], PASSWORD_DEFAULT), $user->roles, $_POST['email']);
                    } else {
                        $this->model->update_user($user->username, $user->password, $user->roles, $_POST['email']);
                    }
                } catch (Exception $e) {
                    return $e->getMessage();
                }
                return 'success';
            }

        }
        return null;
    }

    public function update() {
        if(!$this->validator->is_logged_in()) {
            header('Location: login');
        }
        if(!isset($_GET['id'])) {
            $this->view->error_message = "Invalid request.";
            $this->view->render('error/index');
            return;
        }
        $user = $this->model->get_user_by('id', $_GET['id']);
        if(!isset($user->id)) {
            $this->view->error_message = "This user ID don't exist.";
            $this->view->render('error/index');
            return;
        }
        if(!$this->validator->is_admin() && $user->username!=$_SESSION['username']){
            $this->view->error_message = "You don't have permission.";
            $this->view->render('error/index');
            return;
        }

        $this->view->status = $this->update_profile($user);
        $this->view->user = $user;
        $this->view->render('profile/index');
    }
}