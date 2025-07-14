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

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

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
header("Location: testupload.php");