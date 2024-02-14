<?php

header("Content-Type: application/json");

require_once "../../config/connection.php";
require_once "functions.php";

$code = 404;
$data = null;

$users = getAllUsers();

if ($users) {
  $data = $users;
  $code = 200;
} else {
  $code = 500;
}

http_response_code($code);
echo json_encode($data);
