<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 08/08/2018
 * Time: 21:01
 */

class Model
{
    protected $db;

    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            require APP . 'controllers/error.php';
            $page = new Errors();
            $page->error_message = 'Database problem: ' . $e->getMessage();
            $page->index();
        }
    }
}

?>