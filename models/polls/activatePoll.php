<?php
session_start();

header("Content-Type: application/json");

if (isset($_POST['send']) && $_SESSION['user']->roleName == 'admin') {
    require_once "../../config/connection.php";

    $id = $_POST['id'];
    
    $code = 404;
    $data = null;

    try {
        $conn->beginTransaction();

        $deactive = $conn->prepare("UPDATE poll SET active = 0 WHERE idPoll <> ?");
        $deactive->execute([$id]);

        $activate = $conn->prepare("UPDATE poll SET active = 1 WHERE idPoll = ?");
        $activate->execute([$id]);

        $conn->commit();

        $code = 201;
        $data = ["message" => "Successfully activated poll."];
    } catch(PDOException $ex) {
        $conn->rollBack();
        $code = 500;
        recordErrors($ex->getMessage());
    }
}

echo json_encode($data);
http_response_code($code);