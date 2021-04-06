<?php

namespace App\Model;
use \PDO;
use Cocur\Slugify\Slugify;

class TeamModel
{
    public function createTeams($tournamentId, $name1, $name2, $name3, $name4, $name5, $name6, $name7, $name8)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name1, :tournamentId);
        INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name2, :tournamentId);
        INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name3, :tournamentId);
        INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name4, :tournamentId);
        INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name5, :tournamentId);
        INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name6, :tournamentId);
        INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name7, :tournamentId);
        INSERT INTO `teams` (`name`, `tournament_id`) VALUES (:name8, :tournamentId);');
        $stmt->execute([
            "tournamentId" => $tournamentId,
            "name1" => $name1,
            "name2" => $name2,
            "name3" => $name3,
            "name4" => $name4,
            "name5" => $name5,
            "name6" => $name6,
            "name7" => $name7,
            "name8" => $name8,
        ]);
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

    public function idOfteamsInTournament($tournament_id){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('SELECT * FROM `teams` WHERE `tournament_id` = :tournament_id
        ');
        $stmt->execute([
            'tournament_id' => $tournament_id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertUserInTeam($users_id, $teams_id){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('INSERT INTO `team_has_users` (`users_id`, `teams_id`) VALUES (:user_id, :team_id);');
        $stmt->execute([
            'user_id' => $users_id,
            'team_id' => $teams_id
        ]);
    }
    
    public function NumberOfpersonsInTeam($teams_id){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('SELECT COUNT(users_id) FROM `team_has_users` WHERE teams_id = :team_id');
        $stmt->execute([
            'team_id' => $teams_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTeamsName($tournament_id){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('SELECT teams.name FROM `teams`  INNER JOIN tournaments ON tournaments.id = teams.tournament_id WHERE tournament_id = :tournament_id');
        $stmt->execute([
            'tournament_id' => $tournament_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function showMembersOfTeam($teams_name){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }    
        $stmt = $db->prepare('SELECT users.email FROM users
        INNER JOIN team_has_users ON users.id = team_has_users.users_id
        INNER JOIN teams on teams.id = team_has_users.teams_id
        WHERE teams.name = :teams_name
        ');
        $stmt->execute([
            'teams_name' => $teams_name
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>

