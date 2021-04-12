<?php
namespace App\Controller;
session_start();
if (!isset($_SESSION["accountId"])) {
    $_SESSION["accountId"] = "";
}

use App\Model\UsersModel;
use App\Model\TournamentModel;
use App\Model\BetModel;

use App\Model\TeamModel;
use App\Controller\TournamentController;
use App\Controller\EmailController;
use Framework\Controller;

class BetController extends Controller
{
    public function hasBet($teamName)
    {
        $hasBet = new BetModel();
        return $verification = $hasBet->hasBet($teamName, $_SESSION["userId"]);    
    }

    public function bet($teamName)
    {
        $TeamModel = new TeamModel();
        $UsersModel = new UsersModel();
        $teamID = $TeamModel->getTeamsByName($teamName);
        $bet = new BetModel();
        $hasBet = $this->hasBet($teamName);
        
        if (!$hasBet && $_SESSION["userTokens"] > 0) {
            $bet->bet($teamName);
            $bet->insertBet($teamID[0]["id"], $_SESSION["userId"]);
            $UsersModel->changeToken($_SESSION["userId"], -1);
            var_dump($_SESSION["userId"]);
            $_SESSION["userTokens"] = $_SESSION["userTokens"] - 1;
        }
        
        header('Location: /teamInfo/'.$teamName);
        
    }

    
}





