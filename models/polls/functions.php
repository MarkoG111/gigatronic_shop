<?php

function getAllPolls()
{
    try {
        return executeQuery("SELECT * FROM poll");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getActivePoll()
{
    global $conn;

    try {
        return $conn->query("SELECT * FROM poll WHERE active = 1")->fetch();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getActivePollAnswers()
{
    try {
        return executeQuery("SELECT * FROM poll p INNER JOIN answer a ON p.idPoll = a.idPoll WHERE p.active = 1");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function ifVoted($id)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM poll p INNER JOIN answer a ON p.idPoll = a.idPoll INNER JOIN voting v ON a.idAnswer = v.idAnswer WHERE p.active = 1 AND v.idUser = ?");
        $stmt->execute([$id]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function voting($idAnswer, $idUser)
{
    global $conn;

    try {
        $vote = $conn->prepare("INSERT INTO voting(idAnswer, idUser) VALUES(?,?)");
        return $vote->execute([$idAnswer, $idUser]);
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}
 
function getResultOfSinglePoll($id) {
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT a.answer, COUNT(v.idAnswer) AS num FROM answer a LEFT OUTER JOIN voting v ON a.idAnswer = v.idAnswer WHERE a.idPoll = ? GROUP BY a.answer");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}