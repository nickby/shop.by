<?php

class UserController
{

    public function actionRegister()
    {
        $result = false;
        $name = '';
        $email = '';
        $password = '';
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2 символов';
            }

            if (!User::checkEmal($email)) {
                $errors[] = 'Неверный емейл';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Короткий пароль';
            }

            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже существует';
            }

            if (!$errors) {
                // регистрируем
                $result = User::register($name, $email, $password);
                
                // получаем id пользователя
                $userId = User::checkUserData($email, $password);

                // запоминаем id пользователя
                User::auth($userId);
                
                // перенаправляем пользователя в закрытую часть
                header('Location: /cabinet/');
            }
        }

        include_once(ROOT . '/views/user/register.php');
        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmal($email)) {
                $errors[] = 'Неверный емейл';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Короткий пароль';
            }
            
            // проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);
            if ($userId == false) {
                $errors[] = 'Введены неверные параметры пользователя';
            } else {
                // запоминаем пользователя в сессию
                User::auth($userId);
                
                // перенаправляем пользователя в закрытую часть
                header('Location: /cabinet/');
            }
        }
        elseif (isset($_POST['submit_register'])) {
            header('Location: /user/register/');
            return true;
        }

        include_once(ROOT . '/views/user/login.php');
        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }    
}
