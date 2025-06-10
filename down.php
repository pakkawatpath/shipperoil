<?php
include_once "db.php";

$st = $_POST['st'];
$to = $_POST['to'];
$select = $_POST['select'];
// $lev = $_POST['lev'];

$filename =   "oil" . "_" . $st . "_" . "to" . "_" . $to . "_" . $_SESSION["UserID"] . ".txt";

$f = fopen('php://memory', 'w');

// $result = mysqli_query($conn, "SELECT * FROM `data` WHERE `drawercompany` = '$lev' AND `date` BETWEEN '$st' AND '$to'");

if ($_SESSION["Level"] == "admin") {
    $result = mysqli_query($conn, "SELECT * FROM `data` WHERE `date` BETWEEN '$st' AND '$to' ORDER BY `date` DESC, `id` ASC");
} else {
    $shipper = $_SESSION["Shipper"];
    $result = mysqli_query($conn, "SELECT * FROM `data` WHERE `drawercompany` = '$shipper' AND `date` BETWEEN '$st' AND '$to' ORDER BY `date` DESC, `id` ASC");
}

while ($row = $result->fetch_assoc()) {
    $time = date_create(trim($row['date']));
    $load_time = date_format($time, "d-M-y");
    $n = trim($row['drawercompany']);
    $c = mysqli_query($conn, "SELECT * FROM `company` WHERE `drawercompany` = '$n'");
    $cc = $c->fetch_array();
    $a = $row['basename'];
    $drawername = $row['drawername'];
    if ($_SESSION["Level"] == "admin") {
        $shipperall = $cc['drawercompany'];
        $b = mysqli_query($conn, "SELECT * FROM `basename` WHERE `shipper` = '$shipperall' AND `basename` = '$a' AND `drawername` = '$drawername'");
        $c = $b->fetch_array();
    } else {
        $b = mysqli_query($conn, "SELECT * FROM `basename` WHERE `shipper` = '$shipper' AND `basename` = '$a' AND `drawername` = '$drawername'");
        $c = $b->fetch_array();
    }

    if (empty($c['ch'])) {
        $c = 'No Data';
    } else {
        $c = $c['ch'];
    }
    $lineData = array($load_time . "," . $cc['company'] . "," . trim($c) . ","  . trim($row['additive']) . "," . trim($row['tripno']) . "," . trim($row['obs']) . "," . trim($row['density']) . "," . trim($row['std']) . ","  . trim($row['temp']) . "," . trim($row['branch']));
    $lineData = str_replace('"', '', $lineData);
    fputs($f, implode($lineData) . "\n");
}

fseek($f, 0);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

fpassthru($f);
