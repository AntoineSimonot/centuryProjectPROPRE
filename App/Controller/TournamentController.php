<?php
namespace App\Controller;
session_start();

use App\Model\TournamentModel;
use App\Model\TeamModel;
use App\Controller\UserController;
use Framework\Controller;
use Service\TournamentManager;

class TournamentController extends Controller
{
    public function getTournaments()
    {
        $TournamentModel = new TournamentModel();
        $tournaments = $TournamentModel->getTournaments();
        if (isset($_SESSION["admin"])){
            return $this->renderTemplate('Account/Admin/Page/admin.html', [
                'account' =>  $_SESSION["userEmail"],
                'tournaments' => $tournaments
            ]);
        }
        else{
            return $this->renderTemplate('Account/User/Page/account-bienvenue.html', [
                'account' =>  $_SESSION["userEmail"],
                'tournaments' => $tournaments
            ]);
        }
        
    }

public function getTournament($id)
{
    $TournamentModel = new TournamentModel();
    $tournament = $TournamentModel->getTournament($id);
    $inscriptionTournament = $TournamentModel->isInTournament($_SESSION["userId"], $id);
    var_dump(isset($inscriptionTournament[0]));
    return $this->renderTemplate('generalData/tournamentInfo.html', [
        'tournament' => $tournament,
        'isInTournament' =>  isset($inscriptionTournament[0])
    ]);
    }

    public function editTournament($id)
    {   
        if ($id != "" ) {
            if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['price'])){
                $tournamentModel = new TournamentModel();
                $tournaments = $tournamentModel->editTournaments($_POST['name'], $_POST['description'], $_POST['date'], $_POST['price'], $id);
                header('Location: /admin/homepage');
            }
            $this->renderTemplate('Account/Admin/modifyData/edit-create.html', [
                'id' => $id
            ]);
        }
        else {
            header('Location: /admin/homepage');
        }
    }

    public function deleteTournament($id)
    {
        $TournamentModel = new TournamentModel();
        $tournaments = $TournamentModel->deleteTournament($id);
        header('Location: /admin/homepage');
    }

    public function createTournament()
    {   
        if ($_SESSION["userId"] != "" ) {
            if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['date'])){
                $TournamentModel = new TournamentModel();
                $TeamModel = new TeamModel();
                $Tournament = $TournamentModel->createTournament($_POST['name'], $_POST['description'], $_POST['date'],$_POST["price"]);
                $getLastTournament = $TournamentModel->getLastTournament();
                $createTeams = $TeamModel->createTeams($getLastTournament["id"], $_POST['team1'], $_POST['team2'], $_POST['team3'], $_POST['team4'], $_POST['team5'], $_POST['team6'], $_POST['team7'], $_POST['team8'] );
                header('Location: /admin/homepage');
            }
            else{
                echo "Informations invalides";
            }
            $this->renderTemplate('Account/Admin/modifyData/tournament-create.html');
        } 
        else{
            header('Location: /admin/homepage/create');
        }  
    }

    public function searchTournament()
    {
        $Tournament = [];
        $TournamentModel = new TournamentModel();
        if(isset($_GET['search']) && strlen($_GET['search']) >0 ){
            $Tournament = $TournamentModel->searchTournament($_GET['search']);
        }else if(strlen($_GET['search']) == 0){
            $Tournament = $TournamentModel->getTournaments();
        }
        $this->renderTemplate('Template/tournament-list.html.twig',[
            'tournaments' => $Tournament
        ]);
    }

    public function getUserTournaments()
    {   
        $TournamentModel = new TournamentModel();
        $Tournaments = $TournamentModel->getUserTournaments($_SESSION["userEmail"]);
        $this->renderTemplate('Account/User/userData/user-tournament.html', [
            'tournaments' => $Tournaments,
        ]);
    }

    public function deleteUserFromTournament($id)
    {   
        $TournamentModel = new TournamentModel();
        $Tournaments = $TournamentModel->getUserTournamentByID($_SESSION["userEmail"], $id);
        $deleteUserFromTournament = $TournamentModel->deleteUserFromTournament($Tournaments["tournaments_id"], $Tournaments['users_id']);
        $placesUpdate = $TournamentModel->placesUpdate($id, 1);
        header('Location: /myTournaments');
    }

    public function inscriptionTournament($id)
    {   
        $TournamentModel = new TournamentModel();
        $isInTournament = $TournamentModel->isInTournament($_SESSION["userId"], $id);
        $tournament = $TournamentModel->getTournament($id);
        if (empty($inscriptionTournament) && $tournament["places"] == 1){
            $inscriptionTournament = $TournamentModel->inscriptionTournament($id, $_SESSION["userId"]);
            $placesUpdate = $TournamentModel->placesUpdate($id, -1);
            header('Location: /create-team');
        }
        elseif (empty($inscriptionTournament) && $tournament["places"] > 0){
            $inscriptionTournament = $TournamentModel->inscriptionTournament($id, $_SESSION["userId"]);
            $placesUpdate = $TournamentModel->placesUpdate($id, -1);
            
        }
        // header('Location: /myTournaments');
    }

    public function personInTournament()
    {   
        $TournamentModel = new TournamentModel();
        $inscriptionTournament = $TournamentModel->personInTournament($_SESSION["userId"]);
        header('Location: /myTournaments');
    }
}



?> 