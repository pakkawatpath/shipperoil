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
        <button class="btn btn-danger" onclick="window.location.href='additive.php?date=1 '"><i class="fa fa-arrow-left"></i> BACK</button>
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
            <h6 for="date">Date </h6>
            <input type="date" name="date" required>
            <div style="margin-top: 10px;"></div>
            <h6 for="received">Received </h6>
            <input type="number" step="0.001" name="received" placeholder="Received" required>
            <div style="margin-top: 10px;"></div>
            <h6 for="delivery">Delivery </h6>
            <input type="number" step="0.001" name="delivery" placeholder="Delivery" required>
            <div style="margin-top: 10px;"></div>
            <select name="cal">
                <option value="">ไม่มี</option>
                <?php
                $sqlcal = "SELECT * FROM `cal`";
                $querycal = mysqli_query($conn, $sqlcal);
                while ($row = $querycal->fetch_array()) {
                ?>
                    <option value="<?php echo $row['cal'] ?>"><?php echo $row['cal'] ?></option>
                <?php
                }
                ?>
            </select>
            <div style="margin-top: 10px;"></div>
            <h6 for="remark">Remark</h6>
            <textarea name="remark" placeholder="Remark"></textarea>
            <div style="margin-top: 10px;"></div>
            <input type="submit" class="btn btn-success" name="daily" value="เพิ่ม">
        </form>
    </div>
    <br>

</body>

</html>