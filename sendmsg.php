<?php

//Open a new connection to the MySQL server
$mysqli = new mysqli('localhost', 'root', 'root', 'perfectcup');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$message= mysqli_real_escape_string($mysqli, $_POST['message']);

$email2 = "paynemax624@gmail.com";
$subject = "Test Message";

if (strlen($fname) > 50) {
    echo 'fname_long';

} elseif (strlen($fname) < 2) {
    echo 'fname_short';

} elseif (strlen($email) > 50) {
    echo 'email_long';

} elseif (strlen($email) < 2) {
    echo 'email_short';

} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'eformat';

} elseif (strlen($message) > 500) {
    echo 'message_long';

} elseif (strlen($message) < 3) {
    echo 'message_short';

} else {
	
	 //MAILER

     require "vendor/autoload.php";

     $robo = 'paynemax624@gmail.com';
     
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;
     
     
     $developmentMode = true;
     $mailer = new PHPMailer($developmentMode);
     
         $mailer->SMTPDebug = 2;
         $mailer->isSMTP();
     
         if ($developmentMode) {
         $mailer->SMTPOptions = [
             'ssl'=> [
             'verify_peer' => false,
             'verify_peer_name' => false,
             'allow_self_signed' => true
             ]
         ];
         }
     
     
         $mailer->Host = 'mail.door2doorhub.in';
         $mailer->SMTPAuth = true;
         $mailer->Username = 'tech_team@door2doorhub.in';
         $mailer->Password = 'maxpayne1307';
         $mailer->SMTPSecure = 'tls';
         $mailer->Port = 465;
     
         $mailer->setFrom('tech_team@door2doorhub.in', 'Name of sender');
         $mailer->addAddress('paynemax624@gmail.com', 'Name of recipient');
     
         $mailer->isHTML(true);
         $mailer->Subject = 'PHPMailer Test';
         $mailer->Body = 'This is a <b>SAMPLE<b> email sent through <b>PHPMailer<b>';
     
         $mailer->send();
         $mailer->ClearAllRecipients();
         echo "MAIL HAS BEEN SENT SUCCESSFULLY";
     
     

    if (!$mailer->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'true';
    }


}
?>