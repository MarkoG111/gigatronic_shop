<?php
session_start();

if (isset($_POST['idArticle'])) {
    require "../../config/connection.php";

    $id = $_POST['idArticle'];

    $query = "SELECT * FROM article WHERE idArticle = $id";
    $result = $conn->query($query);

    $output = '';
    $output .= '
        <div class="row">
            <div class="col text-center">
    ';
    if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'user') {
        foreach ($result as $row) {
            $output .= '
            <div class="shop-item">
                <img src="' . $row->image . '" class="img-fluid mx-auto" alt="' . $row->alt . '" />
                <h2 class="my-2">' . $row->name . '</h2>
                <h2 class="article-price">' . $row->price . ' &euro;</h2>
                <p class="lead text-muted">
                    ' . $row->description . '
                </p>
                <div class="d-flex flex-wrap">
                    <button class="btn btn-outline-success my-2 mx-2 add-to-cart" data-id="'.$row->idArticle.'">Add to cart</button>
                </div>
            </div>
        ';
        }
    } else {
        foreach ($result as $row) {
            $output .= '
            <img src="' . $row->image . '" class="img-fluid mx-auto" alt="' . $row->alt . '" />
            <h2 class="my-2">' . $row->name . '</h2>
            <h2>$' . $row->price . '</h2>
            <p class="lead text-muted">
                ' . $row->description . '
            </p>
            <div class="d-flex flex-wrap align-items-center">
                <p class="text-warning ml-3 mt-2 font-weight-bold">If you want to buy, you must login first.</p>
            </div>
        ';
        }
    }

    $output .= "</div></div>";
    echo $output;
}
