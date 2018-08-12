<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 09/08/2018
 * Time: 11:43
 */

class ValidateUser
{
    public function is_logged_in()
    {
        if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
            if (in_array($_SESSION['role'], array('admin', 'user'))) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function is_admin()
    {
        if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
            if (in_array($_SESSION['role'], array('admin'))) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function is_valid_username($username)
    {
        if (preg_match('/^\w{5,}$/', $username)) { // \w equals "[0-9A-Za-z_]"
            return true;
        }
        return false;
    }

    public function check_password_strength($password)
    {
        return strlen($password) >= MIN_PASS_LEN;
    }

    public function is_valid_email($email)
    {
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
            $emailB != $email
        ) {
            return false;
        }
        return true;
    }
}