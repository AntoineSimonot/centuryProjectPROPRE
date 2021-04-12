<?php 

namespace App\Controller;
// session_start();

use App\Model\TournamentModel;
use App\Model\TeamModel;
use App\Controller\UserController;
use Framework\Controller;
use Service\TournamentManager;
// -----------------------------------------------


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EmailController
{
    public function sendEmailInscription($email,$pseudo)
    {
        header('Location: /account/login');
        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'exoCentury@gmail.com';                 //SMTP username
            $mail->Password   = '0208200ASs';                           //SMTP password
            $mail->SMTPSecure = 'ssl';                                  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('exoCentury@gmail.com', 'Century');
            $mail->addAddress($email);     //Add a recipient         
            
            //Content
            $body = '
            <h1>Merci de vous être inscrit sur Century Project</h1>
            <p>Bonjour'.' '.'<strong>'.$pseudo.'</strong>' .' Bienvenue sur Century Project, la platforme officiel de gestion de tournois pour Century Age Of Ashes</p> <br>
            <p>Les Dragons vous attendent !</p> ';

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Information D\'Inscription';
            $mail->Body    = $body ;
            $mail->AltBody = strip_tags($body);
        
            $mail->send();
            echo 'Message has been sent';
    }

    public function sendEmailInscriptionToTournament($name,$date)
    {
        header('Location: /myTournaments');
        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'exoCentury@gmail.com';                 //SMTP username
            $mail->Password   = '0208200ASs';                           //SMTP password
            $mail->SMTPSecure = 'ssl';                                  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('exoCentury@gmail.com', 'Century');
            $mail->addAddress($_SESSION["userEmail"]);     //Add a recipient         
            
            //Content
            $body = '
            <h1>Welcome to Century Project</h1>
            <p>Bonjour'.' '.'<strong>'.$_SESSION["userEmail"].'</strong>' .' Vous vous êtes inscrit au Tournois'.' '.$name .'</p> <br>
            <p>Ce tounois aura lieu le '.$date.' </p> <br><br>
            <p>Les Dargons vous attendent </p> ';

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Information D\'Inscription';
            $mail->Body    = $body ;
            $mail->AltBody = strip_tags($body);
        
            $mail->send();
            echo 'Message has been sent';
    }


    public function sendEmailUnsub($name,$date)
    {
        header('Location: /myTournaments');
        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'exoCentury@gmail.com';                 //SMTP username
            $mail->Password   = '0208200ASs';                           //SMTP password
            $mail->SMTPSecure = 'ssl';                                  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('exoCentury@gmail.com', 'Century');
            $mail->addAddress($_SESSION["userEmail"]);     //Add a recipient         
            
            //Content
            $body = '
            <h1>Welcome to Century Project</h1>
            <p>Bonjour'.' '.'<strong>'.$_SESSION["userEmail"].'</strong>' .' Vous venez de vous désinscrire du Tournois'.' '.$name .', qui devez avoir lieu le '.$date.'</p> <br>  ';

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Désinscription de Tournois';
            $mail->Body    = $body ;
            $mail->AltBody = strip_tags($body);
        
            $mail->send();
            echo 'Message has been sent';
    }
}

?>