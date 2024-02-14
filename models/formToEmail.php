<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if (isset($_POST['send'])) {
    require_once "../assets/vendor/PHPMailer/src/PHPMailer.php";
    require_once "../assets/vendor/PHPMailer/src/SMTP.php";
    require_once "../assets/vendor/PHPMailer/src/Exception.php";

    require_once "../config/connection.php";

    $firstName = $_POST['userFirstName'];
    $lastName = $_POST['userLastName'];
    $visitor_email = $_POST['userEmail'];
    $message = $_POST['userMessage'];

    $errors = [];

    $reFirstName = "/^[A-Z][a-z]{1,14}$/";
    $reLastName = "/^[A-Z][a-z]{1,14}$/";
    $reMessage = "/^[\w\d\s\.\+\,]{1,255}$/";

    if (!preg_match($reFirstName, $firstName)) {
        array_push($errors, "First name is not in good format.");
    }
    if (!preg_match($reLastName, $lastName)) {
        array_push($errors, "Last name is not in good format.");
    }
    if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Your email is not in good format.");
    }
    if (!preg_match($reMessage, $message)) {
        array_push($errors, "Message must contain only letters, numbers and whitespace");
    }

    if (count($errors) > 0) {
        $_SESSION['contactErrors'] = $errors;
    } else {
        try {
            # create an instance of PHPMailer
            $mail = new PHPMailer(true);
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            # enable SMTP
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            # set a host
            $mail->Host = "smtp.gmail.com";
            # set authentication to true
            $mail->SMTPAuth = true;
            # set login details for Gmail account
            $mail->Username = "gacanoviccc97@gmail.com";
            $mail->Password = "wtwc bsvl xtqm ulae";

            # set type of protection
            $mail->SMTPSecure = 'tls';
            # set a port
            $mail->Port = 587;
            # set who is sending email
            $mail->setFrom($visitor_email, $firstName);
            # set where we are sending email
            $mail->addAddress("marko.gacanovic.38.17@ict.edu.rs", "Marko Gacanovic");
            $mail->isHTML(true);
            # set subject
            $mail->Subject = "New Form submission.";
            # set body
            $mail->Body = "You have received a new message from the user $firstName.\n" . "Here is the message:\n $message";
            # send an email
            $mail->send();
        } catch (Exception $ex) {
            recordErrors($ex->getMessage());
        }
    }
} else {
    echo "You need to submit the form!";
}
