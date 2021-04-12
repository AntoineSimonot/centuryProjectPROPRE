<?php
namespace App\Controller;
session_start();
if (!isset($_SESSION["accountId"])) {
    $_SESSION["accountId"] = "";
}

use App\Model\UsersModel;
use App\Model\TournamentModel;
use App\Controller\TournamentController;
use App\Controller\EmailController;
use Framework\Controller;

class UserController extends Controller
{
    public function showLogin()
    {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $userModel = new UsersModel();
            $account = $userModel->login($_POST['email'], $_POST['password']);
            if (isset($account["email"]) && isset($account["password"]) && isset($account["id"])) {
                $_SESSION["userEmail"] = $account["email"]; 
                $_SESSION["userTokens"] = $account["tokens"]; 
                $_SESSION["userId"] = $account["id"];
                $_SESSION["userPassword"] = $account["password"];
                if ($account["admin"] == 1){
                    $_SESSION["admin"] = $account["admin"];
                }
                
                if ($account["admin"] == 1) {
                    header('Location: /admin/homepage');
                      
                }
                else {
                    header('Location: /tournaments');
                    
                }
                
            }
            else {
                echo "Vos indentifiants sont invalides!";
            }  
           
            if ($account["id"]) {
                var_dump($account);
                return $this->renderTemplate('Account/User/Page/account-bienvenue.html', [
                        
                ]);
            }
        }
            
        return $this->renderTemplate('Login-Register/account-login.html.twig');
    }

    public function showRegistration()
    {
      
        if (isset($_POST["emailCreation"]) && isset($_POST["passwordCreation"]) && isset($_POST["passwordVerification"]) && isset($_POST["pseudo"]) && $_POST["passwordCreation"] == $_POST["passwordVerification"]  ) {
            $userModel = new UsersModel();
            $account = $userModel->registration($_POST['emailCreation'], $_POST['passwordCreation'],$_POST["pseudo"]);
            $sendMail = new EmailController();
            $sendMail->sendEmailInscription($_POST["emailCreation"],$_POST["pseudo"]);
            header('Location: /account/login');
        }
     
        return $this->renderTemplate('Login-Register/account-register.html.twig');
    }

    public function disconnectEvent()
    {
        session_destroy();
        header('Location: /account/login');
    }
}
