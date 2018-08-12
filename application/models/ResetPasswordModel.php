<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 11/08/2018
 * Time: 07:43
 */
require_once APP . 'core/Model.php';
require_once APP . 'models/UserModel.php';

class ResetPasswordModel extends Model
{
    public function add($username, $email, $token, $validator)
    {
        $sql = "INSERT INTO reset_password (username, email, token, validator) VALUES (:username, :email, :token, :validator)";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username, ':email' => $email, ':token' => $token, ':validator' => $validator);

        $query->execute($parameters);
    }

    public function select_by($field, $value)
    {
        $sql = "SELECT username, email, token, validator, date_created FROM reset_password WHERE $field = :value";
        $query = $this->db->prepare($sql);
        $parameters = array(':value' => $value);

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function remove_by_validator($validator)
    {
        $sql = "DELETE FROM reset_password WHERE validator = :validator";
        $query = $this->db->prepare($sql);
        $parameters = array(':validator' => $validator);

        $query->execute($parameters);
    }
}