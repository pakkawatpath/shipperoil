<?php
include('db.php');
$shipper = $_GET['shipper'];
$sql = "SELECT DISTINCT `basename` FROM `basename` WHERE `shipper` = '$shipper'";
$query = mysqli_query($conn, $sql);

$json = array();
while ($result = mysqli_fetch_assoc($query)) {
    array_push($json, $result);
}
echo json_encode($json);
?>