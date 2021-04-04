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
       var_dump("test");
    }
}

?>