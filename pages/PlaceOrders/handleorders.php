<?php session_start(); ?>

<?php
include "../../Database/connection.php";

// hangle price of items
if (isset($_POST["item_id"])) {

    $item_id = $_POST['item_id'];
    // extract price of item
    $sql = "SELECT * FROM menu_item WHERE id = '$item_id'";
    $query = mysqli_query($connection, $sql);

    // return price as per given item id
    while ($res1 = mysqli_fetch_array($query)) {
        // echo '<div class="form-group my-2"> ';
        echo '<label for="price">Price</label>';
        echo '<input class="form-control" value="' . $res1["price"] . '" type="text" name="unitPrice" id="itemPrice" disabled>';
        // echo "</div>";
    }
}
?>