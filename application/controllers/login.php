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

class login extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel($this->db);
        $this->validator = new ValidateUser();
    }

    private function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->get_user_by('username', $username);
            if (isset($user->username) && $user->roles != 'banned' && password_verify($password, $user->password)) {
                return $user;
            }
            return 'fail';
        }
        return 'none';
    }

    public function index()
    {
        if ($this->validator->is_logged_in()) {
            $this->view->error_message = 'You have logged in.';
            $this->view->render('error/index');
        } else {
            $status = $this->login();
            if ($status === 'fail') {
                $this->view->error_msg = "Wrong username or password.";
                $this->view->render('login/index');
            } elseif ($status === 'none') {
                $this->view->render('login/index');
            } else {
                $_SESSION['username'] = $status->username;
                $_SESSION['role'] = $status->roles;
                $_SESSION['id'] = $status->id;
                header('Location: /');
            }
        }
    }
}