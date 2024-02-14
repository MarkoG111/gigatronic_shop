<?php
session_start();

require_once "config/connection.php";

require_once "models/functions.php";
require_once "models/users/functions.php";
require_once "models/articles/functions.php";
require_once "models/polls/functions.php";
require_once "models/orders/functions.php";

require_once "views/fixed/head.php";
require_once "views/fixed/header.php";

if (isset($_GET['page'])) {
    $page = isset($_GET['page']) ? $_GET['page'] : null;

    switch ($page) {
        case "home":
            require_once "views/pages/home.php";
            recordAccessToPages();
            break;
        case "articles":
            require_once "views/pages/articles.php";
            recordAccessToPages();
            break;
        case "contact":
            require_once "views/pages/contact.php";
            recordAccessToPages();
            break;
        case "cart":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'user') {
                require_once "views/pages/cart.php";
                recordAccessToPages();
            }
            break;
        case "poll":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'user') {
                require_once "views/pages/poll.php";
                recordAccessToPages();
            }
            break;
        case "adminDashboard":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'admin') {
                require_once "views/pages/admin/adminDashboard.php";
            } else {
                require_once "views/pages/errors/403.php";
            }
            break;
        case "adminUsers":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'admin') {
                require_once "views/pages/admin/adminUsers.php";
            } else {
                require_once "views/pages/errors/403.php";
            }
            break;
        case "adminArticles":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'admin') {
                require_once "views/pages/admin/adminArticles.php";
            } else {
                require_once "views/pages/errors/403.php";
            }
            break;
        case "adminPoll":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'admin') {
                require_once "views/pages/admin/adminPoll.php";
            } else {
                require_once "views/pages/errors/403.php";
            }
            break;

        case "adminStatistics":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'admin') {
                require_once "views/pages/admin/adminStatistics.php";
            } else {
                require_once "views/pages/errors/403.php";
            }
            break;
        case "adminOrders":
            if (isset($_SESSION['user']) && $_SESSION['user']->roleName == 'admin') {
                require_once "views/pages/admin/adminOrders.php";
            } else {
                require_once "views/pages/errors/403.php";
            }
            break;
        case "thanksEmail":
            require_once "views/fixed/thanksEmail.php";
            recordAccessToPages();
            break;
        default:
            require_once "views/pages/errors/404.php";
            recordAccessToPages();
            break;
    }
} else {
    require_once "views/pages/home.php";
    recordAccessToPages();
}

require_once "views/fixed/modals.php";
require_once "views/fixed/footer.php";
