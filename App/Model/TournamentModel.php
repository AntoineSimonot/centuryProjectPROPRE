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
}