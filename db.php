<?php
error_reporting(0);
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = "oil";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
  die('Could not Connect MySql Server:' . $conn->connect_error);
}

mysqli_set_charset($conn, 'utf8');

session_start();
if (empty($_SESSION["UserID"])) {
    header("Location: index.php");
}
