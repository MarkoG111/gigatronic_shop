<?php
$code = 404;
$data = null;

if (isset($_POST['id'])) {
    header("Content-Type: application/json");

    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST['id'];

    try {
        $data = getOneUser($id);
        $code = 200;
    } catch (PDOException $ex) {
        $code = 500;
        recordErrors($ex->getMessage());
    }
} else {
    $code = 400;
}

http_response_code($code);
echo json_encode($data);
