<?php
// reset session
session_start();
// unset credientials
unset($_SESSION['name']);
unset($_SESSION['email']);
header("Location:http://localhost/kaliba/pages///index.php");
