<?php
session_start();

define("FILE_SIZE", 3000000);

if (isset($_POST['articleName']) && $_SESSION['user']->roleName == 'admin') {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $errors = [];

    $articleName = $_POST['articleName'];
    $description = $_POST['articleDescription'];
    $price = $_POST['articlePrice'];
    $alt = $_POST['articleImageAlt'];
    $category = $_POST['ddlCategory'];

    $reArticleName = "/^[\w\s\-\_\.]{1,255}$/";
    if (!preg_match($reArticleName, $articleName)) {
        array_push($errors, "Article name is not in good format.");
    }

    if ($description == '') {
        array_push($errors, "Description must be filled.");
    }

    $rePrice = "/^\d+(\.\d{1,2})?$/";

    if (!preg_match($rePrice, $price)) {
        array_push($errors, "Price is not in good format.");
    }

    if (!preg_match($reArticleName, $alt)) {
        array_push($errors, "Alt attribute is not in good format.");
    }

    if ($category == "0") {
        array_push($errors, "You must choose category.");
    }

    $file = $_FILES['fileArticleImage'];
    $fileType = $file['type'];
    $fileSize = $file['size'];

    $allowedFormats = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
    if (!in_array($fileType, $allowedFormats)) {
        array_push($errors, "File format is not image.");
    }

    if ($fileSize > FILE_SIZE) {
        array_push($errors, "Maximum allowed format is 3 MB");
    }

    if (count($errors) == 0) {
        $tmpPath = $file['tmp_name'];
        $name = $file['name'];
        $fileName = time() . "_" . $name; // time() if we don't want to have upload at same time

        $path = "../../assets/img/shop-new/" . $fileName;
        $pathDatabase = "assets/img/shop/" . $fileName;

        $pathDatabaseNew = $pathDatabase;
        $pathNew = "../../"  . $pathDatabaseNew;

        $upload = move_uploaded_file($tmpPath, $path);

        if ($upload) {
            $x = 100;
            $y = 120;

            list($width, $height) = getimagesize($path);

            if ($fileType == "image/jpeg") {
                $existingImage = imagecreatefromjpeg($path);
            } elseif ($fileType == "image/png") {
                $existingImage = imagecreatefrompng($path);
            } elseif ($fileType == "image/gif") {
                $existingImage = imagecreatefromgif($path);
            }

            $newWidth = $x;
            $newHeight = $height / ($width / $newWidth);

            $smallerImage = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresampled($smallerImage, $existingImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            if ($newWidth > $x) {
                $moveExisting = ($newWidth - $x) / 2;
                $moveNew = 0;
            } elseif ($newWidth < $x) {
                $moveExisting = 0;
                $moveNew = ($x - $newWidth) / 2;
            } else {
                $moveExisting = 0;
                $moveNew = 0;
            }

            $newImage = imagecreatetruecolor($x, $y);

            imagecopyresampled($newImage, $smallerImage, $moveNew, 0, $moveExisting, 0, $x, $y, $x, $y);

            if ($fileType == "image/jpeg") {
                imagejpeg($newImage, $pathNew);
            } elseif ($fileType == "image/png") {
                imagepng($newImage, $pathNew);
            } elseif ($fileType == "image/gif") {
                imagegif($newImage, $pathNew);
            }

            $uploadArticle = insertArticle($articleName, $description, $price, $pathDatabase, $pathDatabaseNew, $alt, $category);

            if ($uploadArticle) {
                imagedestroy($existingImage);
                imagedestroy($newImage);

                echo 'success';
                http_response_code(201);
            }
        } 
    } else {
        echo json_encode($errors);
        http_response_code(500);
    }
}
