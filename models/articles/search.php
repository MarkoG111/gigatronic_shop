<?php

header("Content-Type: application/json");

$code = 404;
$data = null;

if (isset($_POST['send'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $text = trim($_POST['searchValue']);
    $text = "%$text%";

    try {
        $data = getArticlesBySearchValue($text);
        $code = 200;
    } catch(PDOException $ex) {
        $code = 500;
        recordErrors($ex->getMessage());
    }
}

http_response_code($code);
echo json_encode($data);
