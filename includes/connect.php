<?php
// database variables
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

// connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die(mysqli_connect_error());
}
