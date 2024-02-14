<?php

function getAllUsers()
{
    try {
        return executeQuery("SELECT * FROM user u INNER JOIN role r ON u.idRole = r.idRole");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getOneUser($id)
{
    global $conn;

    try {
        $query = "SELECT * FROM user AS u JOIN role AS r ON u.idRole = r.idRole WHERE u.idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getAllRoles()
{
    try {
        return executeQuery("SELECT * FROM role");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getLatestUsers()
{
    try {
        return executeQuery("SELECT * FROM user ORDER BY dateRegistration DESC LIMIT 0,5");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function loginUser($email, $password)
{
    global $conn;

    try {
        $query = "SELECT u.*, r.name AS roleName FROM user AS u INNER JOIN role AS r ON u.idRole = r.idRole WHERE u.email = ? AND u.password = MD5(?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email, $password]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function loginAttempt($email)
{
    global $conn;

    try {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function recoredLogin($id)
{
    $open = fopen(LOGIN_FILE, "a");
    $data = $id . "\n";
    fwrite($open, $data);
    fclose($open);
}

function deleteLogin($id)
{
    $id = (int) $id;
    $string = "";
    $file = file(LOGIN_FILE);

    if (count($file)) {
        foreach ($file as $row) {
            $row = trim((int) $row);

            if ($row != $id) {
                $string .= $row . "\n";
            }
        }
    }

    $open = fopen(LOGIN_FILE, "w");
    fwrite($open, $string);
    fclose($open);
}

function countLoggedUsers()
{
    return count(file(LOGIN_FILE));
}

function registerUser($firstName, $lastName, $email, $username, $password, $active, $idRole)
{
    global $conn;

    try {
        $query = "INSERT INTO user (firstName, lastName, email, username, password, active, idRole) VALUES (?, ?, ?, ?, MD5(?), ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$firstName, $lastName, $email, $username, $password, $active, $idRole]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function updateUserWithoutPassword($idUser, $firstName, $lastName, $email, $username, $active, $role)
{
    global $conn;

    try {
        $query = "UPDATE user SET firstName = ?, lastName = ?, email = ?, username = ?, active = ?, dateModified = CURRENT_TIMESTAMP(), idRole = ? WHERE idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$firstName, $lastName, $email, $username, $active, $role, $idUser]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function updateUserWithPassword($firstName, $lastName, $email, $password, $username, $active, $role, $idUser)
{
    global $conn;

    try {
        $password = md5($password);
        $query = "UPDATE user SET firstName = ?, lastName = ?, email = ?, username = ?, password = ?, active = ?, dateModified = CURRENT_TIMESTAMP(), idRole = ? WHERE idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$firstName, $lastName, $email, $username, $password, $active, $role, $idUser]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function deleteUser($id)
{
    global $conn;

    try {
        $query = "DELETE FROM user WHERE idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function countUsers()
{
    global $conn;

    try {
        return $conn->query("SELECT COUNT(*) AS userCount FROM user")->fetch();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}
