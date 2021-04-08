<?php

namespace App\Model;
use \PDO;
use Cocur\Slugify\Slugify;


class UsersModel 
{
    public function login($email, $password)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email and password = :password');
        $stmt->execute([
            "email" => $email,
            "password" => $password
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registration($email, $password, $pseudo)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }

        $stmt = $db->prepare("INSERT INTO `users` (`email`, `password`, `admin`, `pseudo`) VALUES (:email, :password, 0,:pseudo)");
        $stmt->execute([
            "email" => $email,
            "password" => $password,
            "pseudo" => $pseudo
        ]);
    }
}

