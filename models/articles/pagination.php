<?php

header("Content-Type: application/json");

$data = null;
$code = 404;

if (isset($_POST['id'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";
    
    try {
        $id = $_POST['id'];
        
        if ($id != 0) {
            $data = getArticlesPerCategory($id);
        } else {
            $data = getNumberOfArticles();
        } 

        $code = 200;
    } catch(PDOException $ex) {
        recordErrors($ex->getMessage());
        $code = 500;
    }
}

http_response_code($code);
echo json_encode($data);