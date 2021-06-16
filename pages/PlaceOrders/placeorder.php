<?php session_start(); ?>

<?php
include "../../Database/connection.php";

// select item info from menu_items
$select_query = "SELECT * FROM menu_item ";
$seleted_data = mysqli_query($connection, $select_query);


if (isset($_POST["placeOrder"])) {

    // check item is selected or not
    if (!empty($_POST['itemSelected'])) {
        $item = $_POST['itemSelected'];
    } else {
        echo 'Please select the value.';
    }

    $quantity = $_POST["quantityItem"]; // quantity
    $totalAmt = $_POST["totalPrice"]; // total price
    $email = $_SESSION['email']; // received by


    // get item id from db
    $itemId_query = mysqli_query($connection, "SELECT id from menu_item  where id = '$item'");
    $itemId =  mysqli_fetch_array($itemId_query);
    $itemId = $itemId[0];

    // ordered by
    $orderBy_query  = mysqli_query($connection, "SELECT id from users_table where email = '$email'");
    $ordery =  mysqli_fetch_array($orderBy_query);
    $ordery = $ordery[0];

    // plae order
    if ($quantity != null && $totalAmt != null && $itemId != null && $ordery != null) {

        // query for placing order
        $order_query = "INSERT INTO orders_table(item_id,quantity,total_amount,received_by) VALUES('$itemId','$quantity','$totalAmt',$ordery) ";
        $orderPlaced = mysqli_query($connection, $order_query);

        if ($orderPlaced) {
?>
            <script>
                alert("Order Added !!");
                window.location.replace("http://localhost/kaliba/pages///PlaceOrders/placeorder.php")
            </script>
<?php
        }
    }
}

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="http://localhost/kaliba/pages///index.php">Take-A-Way</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=" #">
                            Add Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/kaliba/pages///Orders/orders.php">Records</a>
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

    <main class="d-flex align-items-center justify-content-cemnter">
        <div class="container">
            <h1 class="text-center text-danger my-3">Add Order</h1>

            <div class="row d-flex justify-content-center">
                <div class="col-sm-6 bg-dark text-white p-3">
                    <form method="POST" action="placeorder.php">

                        <div class="form-group my-3">
                            <label for="">Item</label>
                            <select onchange="ItemChanged(this.value)" id="items" name="itemSelected" class="form-select form-select-md" aria-label=".form-select-sm example">
                                <?php
                                while ($res = mysqli_fetch_array($seleted_data)) {
                                    echo '<option  value="' . $res['id'] . '" selected>' . $res['item_name'] . ' </option>';
                                }
                                ?>
                                <option selected disabled>Select Item</option>

                            </select>
                        </div>
                        <div class="form-group my-2" id="itemprice">
                            <label for="itemPrice">Price</label>
                            <input class="form-control" type="text" name="unitPrice" value="0" disabled>
                        </div>
                        <div class="form-group my-2">
                            <label for="quantity">Quantity</label>
                            <input onchange="QuantityChanged(this.value)" class="form-control" type="number" value="0" min="0" max="10" name="quantityItem" id="quantityItem">
                        </div>

                        <div class="form-group my-2">
                            <label for="totalPrice">Total Amount</label>
                            <input class="form-control" type="text" name="totalPrice" value="0" id="totalPrice">
                        </div>

                        <div class="form-group my-4 text-center">
                            <input type="submit" value="Place Order" name="placeOrder" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include "../../Bootstrap/script.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        let price = 0;
        let quantity = 0;
        const ItemChanged = (val) => {
            let item_id = val;
            $.ajax({
                type: "POST",
                url: "handleorders.php",
                data: {
                    item_id: item_id
                },
                cache: false,
                success: function(response) {
                    $("#itemprice").html(response);
                }
            });
            // price = document.getElementById("itemPrice").value;
            // quantity = document.getElementById("quantityItem"),value;
            // document.getElementById("totalPrice").value = price * quantity;

        }

        const QuantityChanged = (qnty) => {
            quantity = qnty;
            price = document.getElementById("itemPrice").value;

            // set total price

            document.getElementById("totalPrice").value = price * quantity;
        }
    </script>


</html>