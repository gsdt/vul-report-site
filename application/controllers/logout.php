<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 08/08/2018
 * Time: 20:26
 */
require_once APP . 'core/Controller.php';
require_once APP . 'core/View.php';
require_once APP . 'models/UserModel.php';
require_once APP . 'libs/ValidateUser.php';

class logout extends Controller
{
    public function index()
    {
        $_SESSION = array();
        session_destroy();
        header("Location: login");
    }
}