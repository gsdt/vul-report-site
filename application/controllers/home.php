<?php

require_once APP . 'core/Controller.php';
require_once APP . 'models/UserModel.php';
require_once APP . 'models/TemplateModel.php';
require_once APP . 'models/VulnerableModel.php';
require_once APP . 'models/ReportModel.php';
require_once APP . 'models/UserReportModel.php';
require_once APP . 'libs/ValidateUser.php';

class home extends Controller
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

    public function inbox() {
        header('Content-Type: application/json');

        if (!$this->validator->is_logged_in()) {
            die('permision denied');
        }
        $limit = 10;
        $offset = 0;
        if(isset($_GET['page'])) {
            $offset = $limit * (int)$_GET['page'];
        }

        $reports_id_list = $this->userReportModel->get_inbox_paging($_SESSION['id'], $limit, $offset);
        $reports = array();
        foreach ($reports_id_list as $e) {
            $report =  $this->reportModel->select_report_by('id', $e->report_id);
            $report->status = $e->status;
            array_push($reports, $report);
        }
        foreach ($reports as $e) {
            $e->user = $this->userModel->get_user_by('id',$e->author_id)->username;
        }

        $result = new stdClass();
        $result->total_pages = intdiv($this->reportModel->count_report('recipient_id', $_SESSION['id'])-1, $limit) + 1;//)/;
        $result->reports = $reports;
        exit(json_encode($result));
    }

    public function outbox() {
        header('Content-Type: application/json');

        if (!$this->validator->is_logged_in()) {
            die('permision denied');
        }
        $limit = 10;
        $offset = 0;
        if(isset($_GET['page'])) {
            $offset = $limit * (int)$_GET['page'];
        }

        $reports_id_list = $this->userReportModel->get_outbox_paging($_SESSION['id'], $limit, $offset);
        $reports = array();
        foreach ($reports_id_list as $e) {
            $report =  $this->reportModel->select_report_by('id', $e->report_id);
            $report->status = $e->status;
            array_push($reports, $report);
        }
        foreach ($reports as $e) {
            $e->user = $this->userModel->get_user_by('id',$e->recipient_id)->username;
        }

        $result = new stdClass();
        $result->total_pages = intdiv($this->reportModel->count_report('recipient_id', $_SESSION['id'])-1, $limit) + 1;//)/;
        $result->reports = $reports;
        exit(json_encode($result));
    }

    public function read_inbox()
    {
        header('Content-Type: application/json');

        if (!$this->validator->is_logged_in()) {
            die('permision denied');
        }
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            die('invalid request');
        }

        $result = new stdClass();
        $report = $this->reportModel->select_report_by('id', $_GET['id']);
        if(empty($report)) {
            die('report not found');
        }
        if($report->recipient_id != $_SESSION['id']){
            die('permision denied');
        }
        $result->report_id = $report->id;
        $result->report_name = $report->name;
        $result->report_target = $report->target;
        $result->report_author = $this->userModel->get_user_by('id', $report->author_id)->username;
        $result->report_recipient = $this->userModel->get_user_by('id', $report->recipient_id)->username;
        $result->vulnerable = $this->vulnerableModel->get_vulnerable($report->id);

        $this->userReportModel->change_status($_SESSION['id'], $report->id, 'SEEN');

        exit(json_encode($result));
    }

    public function read_outbox()
    {
        header('Content-Type: application/json');

        if (!$this->validator->is_logged_in()) {
            die('permision denied');
        }
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            die('invalid request');
        }

        $result = new stdClass();
        $report = $this->reportModel->select_report_by('id', $_GET['id']);
        if(empty($report)) {
            die('report not found');
        }
        if($report->author_id != $_SESSION['id']){
            die('permision denied');
        }
        $result->report_id = $report->id;
        $result->report_name = $report->name;
        $result->report_target = $report->target;
        $result->report_author = $this->userModel->get_user_by('id', $report->author_id)->username;
        $result->report_recipient = $this->userModel->get_user_by('id', $report->recipient_id)->username;
        $result->vulnerable = $this->vulnerableModel->get_vulnerable($report->id);

        exit(json_encode($result));
    }

    public function delete() {
//        header('Content-Type: application/json');

        if (!$this->validator->is_logged_in()) {
            die('permision denied');
        }
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            die('invalid request');
        }
        if(!isset($_GET['type']) || empty($_GET['type'])) {
            die('invalid request');
        }

        if($_GET['type'] === 'inbox') {
            $this->userReportModel->delete_relation($_SESSION['id'], $_GET['id'], 'SEEN');
        }
        else if($_GET['type'] ===  'outbox') {
            $this->userReportModel->delete_relation($_SESSION['id'], $_GET['id'], 'SENT');
        }
        else {
            die('invalid request');
        }
        die('success');
    }

    public function index()
    {
        if (!$this->validator->is_logged_in()) {
            header('Location: login');
        }
        $this->view->render('home/index');
    }
}

?>