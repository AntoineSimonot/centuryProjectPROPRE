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

    public function registration($email, $password)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        
        $stmt = $db->prepare("INSERT INTO `users` (`email`, `password`, `admin`) VALUES (:email, :password, 0)");
        $stmt->execute([
            "email" => $email,
            "password" => $password
        ]);
    }

    // public function getEvent($slug)
    // {
    //     $db = $this->getDb();
    //     $stmt = $db->prepare('SELECT * FROM events WHERE slug = :slug ');
    //     $stmt->execute([
    //         "slug" => $slug
    //     ]);
    //     return $stmt->fetch();
    // }

    // public function getUser($email, $password)
    // {
    //     $db = $this->getDb();
    //     $stmt = $db->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
    //     $stmt->execute([
    //         "email" => $email,
    //         "password" => $password
    //     ]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

 

    // public function buyPlace($id, $placesBought)
    // {
    //     $db = $this->getDb();
    //     $stmt = $db->prepare('UPDATE `events` SET `places` = :places WHERE id = :id;');
    //     $stmt->execute([
    //        "id" => $id,
    //        "places" => $placesBought
    //     ]);
    // }

    // public function getEventsUrl($url)
    // {
    //     $db = $this->getDb();
    //     $stmt = $db->prepare('SELECT * FROM `events` WHERE name LIKE :url');
    //     $stmt->execute([
    //         "url" => "%".$url."%"
    //     ]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}

