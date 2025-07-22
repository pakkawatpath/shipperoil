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
    </style>

</head>

<body>

    <div id="back" class="col-2">
        <button class="btn btn-danger" onclick="window.location.href='additive.php?month-year=1'"><i class="fa fa-arrow-left"></i> BACK</button>
    </div>

    <div style="text-align:center;">
        <form action="in.php" method="post">

            <h6>Shipper </h6>
            <select name="shipper" required>
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

            <h6 for="date">month-year </h6>
            <input type="month" name="month-year" style="width: 140px;" required>

            <h6 for="remaining">remaining </h6>
            <input type="number" step="0.001" name="remaining" placeholder="Remaining" style="width: 140px;" required>
            
            <h6 for="stock">Stock in day tank</h6>
            <input type="number" step="0.001" name="stock" placeholder="Stock in day tank" style="width: 140px;" required>
            
            <h6 for="deadstock">dead stock </h6>
            <input type="number" step="0.001" name="deadstock" placeholder="Dead stock" style="width: 140px;" required>
            
            <h6 for="line">Line content</h6>
            <input type="number" step="0.001" name="line" placeholder="Line content" style="width: 140px;" required>
            
            <h6 for="total">Total stock</h6>
            <input type="number" step="0.001" name="total" placeholder="Total stock" style="width: 140px;" required>
            
            <h6 for="available">Available stock</h6>
            <input type="text" name="available" placeholder="Available stock" style="width: 140px;" required>

            <div style="margin-top: 10px;"></div>
            <input type="submit" name="month" value="เพิ่ม">
        </form>
    </div>
    <br>

</body>

</html>