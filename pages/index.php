<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../Bootstrap/css.php" ?>
    <link rel="stylesheet" href="./style.css">
    <title>Restaurant</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Take-A-Way</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/kaliba/pages///PlaceOrders/placeorder.php">
                            Add Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Orders/orders.php">Records</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['name'])) : ?>
                            <a class="nav-link" href="http://localhost/kaliba/pages///Login/logout.php">logout</a>
                        <?php else : ?>
                            <a class="nav-link" href="http://localhost/kaliba/pages///Login/login.php">login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home Page Main -->
    <main class="d-flex align-items-center justify-content-cemnter">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="./Logo.svg" alt="" class="img-fluid mt-5">
                </div>
                <div class="col-sm-6 d-flex flex-column justify-content-center">
                    <h1 class="text-center mt-3">Take A Way Restaurant</h1>
                    <h1 class="text-center mt-3"> Welcome <span class=" text-danger"> <?php if (!empty($_SESSION['name'])) {
                                                                                            echo $_SESSION['name'];
                                                                                        } ?> </span></h1>
                </div>
            </div>
        </div>
    </main>
    <!-- --------- -->

    <!-- bOOTSTRAP JS -->
    <?php include "../Bootstrap/script.php" ?>
</body>

</html>