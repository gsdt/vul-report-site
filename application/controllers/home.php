<?php
require APP.'libs/ValidateUser.php';
require_once APP.'core/Controller.php';
class home extends Controller {
    public function index() {
        $validator = new ValidateUser();
        if($validator->is_logged_in()){
            $this->view->render('home/index');
        }
        else {
            header('Location: login');
        }
    }
}
?>