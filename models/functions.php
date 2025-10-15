<?php

function getMenuForAllUsers()
{
    try {
        return executeQuery("SELECT * FROM menu WHERE idMenuGroup = 1");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getMenuForAuthorizedUsers()
{
    try {
        return executeQuery("SELECT * FROM menu WHERE idMenuGroup = 2");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getMenuForAdmin()
{
    try {
        return executeQuery("SELECT * FROM menu WHERE idMenuGroup = 3");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getCategories()
{
    try {
        return executeQuery("SELECT * FROM category");
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getAllPages()
{
    try {
        return ["Home", "Articles", "Contact", "Cart", "Poll", "Thanks", "404"];
    } catch (PDOException $ex) {
        recordErrors($ex->getMessage());
    }
}

function getPageTrafficData()
{
    $array = [];
    $sum = 0;

    $home = 0;
    $articles = 0;
    $contact = 0;
    $cart = 0;
    $poll = 0;
    $thanksEmail = 0;
    $notFound = 0;

    $yesterday = strtotime("1 day ago");

    $file = file(LOG_ACESS_FILE);

    if (count($file)) {
        foreach ($file as $row) {
            $part = explode("\t", $row);

            if (count($part) < 2) {
                continue;
            }

            $url = explode(".php", $part[0]);
            if (count($url) < 2) {
                continue;
            }

            $page = explode("&", $url[1]);
            $pageName = $page[0] ?? '';

            // '26.04.2020 17:42:38'
            if (strtotime($part[1]) >= $yesterday) {
                switch ($pageName) {
                    case "?page=home":
                        $home++;
                        $sum++;
                        break;
                    case "?page=articles":
                        $articles++;
                        $sum++;
                        break;
                    case "?page=contact":
                        $contact++;
                        $sum++;
                        break;
                    case "?page=cart":
                        $cart++;
                        $sum++;
                        break;
                    case "?page=poll":
                        $poll++;
                        $sum++;
                        break;
                    case "?page=thanksEmail":
                        $thanksEmail++;
                        $sum++;
                        break;
                    case "?page=404":
                        $notFound++;
                        $sum++;
                        break;
                    default:
                        $home++;
                        $sum++;
                        break;
                }
            }
        }

        if ($sum > 0) {
            $array["home"] = round($home * 100 / $sum, 2);
            $array["articles"] = round($articles * 100 / $sum, 2);
            $array["contact"] = round($contact * 100 / $sum, 2);
            $array["cart"] = round($cart * 100 / $sum, 2);
            $array["poll"] = round($poll * 100 / $sum, 2);
            $array["notFound"] = round($notFound * 100 / $sum, 2);
            $array["thanksEmail"] = round($thanksEmail * 100 / $sum, 2);
        }
    }

    return $array;
}
