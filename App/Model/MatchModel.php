<?php

namespace App\Model;
use \PDO;
use Cocur\Slugify\Slugify;

class MatchModel
{
    public function createMatchs($round, $team1, $team2, $tournament_id)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('INSERT INTO `teams_has_matchs` (`round`, `team1`, `team2`, `tournament_id`) VALUES (:round, :team1, :team2, :tournament_id)');
        $stmt->execute([
            "round" => $round,
            "team1" => $team1,
            "team2" => $team2,
            "tournament_id" => $tournament_id
        ]);
    }

    public function showMatchs($tournament_id, $round)
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT * FROM `teams_has_matchs` 
        INNER JOIN teams ON teams_has_matchs.team1 = teams.id
        WHERE teams.tournament_id = :tournament_id AND round = :round');
        $stmt->execute([
            "tournament_id" => $tournament_id,
            "round" => $round
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
        INNER JOIN teams ON teams_has_matchs.tournament_id = teams.tournament_id
        WHERE round = :round AND teams_has_matchs.tournament_id = :tournament_id AND (teams.id = teams_has_matchs.team2 OR teams.id = teams_has_matchs.team1)' );
        $stmt->execute([
            "tournament_id" => $tournament_id,
            "round" => $round
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRounds(){
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=century_bdd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        $stmt = $db->prepare('SELECT round FROM `teams_has_matchs`' );
        $stmt->execute([
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>