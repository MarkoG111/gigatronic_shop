<?php

header("Content-Type: application/json");

$data = null;
$code = 404;

if (isset($_POST['id'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    try {
        $data = getAllArticlesWithPagination();
        $code = 200;
    } catch (PDOException $ex) {
        $code = 500;
        recordErrors($ex->getMessage());
    }
    
}

echo json_encode($data);
http_response_code($code);