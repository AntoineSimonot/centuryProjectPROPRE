<?php
namespace App\Controller;

use App\Model\TournamentModel;
use App\Model\MatchModel;
use App\Model\TeamModel;
use App\Controller\TournamentController;
use App\Controller\UserController;
use Framework\Controller;
use Service\TournamentManager;

class MatchController extends Controller
{
    public function createMatchs()
    {  
        $i = 0;
        $TeamModel = new TeamModel();
        $MatchModel = new MatchModel();
        $idOfteamsInTournament = $TeamModel-> idOfteamsInTournament($_GET["id"]);
        
        while ($i <= count($idOfteamsInTournament) - 2 ) {
            if ($i == 0) {
                $MatchModel->createMatchs(1, $idOfteamsInTournament[$i]["id"], $idOfteamsInTournament[$i+1]["id"]);
                $i = 1;
            }
            else{
                $MatchModel->createMatchs(1, $idOfteamsInTournament[$i + 1]["id"], $idOfteamsInTournament[$i+2]["id"]);
                $i = $i + 2;
            }
        }
    }

    public function showMatchs()
    {  
       var_dump("test");
       $MatchModel = new MatchModel();
       $match = $MatchModel->showMatchs(1);
       var_dump($match);
    }
}

