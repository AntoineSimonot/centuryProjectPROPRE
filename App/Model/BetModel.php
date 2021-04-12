<?php
namespace App\Model;
use \PDO;
use Cocur\Slugify\Slugify;

class BetModel
{
    public function bet($teamName)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('UPDATE `teams` SET `bets` = `bets` + 1 WHERE `name` = :teamName');
        $stmt->execute([
            "teamName" => $teamName,
        ]);
    }

    public function hasBet($team_name, $user_id)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT * FROM `user_has_bets` 
        INNER JOIN teams ON user_has_bets.team_id = teams.id
        INNER JOIN users ON user_has_bets.user_id = users.id
        WHERE teams.name = :team_name AND users.id = :user_id');
        $stmt->execute([
            "team_name" => $team_name,
            "user_id" => $user_id
        ]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function insertBet($team_id, $user_id)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('INSERT INTO `user_has_bets` (`user_id`, `team_id`) VALUES (:user_id, :team_id);');
        $stmt->execute([
            "team_id" => $team_id,
            "user_id" => $user_id
        ]);
    }

    public function selectWinners($team_id)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT * FROM `user_has_bets` WHERE team_id = team_id');
        $stmt->execute([
            "team_id" => $team_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    
}


