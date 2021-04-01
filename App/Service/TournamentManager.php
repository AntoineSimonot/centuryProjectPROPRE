<?php
namespace App\Service;
session_start();

use App\Model\TournamentModel;
use App\Controller\UserController;
use Framework\Controller;

class TournamentController extends Controller
{
    public function getTournaments()
    {
        $TournamentModel = new UsersModel();
        $tournaments = $TournamentModel->getTournaments();
    }
}