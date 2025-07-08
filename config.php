<?php

// membuat variabel untuk koneksi database

$host = "localhost";
$user = "root";
$password = "";
$db_name = "dbhotel";

$conn = mysqli_connect($host, $user, $password, $db_name);

if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}
