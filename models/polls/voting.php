<?php
session_start();

header("Content-Type: application/json");

$data = null;
$code = 404;

if (isset($_POST['send']) && $_SESSION['user']->roleName == 'user') {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST['id'];
    $answer = $_POST['answer'];

    try {
        $ifVoted = ifVoted($id);

        if ($ifVoted->rowCount() == 0) {
            if (voting($answer, $id)) {
                $data = ["message" => "Successfully voted."];
                $code = 201;
            } 
            else {
                $code = 500;
                $data = ["message" => "Error occured while voting."];
                recordErrors($ex->getMessage());
            }
        } 
        else {
            $code = 409;
            $data = ["message" => "Already voted."];
        }
    } catch(PDOException $ex) {
        $code = 409;
    }
}

echo json_encode($data);
http_response_code($code);