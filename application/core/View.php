<?php

/**
 * Created by PhpStorm.
 * User: gsdt
 * Date: 09/08/2018
 * Time: 10:27
 */
class View
{
    public function render($name)
    {
        require APP . 'views/template/heading.php';
        require APP . 'views/template/menu-bar.php';
        require APP . 'views/' . $name . '.php';
        require APP . 'views/template/footer.php';
    }

    public function add_html($name)
    {
        require APP . 'views/' . $name . '.php';
    }
}