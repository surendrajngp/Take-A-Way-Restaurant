<?php session_start(); ?>
<?php
include "../../Database/connection.php";
if (isset($_POST["signup"])) {
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);

    // get existing email from db
    $queryEmail = "SELECT * FROM users_table where email = '$email'";

    $getEmail = mysqli_query($connection, $queryEmail);

    // checking for existing user
    if (mysqli_num_rows($getEmail) > 0) {
        echo "Email Already Exists !";
        exit;
    }
    // if no existing user
    else {
        $queryRegister = "INSERT INTO users_table(name,email,password) VALUES('$name' , '$email' , '$password')";

        $register = mysqli_query($connection, $queryRegister);

        if ($register) {
?>
            <script>
                alert("Registration Successful");
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Registration Denied");
            </script>
<?php
        }
    }
}
// Sign IN
if (isset($_POST["signin"])) {

    $email = $_POST["email"];
    $password = mysqli_real_escape_string($connection, $_POST["password"]);

    // looking for existing user
    $queryEmail = "SELECT * FROM users_table where email = '$email'";
    $getEmail = mysqli_query($connection, $queryEmail);


    if (mysqli_num_rows($getEmail) > 0) {
        $all_data = mysqli_fetch_assoc($getEmail);
        $db_password =  $all_data["password"];
        $_SESSION['name'] = $all_data['name'];
        $_SESSION['email'] = $all_data['email'];
        $_SESSION["active"] = true;

        if ($password == $db_password) {
            echo "Login Successful";
            header('location: ../index.php');
        } else {
            echo "Incorrent Password";
        }
    } else {
        echo "incorrect Email";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./loginSignup.css">

    <title>Login SignUp</title>
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
                            <a class="nav-link active" href="http://localhost/kaliba/pages///Login/login.php">login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Login Form -->
    <div class="formContainer">
        <div class="toggle-buttons">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" id="toggleLogin" onclick="openLogin()">Login</button>
            <button type="button" class="toggle-btn" id="toggleSignup" onclick="openSignup()">SignUp</button>
        </div>

        <!-- login form-->
        <form id="login" class="login-form d-flex flex-column" method="POST">
            <input type="text" name="email" id="email" placeholder="Email...">
            <input type="password" name="password" id="password" placeholder="Password...">
            <div class="d-flex align-items-center justify-content-between mt-3">
                <input type="submit" name="signin" value="Sign In">
                <span>Don't have account ? <a href="#" onclick="openSignup()">Sign Up</a></span>
            </div>
        </form>

        <!-- sign up form -->
        <form id="signup" class="signup-form d-flex flex-column" method="POST">
            <input type="text" name="name" id="name" placeholder="Enter name..">
            <input type="text" name="email" id="email" placeholder="Email...">
            <input type="password" name="password" id="password" placeholder="Password...">
            <div class="d-flex align-items-center justify-content-between mt-3">
                <input type="submit" name="signup" value="Sign Up">
                <span>Already have account ? <a href="#" onclick="openLogin()">Sign In</a></span>
            </div>
        </form>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- javascript -->
    <script src="../index.js"></script>
</body>

</html>