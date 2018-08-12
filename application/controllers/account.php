<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 08/08/2018
 * Time: 20:26
 */
require_once APP.'core/Controller.php';
require_once APP.'models/UserModel.php';
require_once APP.'libs/ValidateUser.php';

class account extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel($this->db);
        $this->validator = new ValidateUser();
    }

    private function get_data() {
        $page = 0;
        if(isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = (int)$_GET['page'];
        }
        $data = $this->model->get_user_paging(10, $page*10);
        return $data;
    }

    public function index() {
        if(!$this->validator->is_admin()) {
            $this->view->error_message = 'You don\'t have permission.';
            $this->view->render('error/index');
        }
        else {
            $this->view->data = $this->get_data();
            $this->view->render('account/index');
        }
    }
}