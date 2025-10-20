<?php
include_once "db.php";

if (isset($_GET['company'])) {
    $delete = $conn->real_escape_string($_GET['company']);
    $sql = $conn->query("DELETE FROM `company` WHERE `id` = '$delete'");
    if ($sql) {
        echo "<script>";
        echo "window.location.href='page.php?page=company&number=1'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['tank'])) {
    $delete = $conn->real_escape_string($_GET['tank']);
    $sql = $conn->query("DELETE FROM `tank_gas` WHERE `id` = '$delete'");
    if ($sql) {
        echo "<script>";
        echo "window.location.href='page.php?page=tank&number=1'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['user'])) {
    $delete = $conn->real_escape_string($_GET['user']);
    $del = $conn->real_escape_string($_GET['id']);
    $sql = $conn->query("DELETE FROM `user` WHERE `id` = '$del' AND `user` = '$delete'");
    if ($sql) {
        echo "<script>";
        echo "window.location.href='page.php?page=user'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['oil'])) {
    $delete = $conn->real_escape_string($_GET['oil']);
    $del = $conn->real_escape_string($_GET['id']);
    $sql = $conn->query("DELETE FROM `basename` WHERE `id` = '$del' AND `basename` = '$delete'");
    if ($sql) {
        echo "<script>";
        echo "window.location.href='page.php?page=oil'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['date'])) {
    $delete = $conn->real_escape_string($_GET['date']);
    //$del = $conn->real_escape_string($_GET['id']);
    $sql = $conn->query("DELETE FROM `data` WHERE `date` = '$delete'");
    if ($sql) {
        echo "<script>";
        echo "window.location.href='body.php?Page=1'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['addi'])) {
    $delete = $conn->real_escape_string($_GET['addi']);
    $sql = $conn->query("DELETE FROM `addi` WHERE `id` = '$delete'");
    if ($sql) {
        echo "<script>";
        echo "window.location.href='additive.php?date=1'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['addimonth'])) {
    $delete = $conn->real_escape_string($_GET['addimonth']);
    $sql = $conn->query("DELETE FROM `addimonth` WHERE `id` = '$delete'");
    if ($sql) {
        echo "<script>";
        echo "window.location.href='additive.php?month-year=1'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['truck'])) {
    $delete = $conn->real_escape_string($_GET['truck']);
    $sql = $conn->query("DELETE FROM `track` WHERE `id` = '$delete'");
    if ($sql) {
        $url = $_SESSION['url'];
        echo "<script>";
        echo "window.location.href='$url'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}

if (isset($_GET['pipeline'])) {
    $delete = $conn->real_escape_string($_GET['pipeline']);
    $sql = $conn->query("DELETE FROM `pipeline` WHERE `id` = '$delete'");
    if ($sql) {
        $url = $_SESSION['url'];
        echo "<script>";
        echo "window.location.href='$url'";
        echo "</script>";
    } else {
        echo "ERROR";
    }
}
?>

<html>

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    

    <meta charset="UTF-8">

    <title>เลือกวัน/เดือน/ปีที่ต้องการลบ</title>
</head>

<body>
    <div style="margin-left: 10px;margin-top:10px">
        <a href="body.php?Page=1"><img src='icon/home-button.png' width="40" height="40" /></a>
    </div>
    <div style="text-align:center;margin-top:70px;">
        <h3>เลือกวัน/เดือน/ปีที่ต้องการลบ</h3>
        <br>
        <input type="date" name="date">
        <button onclick="fun()">ตกลง</button>

        <script>
            function fun() {

                let x = document.getElementsByName("date")[0].value
                let text = "ต้องการที่จะลบวันที่ " + x + " ใช่หรือไม่"

                if (confirm(text) == true) {
                    window.location.href = 'del.php?date=' + x
                } else {

                }

            }
        </script>
    </div>
</body>

</html>