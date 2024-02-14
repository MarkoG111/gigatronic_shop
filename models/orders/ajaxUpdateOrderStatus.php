<?php

session_start();

$code = 404;
$data = null;

if (isset($_POST['id']) && $_SESSION['user']->roleName == 'admin') {
  require_once "../../config/connection.php";
  require_once "functions.php";

  $id = $_POST['id'];
  $status = $_POST['status'];

  try {
    $data = updateOrderStatus($id, $status);
    $code = $data ? 204 : 500;
  } catch(PDOException $ex) {
    $code = 500;
    recordErrors($ex->getMessage());
  }
}

echo json_encode($data);
http_response_code($code);