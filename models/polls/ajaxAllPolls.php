<?php

header("Content-Type: application/json");

$data = null;
$code = 404;

try {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $data = getAllPolls();
    $code = 200;
} catch(PDOException $ex) {
    $code = 500;
    recordErrors($ex->getMessage());
}

echo json_encode($data);
http_response_code($code);