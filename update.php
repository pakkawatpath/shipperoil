<?php

include_once "db.php";

if (isset($_POST['updateaddi'])) {
    $shipper = $_POST['shipper'];
    $received = $_POST['received'];
    $id = $_POST['id'];

    mysqli_query($conn, "UPDATE `addi` SET `shipper`='$shipper' ,`received`='$received' WHERE `id` = '$id'");

    echo "<script>";
    echo "window.location.href='additive.php?date=1'";
    echo "</script>";
}

if (isset($_POST['updateaddimonth'])) {
    $shipper = $_POST['shipper'];
    // $month = $_POST['month-year'];
    $remaining = $_POST['remaining'];
    $stock = $_POST['stock'];
    $deadstock = $_POST['deadstock'];
    $line = $_POST['line'];
    $total = $_POST['total'];
    $remark = $_POST['remark'];
    $id = $_POST['id'];

    mysqli_query($conn, "UPDATE `addimonth` SET `shipper`='$shipper',`remaining`='$remaining',`stock`='$stock',`deadstock`='$deadstock',`line`='$line',`total`='$total',`remark`='$remark' WHERE `id` = '$id'");

    echo "<script>";
    echo "window.location.href='additive.php?month-year=1'";
    echo "</script>";
}

if (isset($_POST['updatetruck'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];
    $number = $_POST['number'];
    $id = $_POST['id'];
    $tank = $_POST['tank'];

    mysqli_query($conn, "UPDATE `track` SET `shipper`='$shipper',`basename`='$product',`received`='$received',`number`='$number', `tank`='$tank' WHERE `id` = '$id'");

    $url = $_SESSION['url'];

    echo "<script>";
    echo "window.location.href='$url'";
    echo "</script>";
}

if (isset($_POST['updatepipeline'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];
    $tank = $_POST['tank'];
    $id = $_POST['id'];

    
    mysqli_query($conn, "UPDATE `pipeline` SET `shipper`='$shipper',`basename`='$product', `received`='$received', `tank`='$tank' WHERE id = '$id'");
    
    $url = $_SESSION['url'];

    echo "<script>";
    echo "window.location.href='$url'";
    echo "</script>";
}
