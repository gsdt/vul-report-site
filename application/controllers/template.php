<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 12/08/2018
 * Time: 20:16
 */
require_once APP . 'core/Controller.php';
require_once APP . 'models/UserModel.php';
require_once APP . 'models/TemplateModel.php';
require_once APP . 'libs/ValidateUser.php';

class template extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ValidateUser();
        $this->userModel = new UserModel($this->db);
        $this->templateModel = new TemplateModel($this->db);
    }

    private function get_page()
    {
        $page = 0;
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = (int)$_GET['page'];
        }
        return $page;
    }

    public function index()
    {
        if (!$this->validator->is_logged_in()) {
            header('Location: /login');
        }
        $user = $this->userModel->get_user_by('id', $_SESSION['id']);
        $page = $this->get_page();
        $this->view->current_page = $page;
        $this->view->max_page = max(0, ($this->templateModel->count_template($_SESSION['id']) - 1) / 10);
        if ($this->view->current_page > $this->view->max_page) {
            $this->view->error_message = "Out of range.";
            $this->view->render('error/index');
            return;
        }
        $this->view->data = $this->templateModel->get_template_paging($user->id, 10, $page * 10);
        $this->view->render('vul_template/index');
    }

    public function update()
    {
        if (!$this->validator->is_logged_in()) {
            echo "You are not login. <a href='/login'>Click here to login</a>";
            return;
        }
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'update' && !empty($_POST['id'])) {
                $user = $this->userModel->get_user_by('id', $_SESSION['id']);
                $template = $this->templateModel->get_template($user->id, $_POST['id']);
                if (!isset($template->id)) {
                    die("This template don't exist or you don't have permission.");
                }
                try {
                    $this->templateModel->update_template($_POST['id'], $_POST['name'], $_POST['description']);
                    exit('success');
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            if ($_POST['action'] === 'create') {
                try {
                    $this->templateModel->create_template($_SESSION['id'], $_POST['name'], $_POST['description']);
                    exit('success');
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        }
    }
}