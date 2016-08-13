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
                $result = User::register($name, $email, $password);
            }
        }



        include_once(ROOT . '/views/user/register.php');
        return true;
    }

}
