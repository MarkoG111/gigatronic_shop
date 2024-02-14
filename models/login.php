<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if (isset($_POST['loginEmail'])) {
    require_once "../config/connection.php";
    require_once "users/functions.php";

    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $rePassword = "/^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{6,32}$/";
    
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not good!";
    }

    if (!preg_match($rePassword, $password)) {
        $errors[] = "Password is not good!";
    }

    if (count($errors) > 0) {
        echo "wrong_credentials";
    } else {
        $password = md5($password);

        $login = loginUser($email, $password);

        if ($login->rowCount() == 1) {
            $user = $login->fetch();

            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user->idUser;

            recoredLogin($user->idUser);
            
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'admin') {
                echo "admin";
            } else {
                echo "home";
            }
        } else {
            $attempt_login = loginAttempt($email);

            require_once "../assets/vendor/PHPMailer/src/PHPMailer.php";
            require_once "../assets/vendor/PHPMailer/src/SMTP.php";
            require_once "../assets/vendor/PHPMailer/src/Exception.php";

            if ($attempt_login->rowCount() == 1) {
                try {
                    $mail = new PHPMailer(true);

                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "gacanoviccc97@gmail.com";
                    $mail->Password = "wtwc bsvl xtqm ulae";
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom("gacanoviccc97@gmail.com");
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "Message from 'Gigatronic' web shop";
                    $mail->Body = "Someone attempted to login with your email.";
                    $mail->send();
                } catch (Exception $ex) {
                    recordErrors($ex->getMessage());
                }

                echo "wrong_password";
            } else {
                echo "user_not_found";
            }
        }
    }
}
