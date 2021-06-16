<?php

// connection pre-requisits
$username = "root";
$password = "";
$server = "localhost";
$database = "take_a_way_restaurant";

// connection
$connection = mysqli_connect($server, $username, $password, $database);

if (!$connection) {
    die('Could not Connect My Sql:' . mysqli_connect_error());
}
