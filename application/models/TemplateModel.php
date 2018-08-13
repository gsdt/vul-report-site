<?php
require_once APP . 'core/Model.php';

class TemplateModel extends Model
{
//    public function get_user_by($field, $value)
//    {
//        $sql = "SELECT id, username, password, email, roles, date_modified FROM users WHERE $field = :value";
//        $query = $this->db->prepare($sql);
//        $parameters = array(':value' => $value);
//
//        $query->execute($parameters);
//
//        // fetch() is the PDO method that get exactly one result
//        return $query->fetch();
//    }
//
    public function create_template($author_id, $name, $description)
    {
        $sql = "INSERT INTO template (name, description, author_id) VALUES (:name, :description, :author_id)";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':description' => $description, ':author_id' => $author_id);

        $query->execute($parameters);
    }
//
//    public function update_user($username, $password, $role, $email)
//    {
//        $sql = "UPDATE users SET password = :password, roles = :role, email = :email, date_modified = now() WHERE username = :username";
//        $query = $this->db->prepare($sql);
//        $parameters = array(':password' => $password, ':role' => $role, ':email' => $email, ':username' => $username);
//
//        $query->execute($parameters);
//    }
//
    public function remove_template($author_id, $template_id)
    {
        $sql = "DELETE FROM template WHERE author_id = :author_id AND id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':author_id' => $author_id, 'id' => $template_id);

        $query->execute($parameters);
    }

    public function get_template_paging($user_id, $limit, $offset)
    {
        $sql = "SELECT * FROM template WHERE author_id=:author_id LIMIT $limit OFFSET $offset";
        $query = $this->db->prepare($sql);
        $parameters = array(':author_id' => $user_id);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function get_template($user_id, $template_id)
    {
        $sql = "SELECT * FROM template WHERE author_id=:author_id AND id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':author_id' => $user_id, ':id' => $template_id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function update_template($id, $name, $description)
    {
        $sql = "UPDATE template SET name = :name, description = :description, date_modified = now() WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':description' => $description, ':id' => $id);

        $query->execute($parameters);
    }

    public function count_template($author_id)
    {
        $sql = "SELECT COUNT(id) AS amount_of_template FROM template WHERE author_id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $author_id);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_template;
    }
}

?>