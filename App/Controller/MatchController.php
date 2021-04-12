<?php
namespace App\Controller;

session_start();

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

    public function getUrlId(){
        $url = $_SERVER["REQUEST_URI"];
            if(preg_match("/\/(\d+)$/",$url,$matches)){
            return $end=$matches[1];
            }
    }





    public function showMatchs($id)
    {  
        $TeamModel = new TeamModel();
        $MatchModel = new MatchModel();
        $TournamentModel = new TournamentModel();

        $tournamentInfo = $TournamentModel->getTournamentInfo($id);
        $matchInfo = $MatchModel->showMatchs($id);
        $tournament = [
            'quaterfinals' => [],
            'semifinal' => [],
            'final' => [],
            'round' => 0
        ];
               
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST["round"] == 2 && isset($_POST["match0"]) && isset($_POST["match1"]) && isset($_POST["match2"]) && isset($_POST["match3"])){
                $MatchModel->createMatchs($_POST["round"], $_POST["match0"], $_POST["match1"]);
                $MatchModel->createMatchs($_POST["round"], $_POST["match2"], $_POST["match3"]);
            }
            if ($_POST["round"] == 3 && isset($_POST["match4"]) && isset($_POST["match5"])) {
                $MatchModel->createMatchs($_POST["round"], $_POST["match4"], $_POST["match5"]);
            }
            if ($_POST["round"] == 4 && isset($_POST["match6"])) {
                $MatchModel->createMatchs($_POST["round"], $_POST["match6"], NULL);
                $TeamModel->insertWinner($_POST["match6"], $id);
            }
            header("Location: /tournament/matchs/$id");
        }
         
        $tournamentInfo = $TournamentModel->getTournamentInfo($id);
        $matchInfo = $MatchModel->showMatchs($id);
      
        $customKey = 0;

        foreach ($matchInfo as $key => $match) {
            if ($match["round"] == 1) {
                $teamNameInfo = $MatchModel->showNameOfTeams($id, $match["round"]);
                $tournament["quaterfinals"][$key]["team1"]["id"] = $match["team1"];
                $tournament["quaterfinals"][$key]["team1"]["name"] = $teamNameInfo[$customKey]["name"];

                $tournament["quaterfinals"][$key]["team2"]["id"] = $match["team2"];
                $tournament["quaterfinals"][$key]["team2"]["name"] = $teamNameInfo[$customKey + 1]["name"];
                $tournament["round"] = 1;
                $customKey = $customKey + 2;
            }
        }

        $customKey = 0;

        foreach ($matchInfo as $key => $match) {
            if ($match["round"] == 2) {
                $teamNameInfo = $MatchModel->showNameOfTeams($id, $match["round"]);
                $tournament["semifinal"][$key]["team1"]["id"] = $match["team1"];
                $tournament["semifinal"][$key]["team1"]["name"] = $teamNameInfo[$customKey]["name"];

                $tournament["semifinal"][$key]["team2"]["id"] = $match["team2"];
                $tournament["semifinal"][$key]["team2"]["name"] = $teamNameInfo[$customKey + 1]["name"];
                $tournament["round"] = 2;
                $customKey = $customKey + 2;
            }
        }

        $customKey = 0;

        foreach ($matchInfo as $key => $match) {
            if ($match["round"] == 3) {
                $teamNameInfo = $MatchModel->showNameOfTeams($id, $match["round"]);
                $tournament["final"][$key]["team1"]["id"] = $match["team1"];
                $tournament["final"][$key]["team1"]["name"] = $teamNameInfo[$customKey]["name"];

                $tournament["final"][$key]["team2"]["id"] = $match["team2"];
                $tournament["final"][$key]["team2"]["name"] = $teamNameInfo[$customKey + 1]["name"];
                $tournament["round"] = 3;
                $customKey = $customKey + 2;
            }
        
        }

        foreach ($matchInfo as $key => $match) {
            if ($match["round"] == 4) {
                $tournament["round"] = 4;
            }
        
        }

    $this->renderTemplate('generalData/tournament-brackets.html.twig', [
        'tournament' => $tournament,
        'Admin' => isset($_SESSION["admin"]),
        'urlId' => $this->getUrlId(),
        'winner' => $matchInfo
    ]);
}
}

