<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 10/08/2018
 * Time: 10:35
 */
require_once APP . 'core/Controller.php';
require_once APP . 'models/UserModel.php';
require_once APP . 'libs/ValidateUser.php';

class report extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ValidateUser();
        $this->model = new UserModel($this->db);
    }

    public function index()
    {
        // check login status
        if(!$this->validator->is_logged_in()) {
            header('Location: /');
        }
        $this->view->render("report/index");
    }
}