<!-- Header -->
<header>
    <div class="container-fluid">
        <div class="row bg-dark">
            <div class="col-12 col-sm-12 col-md-4">
                <div class="btn-group">
                    <button class="btn border dropdown-toggle my-2 my-md-4 text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USD</button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">EU - Euro</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 text-center">
                <a href="#">
                    <h1 class="my-md-3 site-title primary-color text-uppercase">Gigatronic Shop</h1>
                </a>
            </div>
            <div class="col-12 col-md-4 text-right">
                <p class="my-md-4 header-links">
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <a href="#" class="px-4" data-target="#loginModal" data-toggle="modal">Sign In</a>
                        <a href="#" class="px-1" data-target="#registrationModal" data-toggle="modal">Create Account</a>
                    <?php else : ?>
                        <a href="models/logout.php">Logout</a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-darkest">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    $menuVisitors = getMenuForAllUsers();
                    foreach ($menuVisitors as $mv) :
                    ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?page=<?= $mv->menuLink ?>"><?= $mv->menuText ?></a>
                        </li>
                    <?php endforeach; ?>

                    <?php if (isset($_SESSION['user'])) :
                        if (($_SESSION['user']->roleName === 'admin')) :
                            $menuAdmin = getMenuForAdmin();
                            foreach ($menuAdmin as $ma) :
                    ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php?page=<?= $ma->menuLink ?>"><?= $ma->menuText ?></a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['user'])) :
                        if ($_SESSION['user']->roleName === 'user') :
                            $menuUser = getMenuForAuthorizedUsers();
                            foreach ($menuUser as $mu) :
                    ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php?page=<?= $mu->menuLink ?>"><?= $mu->menuText ?></a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>

        </nav>
    </div>

    <div class="container-fluid gray-container py-2 ">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <i class="fa fa-user"></i>
                <span class="mr-4">
                    User
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo "/ " . $_SESSION['user']->firstName . " " . $_SESSION['user']->lastName;
                    }
                    ?>
                </span>
            </div>

            <div class="col-md-4">
                <i class="fa fa-phone"></i>
                <span>Call Center: </span>
                <span>+381 69 331 805</span>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->