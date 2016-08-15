<?php

abstract class AdminBase
{
    public function __construct()
    {
        // авторизован ли пользователь
        $userId = User::checkLogged();
        
        // читаем данные по пользователю
        $user = User::getUserById($userId);
        
        // проверка прав пользователя
        if ($user['role'] == 'admin') {
            return true;
        } else {
            die('Access denied');
        }
    }

}
