<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

</html>

<?php
include_once "db.php";

if (isset($_POST['company'])) {
    $code = $_POST['code'];
    $com = $_POST['com'];
    mysqli_query($conn, "INSERT INTO `company`(`drawercompany`, `company`) VALUES ('$code','$com')");
    echo "<script>";
    echo "window.location.href='page.php?page=company'";
    echo "</script>";
}

if (isset($_POST['sub'])) {
    $shipper = $_POST['shipper'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
    mysqli_query($conn, "INSERT INTO `user`(`shipper`, `user`, `password`, `level`) VALUES ('$shipper', '$user','$pass','$level')");
    echo "<script>";
    echo "window.location.href='page.php?page=user'";
    echo "</script>";
}

if (isset($_POST['base'])) {
    $shipper = $_POST['shipper'];
    $base = $_POST['basename'];
    $ch = $_POST['ch'];
    $drawername = $_POST['drawername'];
    mysqli_query($conn, "INSERT INTO `basename`(`shipper`, `basename`, `ch`, `drawername`) VALUES ('$shipper', '$base','$ch','$drawername')");
    echo "<script>";
    echo "window.location.href='page.php?page=oil'";
    echo "</script>";
}

if (isset($_POST['additi'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];

    $sql = "SELECT * FROM `basename` WHERE `id` = '$product'";
    $query = mysqli_query($conn, $sql);
    while ($row = $query->fetch_array()) {
        $basename = $row['basename'];
        $drawername = $row['drawername'];
        $ch = $row['ch'];
        mysqli_query($conn, "INSERT INTO `addi`(`shipper`, `basename`, `drawername`, `ch`, `received`) VALUES ('$shipper', '$basename', '$drawername', '$ch', '$received')");
    }
    echo "<script>";
    echo "window.location.href='body.php?page=additi&Page=1'";
    echo "</script>";
}

if (isset($_POST['track'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];
    $numberreceived = $_POST['numberreceived'];
    $sql = "SELECT * FROM `basename` WHERE `id` = '$product'";
    $query = mysqli_query($conn, $sql);
    while ($row = $query->fetch_array()) {
        $basename = $row['basename'];
        $drawername = $row['drawername'];
        $ch = $row['ch'];
        mysqli_query($conn, "INSERT INTO `track`(`shipper`, `basename`, `drawername`, `ch`, `received`, `number`) VALUES ('$shipper', '$basename', '$drawername', '$ch','$received','$numberreceived')");
    }

    echo "<script>";
    echo "window.location.href='body.php?page=trackmode&Page=1'";
    echo "</script>";
}

if (isset($_POST['pipeline'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];

    $sql = "SELECT * FROM `basename` WHERE `id` = '$product'";
    $query = mysqli_query($conn, $sql);
    while ($row = $query->fetch_array()) {
        $basename = $row['basename'];
        $drawername = $row['drawername'];
        $ch = $row['ch'];
        mysqli_query($conn, "INSERT INTO `pipeline`(`shipper`, `basename`, `drawername`, `ch`, `received`) VALUES ('$shipper', '$basename', '$drawername', '$ch','$received')");
    }

    echo "<script>";
    echo "window.location.href='body.php?page=pipelinemode&Page=1'";
    echo "</script>";
}
