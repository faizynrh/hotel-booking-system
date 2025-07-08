<?php
include '../config.php';

$id_users = $_GET['id_users'];

$query = "DELETE FROM users WHERE id_users = '$id_users'";
$sql = mysqli_query($conn, $query);

header("Location: pengguna.php");
