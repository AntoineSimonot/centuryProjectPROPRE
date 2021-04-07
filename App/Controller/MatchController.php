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
    public function createMatchs($id)
    {  
        $i = 0;
        $TeamModel = new TeamModel();
        $MatchModel = new MatchModel();
        $idOfteamsInTournament = $TeamModel-> idOfteamsInTournament($id);
        
        while ($i <= count($idOfteamsInTournament) - 2 ) {
            if ($i == 0) {
                var_dump($_GET);
                var_dump($id);
                $MatchModel->createMatchs(1, $idOfteamsInTournament[$i]["id"], $idOfteamsInTournament[$i+1]["id"], $id);
                $i = 1;
            }
            else{
                $MatchModel->createMatchs(1, $idOfteamsInTournament[$i + 1]["id"], $idOfteamsInTournament[$i+2]["id"], $id);
                $i = $i + 2;
            }
        }
    }

    public function showMatchs($id)
    {  
        $showNameOfTeams1 = "";
        $showNameOfTeams2 = "";
        $showNameOfTeams3 = "";
        $showNameOfTeams4 = "";
        $roundCompteur = 0;
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $MatchModel = new MatchModel();
            $TeamModel = new TeamController();
            $teams = $TeamModel->getTeamsName($id);
            $match = $MatchModel->showMatchs($id, 1);
            $rounds = $MatchModel->getRounds();
            foreach ($rounds as $key => $round) {
                if ($round["round"] > $roundCompteur) {
                    $roundCompteur = $round["round"];
                    ${"showNameOfTeams" . $roundCompteur} =  $MatchModel->showNameOfTeams($id, $roundCompteur);
                    $match = $MatchModel->showMatchs($id, $roundCompteur);
                }
            }
            if (!isset($match)) {
                $match = "";
            }
            $this->renderTemplate('generalData/tournamentBracket.html', [
             'match' => $match,
             'teamName1' => $showNameOfTeams1,
             'teamName2' => $showNameOfTeams2,
             'teamName3' => $showNameOfTeams3,
             'teamName4' => $showNameOfTeams4,
             'myKey' => 1
         ]);
        }
      
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MatchModel = new MatchModel();
            $TeamController = new TeamController();
            $teamModel = new TeamModel();
            if (isset($_POST["Team1"]) && isset($_POST["Team2"]) && isset($_POST["Team3"]) && isset($_POST["Team4"]) && $_POST["round"] == 2 ) {
                $MatchModel->createMatchs($_POST["round"], $_POST["Team1"], $_POST["Team2"], $id);
                $MatchModel->createMatchs($_POST["round"],  $_POST["Team3"], $_POST["Team4"], $id);
                $match = $MatchModel->showMatchs($id, $_POST["round"]);
            }elseif (isset($_POST["Team1"]) && isset($_POST["Team4"]) && $_POST["round"] == 3) {
                $MatchModel->createMatchs($_POST["round"], $_POST["Team1"], $_POST["Team4"], $id);
                $match = $MatchModel->showMatchs($id, $_POST["round"]);
            }elseif($_POST["round"] == 4) {
                $MatchModel->createMatchs($_POST["round"], $_POST["Team1"], NULL, $id);
                $teamModel ->insertWinner($_POST["Team1"], $id);
                $winner = $_POST["Team1"];
            }
            $teams = $TeamController->getTeamsName($id);
            
            $showNameOfTeams1 = $MatchModel->showNameOfTeams($id, 1);
            $showNameOfTeams2 = $MatchModel->showNameOfTeams($id, 2);
            $showNameOfTeams3 = $MatchModel->showNameOfTeams($id, 3);
            $showNameOfTeams4 = $MatchModel->showNameOfTeams($id, 4);
            if (!isset($match)) {
                $match = "";
            }
            $this->renderTemplate('generalData/tournamentBracket.html', [
             'match' => $match,
             'teamName1' => $showNameOfTeams1,
             'teamName2' => $showNameOfTeams2,
             'teamName3' => $showNameOfTeams3,
             'teamName4' => $showNameOfTeams4,
             'myKey' => 1,
         ]);
        }
    }
}

