<?php

$code = 404;

if (isset($_POST['id'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST['id'];

    $originalImage = "../../" . $_POST["originalImage"];
    $newImage = "../../" . $_POST["newImage"];

    $result = deleteArticle($id);
    $code = $result ? 204 : 500;

    unlink($originalImage);
    unlink($newImage);
} else {
    $code = 400;
}

http_response_code($code);