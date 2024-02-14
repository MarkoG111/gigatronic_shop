<?php

header("Content-Type: application/json");

$data = null;
$code = 404;

if (isset($_POST['send'])) {
    require_once "../../config/connection.php";

    $page = ($_POST['idPagination'] - 1) * 6;
    $idCategory = $_POST['idCategory'];
    $idSort = $_POST['idSort'];

    $query = "SELECT * FROM article ";

    if ($idCategory != '0') {
        $query .= "WHERE idCategory=:idCategory ORDER BY ";
    } else {
        $query .= "ORDER BY ";
    }

    if ($idSort == '1') {
        $query .= "price ";
    } else {
        $query .= "price DESC ";
    }

    $query .= "LIMIT 6 OFFSET $page";
  
    $stmt = $conn->prepare($query);

    if ($idCategory != '0') {
        $stmt->bindParam(":idCategory", $idCategory);
    }

    try {
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            $code = 200;
        } else {
            $code = 500;
        }
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
        $code = 500;
    }
} else {
    $code = 400;
}

http_response_code($code);
echo json_encode($data);