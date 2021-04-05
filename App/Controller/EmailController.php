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
    public function sendEmailInscription()
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'exoCentury@gmail.com';                     //SMTP username
            $mail->Password   = '0208200ASs';                               //SMTP password
            $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('exoCentury@gmail.com', 'Century');
            $mail->addAddress($_SESSION["userEmail"]);     //Add a recipient         
   
            //Content

            $body = '<p>This is a test</p>';
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Test';
            $mail->Body    = $body ;
            $mail->AltBody = strip_tags($body);
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>