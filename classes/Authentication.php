<?php
require_once("DBAccess.php");

class Authentication
{
    const LoginPageURL = "login.php";
    const SuccessPageURL = "success.php";

    private static $_db;

    public static function login($uname, $pword) 
    {
        $hash = "";

        include "settings/db.php";

        try
        {
            self::$_db = new DBAccess($dsn, $username, $password);
        }
        catch (PDOException $e)
        {
            die("Unable to connect to database, ". $e->getMessage());
        }
        
        try
        {
            $pdo = self::$_db->connect();
            $sql = "select password from user where username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $uname, PDO::PARAM_STR);
            $hash = self::$_db->executeSQLReturnOneValue($stmt);
        }
        catch (PDOException $e)
        {
            throw $e;
        }

        if(password_verify($pword, $hash))
        {
            $_SESSION["username"] = $uname;

            header("Location: " . self::SuccessPageURL);
            exit;
        } else {
            return false;
        }
    }

    public static function logout()
    {
        unset($_SESSION["username"]);

        header("Location: " . self::LoginPageURL);
        exit;
    }

    public static function protect()
    {
        if(!isset($_SESSION["username"]))
        {
            header("Location: " . self::LoginPageURL);
            exit;
        }
    }

    public static function updateUser($uname, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

        include "settings/db.php";

        try
        {
            self::$_db = new DBAccess($dsn, $username, $password);
        }
        catch (PDOException $e)
        {
            die("Unable to connect to database, ". $e->getMessage());
        }

        try {
            $pdo = self::$_db->connect();

            $sql = "UPDATE user SET password = :password WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $uname, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hash, PDO::PARAM_STR);

            $result = self::$_db->executeNonQuery($stmt);
        }
        catch(PDOException $e) {
            throw $e;
        }

        return "User Updated";
    }

    public static function createUser($uname, $pword)
    {
        $hash = password_hash($pword, PASSWORD_DEFAULT);

        include "settings/db.php";

        try
        {
            self::$_db = new DBAccess($dsn, $username, $password);
        }
        catch (PDOException $e)
        {
            die("Unable to connect to database, ". $e->getMessage());
        }

        try {
            $pdo = self::$_db->connect();

            $sql = "insert into user(username, password) values(:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $uname, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hash, PDO::PARAM_STR);

            $result = self::$_db->executeNonQuery($stmt);
        }
        catch(PDOException $e) {
            throw $e;
        }

        return "New user added";
    }
}
?>