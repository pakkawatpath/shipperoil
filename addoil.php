<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html>

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
    </style>
</head>

<body>
    <div id="back" class="col-2">
        <button class="btn btn-danger" onclick="window.location.href='page.php?page=oil '"><i class="fa fa-arrow-left"></i> BACK</button>
    </div>
    <div style="text-align:center;">
        <form action="in.php" method="post">
            <h6 for="shipper">Shipper:</h6>
            <select name="shipper" required>
                <option value="" disabled selected>--SELECT--</option>
                <?php
                $sql = "SELECT * FROM `company`";
                $query = mysqli_query($conn, $sql);
                while ($row = $query->fetch_array()) {
                ?>
                    <option value="<?php echo $row['drawercompany'] ?>"><?php echo $row['company'] ?></option>
                <?php
                }
                ?>
            </select>
            <h6>Product Code:</h6>
            <input type="text" name="productname">
            <h6>Base Code:</h6>
            <input type="text" name="basecode">
            <h6>Basename:</h6>
            <input type="text" name="basename">
            <h6>Drawer Name:</h6>
            <input type="text" name="drawername">
            <h6>Basename Customer:</h6>
            <input type="text" name="ch"><br>
            <div style="margin-top: 10px;"></div>
            <input type="submit" value="เพิ่ม" name="base">
        </form>
    </div>
</body>

</html>