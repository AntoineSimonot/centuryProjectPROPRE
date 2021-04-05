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

}
?>