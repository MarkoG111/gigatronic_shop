<?php
session_start();

if (isset($_POST['tbFirstName']) && $_SESSION['user']->roleName == 'admin') {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $idUser = $_POST['hiddenUserId'];
    $firstName = $_POST['tbFirstName'];
    $lastName = $_POST['tbLastName'];
    $email = $_POST['tbEmail'];
    $username = $_POST['tbUsername'];
    $password = $_POST['tbPassword'];
    $role = $_POST['ddlRole'];

    $currentDateTime = date("Y-m-d H:i:s");

    $active = isset($_POST['chbActive']) ? $_POST['chbActive'] : 0;

    $reFirstLastName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,15}$/";
    $reUsername = "/^[a-zšđčćž0-9\_]{4,15}$/";
    $rePassword = "/^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{6,32}$/";

    $errors = [];

    if (!preg_match($reFirstLastName, $firstName)) {
        array_push($errors, "First Name isn't in good format!");
    }
    if (!preg_match($reFirstLastName, $lastName)) {
        array_push($errors, "Last Name isn't in good format!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email isn't in good format!");
    }
    if (!preg_match($reUsername, $username)) {
        array_push($errors, "Username isn't in good format!");
    }
    if ($role == 0) {
        array_push($errors, "You didn't choose role!");
    }

    if (count($errors)) {
        echo json_encode($errors);
    } else {
        if ($password == "") {
            if (updateUserWithoutPassword($idUser, $firstName, $lastName, $email, $username, $active, $role)) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            if (!preg_match($rePassword, $password)) {
                echo 'password';
            } else {
                $password = md5($password);

                if (updateUserWithPassword($firstName, $lastName, $email, $password, $username, $active, $role, $idUser)) {
                    echo 'success';
                } else {
                    echo 'error';
                }
            }
        }
    }
}
