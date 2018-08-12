<?php
/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 08/08/2018
 * Time: 19:38
 */

require APP . 'config/config.php';
require APP . 'core/View.php';

class Application
{
    public static function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $element = parse_url($uri);

        $path = $element['path'];
        $path = trim($path, '/');
        if (isset($element['query'])) {
            $query = $element['query'];
            parse_str($query, $param);
        } else {
            $query = array();
        }
        if ($path === '') {
            require APP . 'controllers/home.php';
            $page = new home();
            $page->index();
        } else {
            $file = APP . 'controllers/' . $path . '.php';
            if (file_exists($file)) {
                require $file;
                $controler = new $path();
                if (isset($param['action'])) {
                    $method = $param['action'];
                    if (method_exists($controler, $method) && is_callable(array($controler, $method))) {
//                        call_user_func_array(array($controler, $method), array($param));
                        $controler->$method();
                    } else {
                        $page = new View();
                        $page->error_message = "Action <code>$method</code> is invalid.";
                        $page->render('error/index');
                    }
                } else {
                    $controler->index();
                }
            } else {
                $page = new View();
                $page->error_message = "Page <code>$path</code> not found!";
                $page->render('error/index');
            }
        }

    }
}