<?php
namespace App\Controller;
session_start();

use App\Model\TournamentModel;
use App\Controller\UserController;
use Framework\Controller;

class TournamentController extends Controller
{
    public function getTournaments()
    {
        $TournamentModel = new TournamentModel();
        $tournaments = $TournamentModel->getTournaments();
        if (isset($_SESSION["admin"])){
            return $this->renderTemplate('admin.html', [
                'account' =>  $_SESSION["userEmail"],
                'tournaments' => $tournaments
            ]);
        }
        else{
            return $this->renderTemplate('account-bienvenue.html', [
                'account' =>  $_SESSION["userEmail"],
                'tournaments' => $tournaments
            ]);
        }
        
    }

public function getTournament($id)
{
    $TournamentModel = new TournamentModel();
    $tournament = $TournamentModel->getTournament($id);
    return $this->renderTemplate('tournamentInfo.html', [
        'tournament' => $tournament
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
            $this->renderTemplate('edit-create.html', [
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
                $Tournament = $TournamentModel->createTournament($_POST['name'], $_POST['description'], $_POST['date'],$_POST["price"]);
                header('Location: /admin/homepage');
            }
            else{
                echo "Informations invalides";
            }
            $this->renderTemplate('tournament-create.html');
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
        $this->renderTemplate('tournament-list.html.twig',[
            'tournaments' => $Tournament
        ]);
    }

    public function getUserTournaments()
    {   
        $TournamentModel = new TournamentModel();
        $Tournaments = $TournamentModel->getUserTournaments($_SESSION["userEmail"]);
        $this->renderTemplate('user-tournament.html', [
            'tournaments' => $Tournaments,
        ]);
    }

    public function deleteUserFromTournament($id)
    {   
        $TournamentModel = new TournamentModel();
        $Tournaments = $TournamentModel->getUserTournamentByID($_SESSION["userEmail"], $id);
        $deleteUserFromTournament = $TournamentModel->deleteUserFromTournament($Tournaments["tournaments_id"], $Tournaments['users_id']);
        header('Location: /myTournaments');
    }

    public function inscriptionTournament($id)
    {   
        $TournamentModel = new TournamentModel();
        $inscriptionTournament = $TournamentModel->inscriptionTournament($id, $_SESSION["userId"]);
        header('Location: /myTournaments');
    }
}



?> 