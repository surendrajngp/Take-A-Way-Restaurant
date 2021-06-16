<?php session_start(); ?>
<?php

include "../../../kaliba/Database/connection.php";

// list order for active user
if (isset($_SESSION['email'])) {
    $active_email = $_SESSION['email'];
} else {
    $active_email = "";
}

// retrieve records
$sql = "SELECT * FROM all_records where email = '$active_email' ORDER BY id";

$query = mysqli_query($connection, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../../Bootstrap/css.php" ?>
    <link rel="stylesheet" href="../style.css">
    <title>Restaurant</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="http://localhost/kaliba/pages///index.php">Take-A-Way</a>
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
                        <a class="nav-link active" href="http://localhost/kaliba/pages//Orders//orders.php">Records</a>
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
    <main class="d-flex justify-content-cemnter">
        <div class="container mt-5">
            <h1 class="text-center text-danger">All Records</h1>
            <!-- Orders table -->
            <table class="table table-dark table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- List of orders -->
                    <?php while ($records = mysqli_fetch_array($query)) {
                        echo '
                    <tr>
                    <th scope="row">' . $records["id"] . '</th>
                    <td>' . $records["item_name"] . '</td>
                    <td>Rs. ' . $records["total_amount"] . '</td>
                    <td>' . $records["DATE"] . '</td>
                    </tr>
                    ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>