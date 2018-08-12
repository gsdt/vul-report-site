<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 08/08/2018
 * Time: 20:26
 */
require_once APP . 'core/Controller.php';
require_once APP . 'models/UserModel.php';
require_once APP . 'libs/ValidateUser.php';

class register extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ValidateUser();
        $this->model = new UserModel($this->db);
    }

    private function register()
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['email'])) {
            if (!$this->validator->is_valid_username($_POST['username'])) {
                return 'Invalid username (^\w{5,}$).';
            }
            if (!$this->validator->check_password_strength($_POST['password'])) {
                return 'Use ' . MIN_PASS_LEN . ' characters or more for your password.';
            }
            if ($_POST['password'] != $_POST['repassword']) {
                return 'Those passwords doesn\'t match';
            }
            if (!$this->validator->is_valid_email($_POST['email'])) {
                return 'Invalid email address';
            }

            $user = $this->model->get_user_by('username', $_POST['username']);
            if (isset($user->username)) {
                return 'This username has been used.';
            }

            $user = $this->model->get_user_by('email', $_POST['email']);
            if (isset($user->username)) {
                return 'This email is used.';
            }

            try {
                $this->model->add_user($_POST['username'], $_POST['password'], $_POST['email']);
                return 'success';
            } catch (Exception $e) {
                return $e->getMessage();
            }

        }
        return 'none';
    }

    public function index()
    {
        if ($this->validator->is_logged_in()) {
            $this->view->error_message = 'You have logged in.';
            $this->view->render('error/index');
        } else {

            $status = $this->register();
            if ($status === 'success') {
                $this->view->render('register/success');
            } elseif ($status === 'none') {
                $this->view->render('register/index');
            } else {
                $this->view->error_message = $status;
                $this->view->render('register/index');
            }
        }
    }
}