<?php
require_once "../config/connection.php";
require_once "users/functions.php";

session_start();

deleteLogin($_SESSION['user']->idUser);
unset($_SESSION['user']);

header("Location: ../index.php");