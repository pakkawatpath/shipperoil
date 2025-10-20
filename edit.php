<!doctype html>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Edit</title>
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
    <?php
    include_once "db.php";
    if (isset($_GET['addi'])) {
    ?>
        <div id="back" class="col-2">
            <button class="btn btn-danger" onclick="window.location.href='additive.php?date=1'"><i class="fa fa-arrow-left"></i> BACK</button>
        </div>
        <div style="text-align: center;">
            <div style="margin-top: 100px;"></div>
            <?php
            $sql = 'SELECT * FROM `addi` WHERE `id` = ' . $_GET['addi'];
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <form action="update.php" method="post">
                    <table width="60%" style="margin-left: auto; margin-right: auto;">
                        <tr>
                            <td><label for="shipper">Shipper </label></td>
                            <td><label for="product">date </label></td>
                            <td><label for="received">Received </label></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="shipper" id="shipper" required>
                                    <option value="">--SELECT--</option>
                                    <?php
                                    $sql = "SELECT * FROM `company`";
                                    $query = mysqli_query($conn, $sql);
                                    while ($rowcom = $query->fetch_array()) {
                                        if ($rowcom['drawercompany'] == $row['shipper']) {
                                    ?>

                                            <option value="<?php echo $rowcom['drawercompany'] ?>" selected><?php echo $rowcom['company'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $rowcom['drawercompany'] ?>"><?php echo $rowcom['company'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="date" name="date" value="<?php echo $row['date']; ?>" required disabled><br>
                            </td>
                            <td>
                                <input type="text" name="received" value="<?php echo $row['received']; ?>" required><br>
                            </td>
                        </tr>
                    </table>
                    <!-- <input type="text" name="product" value="<?php echo $row['product']; ?>"> -->
                    <input type="hidden" name="id" value="<?php echo $_GET['addi']; ?>">
                    <div style="margin-top: 10px;"></div>
                    <button type="submit" name="updateaddi">Update</button>
                </form>
            <?php
            }
            ?>
        </div>
    <?php
    }

    if (isset($_GET['addimonth'])) {
    ?>
        <div id="back" class="col-2">
            <button class="btn btn-danger" onclick="window.location.href='additive.php?month-year=1'"><i class="fa fa-arrow-left"></i> BACK</button>
        </div>
        <div style="text-align: center;">
            <?php
            $sql = 'SELECT * FROM `addimonth` WHERE `id` = ' . $_GET['addimonth'];
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <form action="update.php" method="post">
                    <h6 for="shipper">Shipper </h6>
                    <select name="shipper" id="shipper" required>
                        <option value="">--SELECT--</option>
                        <?php
                        $sql = "SELECT * FROM `company`";
                        $query = mysqli_query($conn, $sql);
                        while ($rowcom = $query->fetch_array()) {
                            if ($rowcom['drawercompany'] == $row['shipper']) {
                        ?>

                                <option value="<?php echo $rowcom['drawercompany'] ?>" selected><?php echo $rowcom['company'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $rowcom['drawercompany'] ?>"><?php echo $rowcom['company'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <h6 for="date">month-year </h6>
                    <input type="month" name="month-year" style="width: 140px;" value="<?php echo $row['monthyear']; ?>" required disabled>

                    <h6 for="remaining">remaining </h6>
                    <input type="number" name="remaining" placeholder="Remaining" style="width: 140px;" value="<?php echo $row['remaining']; ?>" required>

                    <h6 for="stock">Stock in day tank</h6>
                    <input type="number" name="stock" placeholder="Stock in day tank" style="width: 140px;" value="<?php echo $row['stock']; ?>" required>

                    <h6 for="deadstock">Dead stock</h6>
                    <input type="number" name="deadstock" placeholder="Dead stock" style="width: 140px;" value="<?php echo $row['deadstock']; ?>" required>

                    <h6 for="line">Line content</h6>
                    <input type="number" name="line" placeholder="Line content" style="width: 140px;" value="<?php echo $row['line']; ?>" required>

                    <h6 for="total">Total stock</h6>
                    <input type="number" name="total" placeholder="Total stock" style="width: 140px;" value="<?php echo $row['total']; ?>" required>

                    <h6 for="remark">Remark</h6>
                    <input type="text" name="remark" placeholder="Remark" style="width: 140px;" value="<?php echo $row['remark']; ?>" required>

                    <div style="margin-top: 10px;"></div>
                    <input type="hidden" name="id" value="<?php echo $_GET['addimonth']; ?>">
                    <button type="submit" name="updateaddimonth">Update</button>
                </form>
                <br>
            <?php
            }
            ?>
        </div>
    <?php
    }

    if (isset($_GET['truck'])) {
    ?>
        <div id="back" class="col-2">
            <button class="btn btn-danger" onclick="history.back()"><i class="fa fa-arrow-left"></i> BACK</button>
            <button class="btn btn-danger" onclick="window.location.reload();"> RESET</button>
        </div>
        <div style="text-align: center;">
            <div style="margin-top: 100px;"></div>
            <?php
            $sql = 'SELECT * FROM `track` WHERE `id` = ' . $_GET['truck'];
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <form action="update.php" method="post">

                    <h6>Shipper </h6>
                    <select name="shipper" id="shipper" required>
                        <option value="">--SELECT--</option>
                        <?php
                        $sql = "SELECT * FROM `company`";
                        $query = mysqli_query($conn, $sql);
                        while ($rowcom = $query->fetch_array()) {
                            if ($rowcom['drawercompany'] == $row['shipper']) {
                        ?>

                                <option value="<?php echo $rowcom['drawercompany'] ?>" selected><?php echo $rowcom['company'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $rowcom['drawercompany'] ?>"><?php echo $rowcom['company'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <div style="margin-top: 10px;"></div>

                    <h6>Prodect </h6>
                    <select name="product" id="product" required>
                        <option value="">--------------------SELECT PRODUCT--------------------</option>

                        <?php
                        $sqlproduct = "SELECT DISTINCT `basename` FROM `basename` WHERE `shipper` = '" . $row['shipper'] . "'";
                        $queryproduct = mysqli_query($conn, $sqlproduct);
                        while ($rowproduct = $queryproduct->fetch_array()) {
                            if ($rowproduct['basename'] == $row['basename']) {
                        ?>
                                <option value="<?php echo $rowproduct['basename'] ?>" selected><?php echo $rowproduct['basename']  ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $rowproduct['basename'] ?>"><?php echo $rowproduct['basename'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <div style="margin-top: 10px;"></div>

                    <h6>Received </h6>
                    <input type="text" name="received" value="<?php echo $row['received']; ?>" required>
                    <div style="margin-top: 10px;"></div>

                    <h6>เลขใบรับสินค้า</h6>
                    <input type="text" name="number" value="<?php echo $row['number']; ?>" required>
                    <div style="margin-top: 10px;"></div>
                    <h6>ถัง</h6>
                    <select name="tank">
                        <option value="">--------------------SELECT TANK--------------------</option>
                        <?php
                        $sqltank = "SELECT * FROM `tank_gas`";
                        $querytank = mysqli_query($conn, $sqltank);
                        while ($rowtank = $querytank->fetch_array()) {
                            if ($rowtank['tank'] == $row['tank']) {
                        ?>
                                <option value="<?php echo $rowtank['tank'] ?>" selected><?php echo $rowtank['tank']  ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $rowtank['tank'] ?>"><?php echo $rowtank['tank'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <input type="hidden" name="id" value="<?php echo $_GET['truck']; ?>">
                    <div style="margin-top: 20px;"></div>
                    <button type="submit" name="updatetruck" class="btn btn-success">Update</button>
                </form>
            <?php
            }
            ?>
        </div>
    <?php
    }

    if (isset($_GET['pipeline'])) {
    ?>
        <div id="back" class="col-2">
            <button class="btn btn-danger" onclick="history.back()"><i class="fa fa-arrow-left"></i> BACK</button>
            <button class="btn btn-danger" onclick="window.location.reload();"> RESET</button>
        </div>
        <div style="text-align: center;">
            <div style="margin-top: 100px;"></div>
            <?php
            $sql = 'SELECT * FROM `pipeline` WHERE `id` = ' . $_GET['pipeline'];
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <form action="update.php" method="post">

                    <h6>Shipper </h6>
                    <select name="shipper" id="shipper" required>
                        <option value="">--SELECT--</option>
                        <?php
                        $sql = "SELECT * FROM `company`";
                        $query = mysqli_query($conn, $sql);
                        while ($rowcom = $query->fetch_array()) {
                            if ($rowcom['drawercompany'] == $row['shipper']) {
                        ?>

                                <option value="<?php echo $rowcom['drawercompany'] ?>" selected><?php echo $rowcom['company'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $rowcom['drawercompany'] ?>"><?php echo $rowcom['company'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <div style="margin-top: 10px;"></div>

                    <h6>Prodect </h6>
                    <select name="product" id="product" required>
                        <option value="">--------------------SELECT PRODUCT--------------------</option>

                        <?php
                        $sqlproduct = "SELECT DISTINCT `basename` FROM `basename` WHERE `shipper` = '" . $row['shipper'] . "'";
                        $queryproduct = mysqli_query($conn, $sqlproduct);
                        while ($rowproduct = $queryproduct->fetch_array()) {
                            if ($rowproduct['basename'] == $row['basename']) {
                        ?>
                                <option value="<?php echo $rowproduct['basename'] ?>" selected><?php echo $rowproduct['basename'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $rowproduct['basename'] ?>"><?php echo $rowproduct['basename'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <div style="margin-top: 10px;"></div>

                    <h6>Received </h6>
                    <input type="text" name="received" value="<?php echo $row['received']; ?>" required>
                    <div style="margin-top: 10px;"></div>

                    <h6>ถัง</h6>
                    <select name="tank">
                        <option value="">--------------------SELECT TANK--------------------</option>
                        <?php
                        $sqltank = "SELECT * FROM `tank_gas`";
                        $querytank = mysqli_query($conn, $sqltank);
                        while ($rowtank = $querytank->fetch_array()) {
                            if ($rowtank['tank'] == $row['tank']) {
                        ?>
                                <option value="<?php echo $rowtank['tank'] ?>" selected><?php echo $rowtank['tank']  ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $rowtank['tank'] ?>"><?php echo $rowtank['tank'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                        
                    <input type="hidden" name="id" value="<?php echo $_GET['pipeline']; ?>">
                    <div style="margin-top: 20px;"></div>
                    <button type="submit" name="updatepipeline" class="btn btn-success">Update</button>
                </form>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>

    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
</body>

</html>