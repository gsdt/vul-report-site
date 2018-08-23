<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 21/08/2018
 * Time: 22:00
 */

class VulnerableModel extends Model
{
    function create_vulnerable($name, $description, $level, $report_id) {
        $sql = "INSERT INTO vulnerable (name, description, level, report_id) VALUES (:name, :description, :level, :report_id)";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':description'=>$description, ':level' => $level, ':report_id'=>$report_id);
        $query->execute($parameters);
    }

    function get_vulnerable($report_id) {
        $sql = "SELECT * FROM vulnerable WHERE report_id = :report_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':report_id' => $report_id);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    function delete_vulnerable($report_id) {
        $sql = "DELETE FROM vulnerable WHERE report_id=:report_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':report_id' => $report_id);
        $query->execute($parameters);
    }
}