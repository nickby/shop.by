<?php

//
//function __autoload($class_name)
//{
//    $array_path = array(
//        '/models/',
//        '/components/',
//    );
//
//    foreach ($array_path as $path) {
//        $path = ROOT . $path . $class_name . '.php';
//        if (is_file($path)) {
//            include_once($path);
//        }
//    }
//}


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
