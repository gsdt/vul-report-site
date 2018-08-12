<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 08/08/2018
 * Time: 19:07
 */

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

require(APP.'/core/Application.php');

session_start();
Application::run();

?>