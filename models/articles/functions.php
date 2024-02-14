<?php

function getAllArticlesFeatured()
{
    try {
        return executeQuery("SELECT * FROM article ORDER BY price DESC LIMIT 0,4");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getAllArticlesWithPagination()
{
    try {
        $page = ($_POST['id'] - 1) * 6;
        return executeQuery("SELECT * FROM article LIMIT $page, 6");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getNumberOfArticles()
{
    global $conn;

    try {
        return $conn->query("SELECT COUNT(*) AS numOfArticles FROM article")->fetch();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getArticlesPerCategory($id)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT COUNT(*) AS numOfArticles FROM article WHERE idCategory = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getArticlesBySearchValue($text)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM article WHERE name LIKE LOWER(?)");
        $stmt->execute([$text]);
        return $stmt->fetchAll();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getAllArticles()
{
    try {
        return executeQuery("SELECT a.*, c.name AS categoryName FROM article a INNER JOIN category c ON a.idCategory = c.idCategory");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getOneArticle($id)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM article WHERE idArticle = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function insertArticle($articleName, $description, $price, $path_database, $path_database_new, $alt, $category)
{
    global $conn;

    try {
        $query = "INSERT INTO article (name, description, price, image, newImage, alt, idCategory) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$articleName, $description, $price, $path_database, $path_database_new, $alt, $category]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function updateArticleWithImage($id, $name, $description, $price, $path_database, $path_database_new, $alt, $category)
{
    global $conn;

    try {
        $query = "UPDATE article SET name = ?, description = ?, price = ?, image = ?, newImage = ?, alt = ?, idCategory = ? WHERE idArticle = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$name, $description, $price, $path_database, $path_database_new, $alt, $category, $id]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function updateArticleWithoutImage($id, $name, $description, $price, $alt, $category)
{
    global $conn;

    try {
        $query = "UPDATE article SET name = ?, description = ?, price = ?, alt = ?, idCategory = ? WHERE idArticle = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$name, $description, $price, $alt, $category, $id]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function deleteArticle($id)
{
    global $conn;

    try {
        $query = "DELETE FROM article WHERE idArticle = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}
