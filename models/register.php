<?php
header("Content-Type: application/json");

$code = 404;
$data = null;

if (isset($_POST['send'])) {
    require_once "../config/connection.php";
    require_once "users/functions.php";

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = [];

    $reFirstLastName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,15}$/";
    $reUsername = "/^[a-zšđčćž0-9\_]{4,15}$/";
    $rePassword = "/^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{6,32}$/";
    

    if (!preg_match($reFirstLastName, $firstName)) {
        array_push($errors, "Fist Name field isn't proprely filled!");
    } elseif (!$firstName) {
        array_push($errors, "First Name is required!");
    }
    if (!preg_match($reFirstLastName, $lastName)) {
        array_push($errors, "Last Name field isn't proprely filled!");
    } elseif (!$lastName) {
        array_push($errors, "Last Name is required!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email isn't in good format!");
    }
    if (!preg_match($reUsername, $username)) {
        array_push($errors, "Username field isn't proprely filled!");
    } elseif (!$username) {
        array_push($errors, "Username is required!");
    }
    if (!preg_match($rePassword, $password)) {
        array_push($errors, "Password field isn't proprely filled!");
    } elseif (!$password) {
        array_push($errors, "Password is required!");
    }

    if (count($errors)) {
        $code = 422;
        $data = $errors; #indicates that the server understands the content type of the request entity, and the syntax of the request entity is correct, but it was unable to process the contained instructions.
    } else {
        $password = md5($password);
        $user_register = registerUser($firstName, $lastName, $email, $username, $password, 1, 2);

        try {
            $code = $user_register ? 201 : 500;
        } catch (PDOException $ex) {
            recordErrors($ex->getMessage());
            $code = 409; #indicates a request conflict with current state of the server.
        }
    }
} else {
    $code = 400;
}

http_response_code($code);
echo json_encode($data);
