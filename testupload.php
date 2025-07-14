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
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        table,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }

        h1 {
            text-align: center;
        }

        table{
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div style="margin-top: 50px;"></div>
    <h1>TEST Upload Excel</h1>
    <br>
    <form action="testinsert.php" method="post" enctype="multipart/form-data">
        <div class="d-flex justify-content-center">
            <div class="col">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFileInputexcel" accept=".xls,.xlsx" name="excel_file">
                        <label class="custom-file-label" for="customFileInputexcel"></label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" name="submitexcel" class="btn btn-primary"> Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <table width="99%">
        <tr>
            <th>drawercodeandname</th>
            <th>productname</th>
            <th>loadnumber</th>
            <th>tripnumber</th>
            <th>dmy</th>
            <th>drivercode</th>
            <th>tankercode</th>
            <th>unit</th>
            <th>scheduleqty</th>
            <th>loadedobs</th>
            <th>loadedstd</th>
            <th>loaded</th>
            <th>injected</th>
        </tr>
        <?php
        $sql = 'SELECT * FROM `drawerproduct`';
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_array()) {
        ?>
            <tr>
                <td><?php echo $row['drawercodeandname']; ?></td>
                <td><?php echo $row['productname']; ?></td>
                <td><?php echo $row['loadnumber']; ?></td>
                <td><?php echo $row['tripnumber']; ?></td>
                <td><?php echo $row['dmy']; ?></td>
                <td><?php echo $row['drivercode']; ?></td>
                <td><?php echo $row['tankercode']; ?></td>
                <td><?php echo $row['unit']; ?></td>
                <td><?php echo $row['scheduleqty']; ?></td>
                <td><?php echo $row['loadedobs']; ?></td>
                <td><?php echo $row['loadedstd']; ?></td>
                <td><?php echo $row['loaded']; ?></td>
                <td><?php echo $row['injected']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br>

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>


</html>