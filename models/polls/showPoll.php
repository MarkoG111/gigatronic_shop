<?php
session_start();

header("Content-Type: application/json");

$code = 404;
$data = null;

if (isset($_POST['send'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST['id'];

    try {
        $data = getResultOfSinglePoll($id);
        $code = 200;
    } catch(PDOException $ex) {
        $code = 500;
        recordErrors($ex->getMessage());
    }
}

echo json_encode($data);
http_response_code($code);