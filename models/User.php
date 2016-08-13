<?php

class User
{

    public static function register($name, $email, $password, $role = "")
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO user (name, email, password, role) '
                . 'VALUES (:name, :email, :password, :role)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        
        $status = $result->execute();
        //print_r($result->errorInfo());
        return $status;
        
    }

    public static function checkName($name)
    {
        if (strlen($name)>=2) {
            return true;
        }
        return false;
    }
    
    public static function checkEmal($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkPassword($password)
    {
        if (strlen($password)>=3) {
            return true;
        }
        return false;
    }
    
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }

}
