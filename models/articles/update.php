<?php

session_start();

if (isset($_POST['articleName']) && $_SESSION['user']->roleName == 'admin') {
    define("FILE_SIZE", 3000000);

    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST['hiddenArticleId'];
    $name = $_POST['articleName'];
    $description = $_POST['taDescription'];
    $price = $_POST['articlePrice'];
    $file = $_FILES['articleImage'];
    $alt = $_POST['articleImageAlt'];
    $category = $_POST['ddlAdminUpdateCat'];

    $errors = [];

    $reName = "/^[A-z\d\-\_]+(\s[A-z\d\-\_]+)*$/";
    $reDescription = "/^[\w\d\s\-\.\,]{1,255}$/";
    $rePrice = "/^\d+(\.\d{1,2})?$/";

    if (!preg_match($reName, $name)) {
        array_push($errors, "Name of article is not in good format.");
    }
    if (!preg_match($reDescription, $description)) {
        array_push($errors, "Description only contains letters, numbers and whitespace");
    }
    if (!preg_match($rePrice, $price)) {
        array_push($errors, "Price is not in good format.");
    }
    if (!preg_match($reName, $alt)) {
        array_push($errors, "Alt attribute is not in good format.");
    }
    if ($category == '0') {
        array_push($errors, "You must choose category.");
    }

    if ($file['name'] == '') {
        if (count($errors) > 0) {
            echo json_encode($errors);
        } else {
            if (updateArticleWithoutImage($id, $name, $description, $price, $alt, $category)) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    } else {
        $allowedFormats = ["image/jpeg", "image/jpg", "image/png", "image/gif"];

        $tmpName = $file["tmp_name"];
        $fileType = $file["type"];
        $fileSize = $file["size"];

        $fileName = time() . "_" . $name;

        $path = "../../assets/img/shop-new/" . $fileName;
        $pathDatabase = "assets/img/shop/" . $fileName;

        $pathDatabaseNew = $pathDatabase;
        $pathNew = "../../"  . $pathDatabaseNew;

        if (!in_array($fileType, $allowedFormats)) {
            array_push($errors, "File type is not allowed.");
        }
        if ($fileSize > FILE_SIZE) {
            array_push($errors, "Max file size is 3MB");
        }

        if (count($errors) > 0) {
            echo json_encode($errors);
        } elseif (move_uploaded_file($tmpName, $path)) {
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
            };

            if (updateArticleWithImage($id, $name, $description, $price, $pathDatabase, $pathDatabaseNew, $alt, $category)) {
                echo 'success';

                imagedestroy($existingImage);
                imagedestroy($newImage);
            } else {
                echo 'error';
            }
        }
    }
}
