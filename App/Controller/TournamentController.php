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
        return $this->renderTemplate('admin.html', [
            'account' =>  $_SESSION["userEmail"],
            'tournaments' => $tournaments
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
}