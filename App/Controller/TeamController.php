<?php
namespace App\Controller;

use App\Model\TournamentModel;
use App\Model\TeamModel;
use App\Controller\TournamentController;
use App\Controller\MatchController;
use App\Controller\UserController;
use Framework\Controller;
use Service\TournamentManager;

class TeamController extends Controller
{
    public function createTeam($id)
    {
        $i = 0;
        $TeamModel = new TeamModel();
        $MatchController = new MatchController();
        $idOfpersonsInTournament = $TeamModel-> idOfpersonsInTournament($id);
        $idOfteamsInTournament = $TeamModel-> idOfteamsInTournament($id);
        foreach ($idOfpersonsInTournament as $key => $id_person) {
            $insertUserInTeam = $TeamModel->  insertUserInTeam($id_person["users_id"], ($idOfteamsInTournament[$i]["id"]));
            if ($i < 7) {
                $i++;
            }
            else{
                $i = 0;
            }   
        }
        $MatchController->createMatchs($id);
        header('Location: /myTournaments');
    }

    public function getTeamsName($id)
    {
        $TeamModel = new TeamModel();
        return $getTeamsName = $TeamModel-> getTeamsName($id);
       
    }

    public function showMembersOfTeam($teams_name)
    {
        $TeamModel = new TeamModel();
        $showMembersOfTeam = $TeamModel-> showMembersOfTeam($teams_name);
        $this->renderTemplate('generalData/users-of-team.html', [
            'team' =>  $showMembersOfTeam,
            'teamName' => $teams_name
        ]);
    }
}
?>
