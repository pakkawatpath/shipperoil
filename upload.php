<?php
include_once "db.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submitcsv'])) {
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
}

if (isset($_POST['submitexcel'])) {
    
    $file = $_FILES['excel_file']['tmp_name'];

    // 2. โหลด Excel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    $totalRows = count($rows);
    $drawer = $rows[9][1];
    $productname = $rows[9][2];

    // 3. ลูปแต่ละแถว
    foreach ($rows as $index => $row) {
        if ($index < 8 || $index >= $totalRows - 6) {
            continue; // ข้ามแถวหัวตาราง
        }

        if (!empty($row[1])) {
            $drawer = $row[1];
        }

        if (!empty($row[2])) {
            $productname = $row[2];
        }
        
        $loadnumber = trim($row[3]);
        $tripnumber = trim($row[5]);
        $dmy = trim($row[6]);
        $drivercode = trim($row[8]);
        $tankercode = trim($row[10]);
        $unit = trim($row[12]);
        $scheduleqty = trim($row[13]); 
        $loadedobs = trim($row[14]);
        $loadedstd = trim($row[18]);
        $loaded = trim($row[21]);
        $injected = trim($row[22]);

        if (empty($loadnumber) && empty($tripnumber) && empty($dmy) && empty($drivercode) && empty($tankercode) && empty($unit)) {
            continue;
        }
    
        $loadnumber = $conn->real_escape_string($row[3]);
        $tripnumber = $conn->real_escape_string($row[5]);
        $dmy = $conn->real_escape_string($row[6]);
        $drivercode = $conn->real_escape_string($row[8]);
        $tankercode = $conn->real_escape_string($row[10]);
        $unit = $conn->real_escape_string($row[12]);
        $scheduleqty = $conn->real_escape_string($row[13]);
        $loadedobs = $conn->real_escape_string($row[14]);
        $loadedstd = $conn->real_escape_string($row[18]);
        $loaded = $conn->real_escape_string($row[21]);
        $injected = $conn->real_escape_string($row[22]);

        $sql = "INSERT INTO `drawerproduct`(`drawercodeandname`, `productname`, `loadnumber`, `tripnumber`, `dmy`, `drivercode`, `tankercode`, `unit`, `scheduleqty`, `loadedobs`, `loadedstd`, `loaded`, `injected`) VALUES ('$drawer', '$productname','$loadnumber','$tripnumber','$dmy','$drivercode','$tankercode','$unit','$scheduleqty','$loadedobs','$loadedstd','$loaded','$injected')";
        
        $conn->query($sql);
    }
}

header("Location: body.php?page=homepage&Page=1");