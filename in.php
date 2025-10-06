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
    $productname = $_POST['productname'];
    $basecode = $_POST['basecode'];
    mysqli_query($conn, "INSERT INTO `basename`(`shipper`, `productname`, `basecode`, `basename`, `ch`, `drawername`) VALUES ('$shipper', '$productname', '$basecode', '$base','$ch','$drawername')");
    echo "<script>";
    echo "window.location.href='page.php?page=oil'";
    echo "</script>";
}

if (isset($_POST['daily'])) {
    $shipper = $_POST['shipper'];
    $date = $_POST['date'];
    $received = $_POST['received'];
    $delivery = $_POST['delivery'];
    $cal = $_POST['cal'];
    $remark = $_POST['remark'];

    preg_match_all('/\d+/', $cal, $matches);
    $resultcal = $matches[0][0] * $matches[0][1];

    $datecreate = date_create($date);
    $m = date_format($datecreate, "Y-m");

    $sqlre = "SELECT * FROM `addi` where `date` LIKE '$m%' ORDER BY `id` DESC LIMIT 1";

    $resultre = mysqli_query($conn, $sqlre);
    $rowre = $resultre->fetch_array();

    $sqlmonth = "SELECT * FROM `addimonth` WHERE `monthyear` = '$m'";
    $resultmonth = mysqli_query($conn, $sqlmonth);
    $rowmonth = $resultmonth->fetch_array();

    $deadstock = $rowmonth['deadstock'];
    $line = $rowmonth['line'];

    if (empty($rowre)) {
        $unopened = $rowmonth['remaining'] + $received - ($resultcal);
        $stock = $rowmonth['stock'] - $delivery + ($resultcal);
    } else {
        $unopened = $rowre['unopened'] + $received - ($resultcal);
        $stock = $rowre['stock'] - $delivery + ($resultcal);
    }

    mysqli_query($conn, "INSERT INTO `addi`(`shipper`, `date`, `received`, `cal`, `unopened`, `stock`, `delivery`, `deadstock`, `line`, `remark`) VALUES ('$shipper', '$date', '$received', '$cal', '$unopened', '$stock', '$delivery', '$deadstock', '$line', '$remark')");

    echo "<script>";
    echo "window.location.href='additive.php?date=1'";
    echo "</script>";
}

if (isset($_POST['month'])) {
    $shipper = $_POST['shipper'];
    $month = $_POST['month-year'];
    $remaining = $_POST['remaining'];
    $stock = $_POST['stock'];
    $deadstock = $_POST['deadstock'];
    $line = $_POST['line'];
    $total = $_POST['total'];
    $available = $_POST['available'];

    mysqli_query($conn, "INSERT INTO `addimonth`( `shipper`, `monthyear`, `remaining`, `stock`, `deadstock`, `line`, `total`, `available`) VALUES ('$shipper','$month','$remaining','$stock','$deadstock','$line','$total','$available')");

    echo "<script>";
    echo "window.location.href='additive.php?month-year=1'";
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
