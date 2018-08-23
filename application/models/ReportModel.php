<?php
class ReportModel extends Model {
    public function create_report($name, $target, $author_id, $recipient_id)
    {
        $sql = "INSERT INTO report (name, target, author_id, recipient_id) VALUES (:name, :target, :author_id, :recipient_id)";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':target' => $target, ':author_id' => $author_id, ':recipient_id' => $recipient_id);
        $query->execute($parameters);
        return $this->db->lastInsertId();
    }

    public function select_report_by($field, $value) {
        $sql = "SELECT * FROM report WHERE $field = :value";
        $query = $this->db->prepare($sql);
        $parameters = array(':value' => $value);

        $query->execute($parameters);
        return $query->fetch();
    }

    public function select_report_paging($person, $user_id, $limit, $offset){
        $sql = "SELECT * FROM report WHERE $person=:user_id LIMIT $limit OFFSET $offset";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function count_report($person, $user_id) {
        $sql = "SELECT COUNT(id) AS amount_of_report FROM report where $person=:user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query->execute($parameters);
        return $query->fetch()->amount_of_report;
    }

    public function delete_report($report_id) {
        $sql = "DELETE FROM report WHERE id=:report_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':report_id' => $report_id);
        $query->execute($parameters);
    }
}
?>