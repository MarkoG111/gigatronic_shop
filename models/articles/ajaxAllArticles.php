<?php

header("Content-Type: application/json");

require_once "../../config/connection.php";
require_once "functions.php";

$code = 404;
$data = null;

$articles = getAllArticles();

if ($articles) {
    $data = $articles;
    $code = 200;
} else {
    $code = 500;
}

http_response_code($code);
echo json_encode($data);