<?php

function my_autoloader($class)
{
    $array_path = array(
        '/models/',
        '/components/',
    );

    foreach ($array_path as $path) {
        $path = ROOT . $path . $class . '.php';
        if (is_file($path)) {
            include_once($path);
        }
    }
}

spl_autoload_register('my_autoloader');
