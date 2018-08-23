<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 10/08/2018
 * Time: 10:35
 */
require_once APP . 'core/Controller.php';
require_once APP . 'models/UserModel.php';
require_once APP . 'models/TemplateModel.php';
require_once APP . 'models/VulnerableModel.php';
require_once APP . 'models/ReportModel.php';
require_once APP . 'models/UserReportModel.php';
require_once APP . 'libs/ValidateUser.php';

class report extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ValidateUser();
        $this->userModel = new UserModel($this->db);
        $this->templateModel = new TemplateModel($this->db);
        $this->vulnerableModel = new VulnerableModel($this->db);
        $this->reportModel = new ReportModel($this->db);
        $this->userReportModel = new UserReportModel($this->db);
    }

    public function hint() {
        header('Content-Type: application/json');
        if(!$this->validator->is_logged_in()) {
            return;
        }
        if(isset($_POST['text'])) {
            echo json_encode($this->templateModel->search_template($_POST['text'], $_SESSION['id']));
            return;
        }
    }


    public function create() {
        header('Content-Type: application/json');
        if(!$this->validator->is_logged_in()) {
            return;
        }

        $res = new stdClass();

        // check all easy fail case
        $res->status = 'fail';
        if(!isset($_POST['report_name']) || empty($_POST['report_name'])) {
            $res->message = 'You must provide report name';
            exit(json_encode($res));
        }
        if(!isset($_POST['report_target']) || empty($_POST['report_target'])) {
            $res->message = 'You must provide report target';
            exit(json_encode($res));
        }
        if(!isset($_POST['report_recipient']) || empty($_POST['report_recipient'])) {
            $res->message = 'You must provide report recipient';
            exit(json_encode($res));
        }
        if(!isset($_POST['vulnerables']) || empty($_POST['vulnerables'])) {
            $res->message = 'You must provide at least one vulnerable';
            exit(json_encode($res));
        }
        foreach ($_POST['vulnerables'] as $vul) {
            if(empty($vul['name'])) {
                $res->message = 'You must provide vulnerable name';
                exit(json_encode($res));
            }
        }

        // check valid data
        $recipient = $this->userModel->get_user_by('username', $_POST['report_recipient']);
        if(empty($recipient)) {
            $res->message = 'User <code>'.$_POST['report_recipient'].'</code> does not exist.';
            exit(json_encode($res));
        }
        try {
            $sender = $this->userModel->get_user_by('id', $_SESSION['id']);
            $report_id = $this->reportModel->create_report($_POST['report_name'], $_POST['report_target'], $sender->id, $recipient->id, 'SENT');
            foreach ($_POST['vulnerables'] as $vul) {
                $this->vulnerableModel->create_vulnerable($vul['name'], $vul['description'], $vul['level'], $report_id);
            }
            $this->userReportModel->create_relation($sender->id, $report_id, 'SENT');
            $this->userReportModel->create_relation($recipient->id, $report_id, 'RECIVED');
        }
        catch (Exception $e) {
            $res->status = 'fail';
            $res->message = $e->getMessage();
            exit(json_encode($res));

        }
        $res->status = 'done';
        $res->message = 'Action success.';
        exit(json_encode($res));
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