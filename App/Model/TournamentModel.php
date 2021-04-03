<?php

namespace App\Model;
use \PDO;
use Cocur\Slugify\Slugify;

class TournamentModel 
{
    public function getTournaments()
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        
        $stmt = $db->prepare('SELECT * FROM tournaments');
        $stmt->execute([
            
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public function editTournaments($name, $description, $date, $price, $id){

        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }

        $stmt = $db->prepare('UPDATE tournaments SET name = :name, description = :description, date = :date , price = :price WHERE id = :id ');
        $stmt->execute([
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "date" => $date,
            "id" => $id
        ]);
    }
  
  
    public function deleteTournament($id){ 
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        
        $stmt = $db->prepare('DELETE FROM `tournaments` WHERE id = :id ');
        $stmt->execute([
            "id" => $id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTournament($name, $description, $date, $price)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('INSERT INTO `tournaments` (`name`, `date`, `price`, `description`) VALUES (:name, :date, :price, :description)');
        $stmt->execute([
           "name" => $name,
           "description" => $description,
           "date" => $date,
           "price" => $price
        ]);
    }  

    public function searchTournament($search){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT * FROM `tournaments` WHERE `name` LIKE :name');
        $stmt->execute([
            'name' => '%'.$search.'%'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}