<?php

$code = 404;

if (isset($_POST['id'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST['id'];

    $result = deleteUser($id);
    $code = $result ? 204 : 500;
} else {
    $code = 400;
}

http_response_code($code);
