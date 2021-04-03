<?php
namespace App\Controller;
session_start();
if (!isset($_SESSION["accountId"])) {
    $_SESSION["accountId"] = "";
}

use App\Model\UsersModel;
use App\Model\TournamentModel;
use App\Controller\TournamentController;
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
                $_SESSION["userId"] = $account["id"];
                $_SESSION["userPassword"] = $account["password"];
                if ($account["admin"] == 1) {
                    header('Location: /admin/homepage');
                }
                else {
                    return $this->renderTemplate('account-bienvenue.html', [
                        'account' => $account["email"]
                    ]);
                }
            }
            else {
                echo "Vos indentifiants sont invalides!";
            }  
            if ($account["id"]) {
                return $this->renderTemplate('account-bienvenue.html', [
                    'account' => $account["email"]
                ]);
            }
        }
            
        return $this->renderTemplate('account-login.html.twig');
    }

    public function showRegistration()
    {
        
        if (isset($_POST["emailCreation"]) && isset($_POST["passwordCreation"]) && isset($_POST["passwordVerification"]) && $_POST["passwordCreation"] == $_POST["passwordVerification"]) {
            $userModel = new UsersModel();
            $account = $userModel->registration($_POST['emailCreation'], $_POST['passwordCreation']);
            header('Location: /account/login');
        }
     
        return $this->renderTemplate('account-register.html.twig');
    }

    public function disconnectEvent()
    {
        session_destroy();
        header('Location: /account/login');
    }

   

    // public function deleteEvent($id)
    // {
    //     if ($_SESSION["accountId"] != "" ){
    //         $userModel = new UsersModel();
    //         $userModel->deleteEvent($id);
    //         header('Location: /account/');
    //     } 
    //     else {
    //         header('Location: /account/');
    //     }
    // }

    // public function editEvent($id)
    // {   
    //     if ($_SESSION["accountId"] != "" ) {
    //         if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['date'])){
    //             $userModel = new UsersModel();
    //             $userModel->editEvent($_POST['name'], $_POST['description'], $_POST['date'], $id);
    //             header('Location: /account/');
    //         }
    //         $this->renderTemplate('edit-create.html', [
    //             'id' => $id
    //         ]);
    //     }
    //     else {
    //         header('Location: /account/');
    //     }
    // }
    
    

    // public function createEvent()
    // {   
    //     if ($_SESSION["accountId"] != "" ) {
    //         if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['date']) && !empty($_POST['places']) && !empty($_POST['maxPlaces']) && $_POST["places"] > 5){
    //             $userModel = new UsersModel();
    //             $userModel->createEvent($_POST['name'], $_POST['description'], $_POST['date'], $_SESSION["accountId"], $_POST["places"], $_POST["maxPlaces"]);
    //             header('Location: /account/');
    //         }
    //         else{
    //             echo "Informations invalides";
    //         }
    //         $this->renderTemplate('event-create.html');
    //     } 
    //     else{
    //         header('Location: /account/');
    //     }
        
    // }

}
