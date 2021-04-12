<?php
namespace App\Controller;


use App\Model\TournamentModel;
use App\Model\TeamModel;
use App\Model\BetModel;
use App\Controller\TournamentController;
use App\Controller\MatchController;
use App\Controller\UserController;
use Framework\Controller;
use Service\TournamentManager;

class TeamController extends Controller
{
    public function createTeam($id)
    {
        $teamId = 0;
        $players = [];
        $teams = [];
        $TeamModel = new TeamModel();
        $MatchController = new MatchController();
        $idOfpersonsInTournament = $TeamModel-> idOfpersonsInTournament($id);
        $idOfteamsInTournament = $TeamModel-> idOfteamsInTournament($id);
  
        foreach ($idOfpersonsInTournament as $key => $idPerson) {
            $players[] = $idPerson["users_id"];
        }
        $team = [];
        while (count($players) > 0) {
            $randomKey = rand(0, count($players) - 1);
            $player = $players[$randomKey];
            var_dump($players);
            $team[] = $player;
            
            unset($players[$randomKey]);
            
            $players = array_values($players);
            if (count($team) == 3) {
            
                $insertUserInTeam = $TeamModel-> insertUserInTeam($team[0], $idOfteamsInTournament[$teamId]["id"]);
                $insertUserInTeam = $TeamModel-> insertUserInTeam($team[1], $idOfteamsInTournament[$teamId]["id"]);
                $insertUserInTeam = $TeamModel-> insertUserInTeam($team[2], $idOfteamsInTournament[$teamId]["id"]);
                $team = [];
                $teamId = $teamId + 1;
                

            }
        }
       
        $MatchController->createMatchs($id);
        // header('Location: /myTournaments');
    }

    public function getTeamsName($id)
    {
        $TeamModel = new TeamModel();
        return $getTeamsName = $TeamModel-> getTeamsName($id);
       
    }

    public function showMembersOfTeam($teams_name)
    {
        session_start();
        $TeamModel = new TeamModel();
        $BetModel = new BetModel();
        $showMembersOfTeam = $TeamModel-> showMembersOfTeam($teams_name);
        $getBets = $TeamModel-> getBets($teams_name);
        $hasBet = $BetModel->hasBet($teams_name, $_SESSION["userId"]);
        $this->renderTemplate('generalData/users-of-team.html', [
            'team' =>  $showMembersOfTeam,
            'teamName' => $teams_name,
            'bets' => $getBets[0]["count(team_id)"],
            'hasBet' => $hasBet
        ]);
    }
}
?>
