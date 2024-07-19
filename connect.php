<?php


$servername = "localhost";
$username = "admin";
$password = "admin172";
$dbname = "exam_hall";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?> 