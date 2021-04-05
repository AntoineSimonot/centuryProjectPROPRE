<?php
namespace App\Controller;
session_start();

use App\Model\TournamentModel;
use App\Model\TeamModel;
use App\Controller\UserController;
use Framework\Controller;
use Service\TournamentManager;

class TeamController extends Controller
{
    public function createTeam()
    {
        $i = 0;
        $TeamModel = new TeamModel();
        $idOfpersonsInTournament = $TeamModel-> idOfpersonsInTournament($_GET["id"]);
        $idOfteamsInTournament = $TeamModel-> idOfteamsInTournament($_GET["id"]);
        foreach ($idOfpersonsInTournament as $key => $id_person) {
            $insertUserInTeam = $TeamModel->  insertUserInTeam($id_person["users_id"], ($idOfteamsInTournament[$i]["id"]));
            if ($i < 7) {
                $i++;
            }
            else{
                $i = 0;
            }   
        }
    }
}
?>
