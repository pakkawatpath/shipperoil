<?php

include_once "db.php";

if (isset($_POST['updateaddi'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];
    $id = $_POST['id'];

    $sql = "SELECT * FROM `basename` WHERE `id` = '$product'";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_array()) {
        $basename = $row['basename'];
        $drawername = $row['drawername'];
        $ch = $row['ch'];
        mysqli_query($conn, "UPDATE `addi` SET `shipper`='$shipper',`basename`='$basename',`drawername`='$drawername',`ch`='$ch',`received`='$received' WHERE `id` = '$id'");
    }
    echo "<script>";
    echo "window.location.href='body.php?page=additi&Page=1'";
    echo "</script>";
}

if (isset($_POST['updatetrack'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];
    $number = $_POST['number'];
    $id = $_POST['id'];

    $sql = "SELECT * FROM `basename` WHERE `id` = '$product'";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_array()) {
        $basename = $row['basename'];
        $drawername = $row['drawername'];
        $ch = $row['ch'];
        mysqli_query($conn, "UPDATE `track` SET `shipper`='$shipper',`basename`='$basename',`drawername`='$drawername',`ch`='$ch',`received`='$received',`number`='$number' WHERE `id` = '$id'");
    }
    echo "<script>";
    echo "window.location.href='body.php?page=trackmode&Page=1'";
    echo "</script>";
}

if (isset($_POST['updatepipeline'])) {
    $shipper = $_POST['shipper'];
    $product = $_POST['product'];
    $received = $_POST['received'];
    $id = $_POST['id'];

    $sql = "SELECT * FROM `basename` WHERE `id` = '$product'";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_array()) {
        $basename = $row['basename'];
        $drawername = $row['drawername'];
        $ch = $row['ch'];
        mysqli_query($conn, "UPDATE `pipeline` SET `shipper`='$shipper',`basename`='$basename',`drawername`='$drawername',`ch`='$ch',`received`='$received' WHERE id = '$id'");
    }
    echo "<script>";
    echo "window.location.href='body.php?page=pipelinemode&Page=1'";
    echo "</script>";
}
