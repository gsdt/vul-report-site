<?php
require_once APP . 'core/Model.php';
define('MIN_PASS_LEN', 6);

class UserModel extends Model
{
    public function get_user_by($field, $value)
    {
        $sql = "SELECT id, username, password, email, roles, date_modified FROM users WHERE $field = :value";
        $query = $this->db->prepare($sql);
        $parameters = array(':value' => $value);

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function add_user($username, $password, $email)
    {
        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT), ':email' => $email);

        $query->execute($parameters);
    }

    public function update_user($username, $password, $role, $email)
    {
        $sql = "UPDATE users SET password = :password, roles = :role, email = :email, date_modified = now() WHERE username = :username";
        $query = $this->db->prepare($sql);
        $parameters = array(':password' => $password, ':role' => $role, ':email' => $email, ':username' => $username);

        $query->execute($parameters);
    }

    public function remove_user_by($field, $value)
    {
        $sql = "DELETE FROM users WHERE $field = :value";
        $query = $this->db->prepare($sql);
        $parameters = array(':value' => $value);

        $query->execute($parameters);
    }

    public function get_user_paging($limit, $offset)
    {
        $sql = "SELECT * FROM users ORDER BY roles LIMIT $limit OFFSET $offset";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function count_user()
    {
        $sql = "SELECT COUNT(id) AS amount_of_users FROM users";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_users;
    }
}

?>