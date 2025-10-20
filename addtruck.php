<?php
include_once 'db.php';
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
        #back {
            margin-top: 20px;
        }

        h6 {
            margin-top: 10px;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        textarea {
            width: 300px;
            height: 100px;
        }
    </style>

</head>

<body>

    <div id="back" class="col-2">
        <button class="btn btn-danger" onclick="window.location.href='body.php?page=truckmode&Page=1'"><i class="fa fa-arrow-left"></i> BACK</button>
    </div>

    <div style="text-align:center;">
        <form action="in.php" method="post">
            <div style="margin-top: 10px;"></div>
            <h6 for="shipper">Shipper </h6>
            <select name="shipper" id="shipper" required>
                <option value="">--SELECT--</option>
                <?php
                $sql = "SELECT * FROM `company`";
                $querycom = mysqli_query($conn, $sql);
                while ($row = $querycom->fetch_array()) {
                ?>
                    <option value="<?php echo $row['drawercompany'] ?>"><?php echo $row['company'] ?></option>
                <?php
                }
                ?>
            </select>
            <div style="margin-top: 10px;"></div>
            <h6 for="date">SELECT PRODUCT </h6>
            <select name="product" id="product" required>
                <option value="">--------------------SELECT PRODUCT--------------------</option>
            </select>
            <div style="margin-top: 10px;"></div>
            <h6 for="received">Received </h6>
            <input type="number" name="received" placeholder="Received" required>
            <div style="margin-top: 10px;"></div>
            <h6 for="numberreceived">เลขใบรับสินค้า </h6>
            <input type="text" name="numberreceived" placeholder="เลขใบรับสินค้า" required>
            <div style="margin-top: 10px;"></div>
            <h6 for="tank">ถัง </h6>
            <select name="tank">
                <option value="">--------------------SELECT TANK--------------------</option>
                <?php
                $sqltank = "SELECT * FROM `tank_gas`";
                $querytank = mysqli_query($conn, $sqltank);
                while ($row = $querytank->fetch_array()) {
                ?>
                    <option value="<?php echo $row['tank'] ?>"><?php echo $row['tank'] ?></option>
                <?php
                }
                ?>
            </select>
            <div style="margin-top: 10px;"></div>
            <h6 for="datetime">วันเดือนปีที่บันทึก</h6>
            <input type="date" name="datetime" required>
            <div style="margin-top: 10px;"></div>
            <input type="submit" class="btn btn-success" name="truck" value="เพิ่ม">
        </form>
    </div>
    <br>

    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>

</body>

</html>