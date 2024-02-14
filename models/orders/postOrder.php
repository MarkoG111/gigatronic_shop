<?php
session_start();

header("Content-Type: application/json");

$code = 404;
$data = null;

if (isset($_POST['send']) && $_SESSION['user']->roleName == 'user') {
  require_once "../../config/connection.php";
  require_once "functions.php";

  $idUser = $_POST['idUser'];
  $totalAmount = $_POST['totalAmount'];
  $obj = $_POST['obj'];

  try {
    $conn->beginTransaction();

    insertOrder($idUser, $totalAmount);

    $idOrder = $conn->lastInsertId();

    insertOrderItems($obj, $idOrder);

    $conn->commit();

    $code = 201;
    $data = ["message" => "Successfully placed order."];
  } catch (PDOException $ex) {
    $conn->rollBack();
    $code = 500;
    recordErrors($ex->getMessage());
  }
} else {
  $code = 400;
}

echo json_encode($data);
http_response_code($code);