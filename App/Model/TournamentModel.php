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

    public function getLastTournament()
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        
        $stmt = $db->prepare('SELECT id FROM `tournaments` ORDER BY id DESC LIMIT 1');
        $stmt->execute([
            
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTournament($id)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        
        $stmt = $db->prepare('SELECT * FROM tournaments WHERE id = :id');
        $stmt->execute([
            "id" => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
        $stmt = $db->prepare('INSERT INTO `tournaments` (`name`, `date`, `price`, `description`,`places` ) VALUES (:name, :date, :price, :description, 24)');
        $stmt->execute([
           "name" => $name,
           "description" => $description,
           "date" => $date,
           "price" => $price
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }  
  
      public function getUserTournaments($email)
        {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT * FROM `tournaments` INNER JOIN users_has_tournaments ON tournaments.id = users_has_tournaments.tournaments_id INNER JOIN users ON users_has_tournaments.users_id = users.id WHERE users.email = :email');
        $stmt->execute([
           'email' => $email
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  

    public function getUserTournamentByID($email, $id)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT * FROM `tournaments` INNER JOIN users_has_tournaments ON tournaments.id = users_has_tournaments.tournaments_id INNER JOIN users ON users_has_tournaments.users_id = users.id WHERE users.email = :email AND  tournaments.id = :id');
        $stmt->execute([
           'email' => $email,
           'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }  

    public function deleteUserFromTournament($tournamentTournamentId, $tournamentUserId)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }

        $stmt = $db->prepare('DELETE FROM `users_has_tournaments` WHERE `users_has_tournaments`.`users_id` = :tournamentUserId AND `users_has_tournaments`.`tournaments_id` = :tournamentTournamentId');
        $stmt->execute([
           'tournamentTournamentId' => $tournamentTournamentId,
           'tournamentUserId' => $tournamentUserId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  

    public function inscriptionTournament($tournamentTournamentId, $tournamentUserId)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('INSERT INTO `users_has_tournaments` (`users_id`, `tournaments_id`) VALUES (:user_id, :tournaments_id);');
        $stmt->execute([
           'user_id' => $tournamentUserId,
           'tournaments_id' => $tournamentTournamentId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function personInTournament($id){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('SELECT COUNT(tournaments_id) FROM `users_has_tournaments` WHERE users_id = :users_id');
        $stmt->execute([
            'users_id' => $id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isInTournament($user_id, $tournament_id){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('SELECT * FROM `users_has_tournaments` WHERE users_id = :user_id AND tournaments_id = :tournament_id');
        $stmt->execute([
            'tournament_id' => $tournament_id,
            'user_id' => $user_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function idOfpersonsInTournament($tournament_id){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('SELECT * FROM `users_has_tournaments` WHERE tournaments_id = :tournament_id
        ');
        $stmt->execute([
            'tournament_id' => $tournament_id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function placesUpdate($tournament_id, $update){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('UPDATE `tournaments` SET `places` = `places` + :update WHERE `tournaments`.`id` = :tournament_id');
        $stmt->execute([
            'tournament_id' => $tournament_id,
            'update' => $update
        ]);
    }
}

