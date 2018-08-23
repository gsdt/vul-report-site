<?php
class UserReportModel extends Model {
    public function create_relation($user_id, $report_id, $status){
        $sql = "INSERT INTO user_report (user_id, report_id, status) VALUES (:user_id, :report_id, :status)";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':report_id' => $report_id, ':status' => $status);
        $query->execute($parameters);
    }

    public function get_inbox_paging($user_id, $limit, $offset) {
        $sql = "SELECT * from user_report WHERE user_id=:user_id AND (status='RECIVED' OR status='SEEN') ORDER BY id DESC LIMIT $limit OFFSET $offset";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function get_outbox_paging($user_id, $limit, $offset) {
        $sql = "SELECT * from user_report WHERE user_id=:user_id AND status='SENT' ORDER BY id DESC LIMIT $limit OFFSET $offset";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function delete_relation($user_id, $report_id, $status) {
        $sql = "DELETE FROM user_report WHERE user_id=:user_id AND status=:status AND report_id=:report_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':status'=>$status, ':report_id'=>$report_id);
        $query->execute($parameters);
    }

    public function change_status($user_id, $report_id, $new_status) {
        $sql = "UPDATE user_report SET status = :new_status WHERE user_id = :user_id AND report_id=:report_id AND status='RECIVED'";
        $query = $this->db->prepare($sql);
        $parameters = array(':new_status'=>$new_status, ':user_id'=>$user_id, ':report_id'=>$report_id);

        $query->execute($parameters);
    }
}
?>