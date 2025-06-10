<?php
include_once "db.php";


$fileMimes = array(
    'text/x-comma-separated-values',
    'text/comma-separated-values',
    'application/octet-stream',
    'application/vnd.ms-excel',
    'application/x-csv',
    'text/x-csv',
    'text/csv',
    'application/csv',
    'application/excel',
    'application/vnd.msexcel',
    'text/plain'
);
if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {
    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

    fgetcsv($csvFile);

    while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

        $date = $getData[0];
        $dc = $getData[1];
        $dn = $getData[2];
        $bn = $getData[3];
        $a = $getData[4];
        $tn = $getData[5];
        $obs = $getData[6];
        $d = $getData[7];
        $std = $getData[8];
        $t = $getData[9];
        $b = $getData[10];

        $time = date_create(str_replace('/', '-', $date));
        $load_time = date_format($time, "Y-m-d");
        //echo $load_time;
        $check = mysqli_query($conn, "SELECT * FROM `data` WHERE `date` = '$load_time' AND `drawercompany` = '$dc' AND `drawername` = '$dn' AND `basename` = '$bn' AND `additive` = '$a' AND `tripno` = '$tn' AND `obs` = '$obs' AND `density` = '$d' AND `std` = '$std' AND `temp` = '$t' AND `branch` = '$b'");
        $c1 = $check->fetch_array();
        //$checkx = mysqli_query($conn, "SELECT * FROM `drawer` WHERE `carrier_name` = '$carrier_name' AND `load_time` = '$load_time'");
        if (!empty($c1)) {
            continue;
        } else {
            mysqli_query($conn, "INSERT INTO `data`( `date`,`drawercompany`,`drawername`,`basename`,`additive`,`tripno`,`obs`,`density`,`std`,`temp`,`branch`) 
                            VALUES ('" . trim($load_time) . "',
                                    '" . trim($dc) . "',
                                    '" . trim($dn) . "', 
                                    '" . trim($bn) . "', 
                                    '" . trim($a) . "', 
                                    '" . trim($tn) . "', 
                                    '" . trim($obs) . "', 
                                    '" . trim($d) . "', 
                                    '" . trim($std) . "', 
                                    '" . trim($t) . "', 
                                    '" . trim($b) . "')");
        }
    }
    // Close opened CSV file
    fclose($csvFile);
}
header("Location: body.php?Page=1");
