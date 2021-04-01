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
}