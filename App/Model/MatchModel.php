<?php

namespace App\Model;
use \PDO;
use Cocur\Slugify\Slugify;

class MatchModel
{
    public function createMatchs($round, $team1, $team2)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('INSERT INTO `teams_has_matchs` (`round`, `team1`, `team2`) VALUES (:round, :team1, :team2)');
        $stmt->execute([
            "round" => $round,
            "team1" => $team1,
            "team2" => $team2
        ]);
    }

    public function showMatchs($tournament_id)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT * FROM `teams_has_matchs` 
        INNER JOIN teams ON teams_has_matchs.team1 = teams.id
        WHERE teams.tournament_id = :tournament_id');
        $stmt->execute([
            "tournament_id" => $tournament_id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showNameOfTeams($tournament_id, $round)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT DISTINCT name FROM teams_has_matchs
        INNER JOIN teams ON teams_has_matchs.team1 = teams.id OR teams_has_matchs.team2 = teams.id
        WHERE round = :round AND teams.tournament_id = :tournament_id' );
        $stmt->execute([
            "tournament_id" => $tournament_id,
            "round" => $round
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>