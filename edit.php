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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Edit</title>
    <style>
        #back {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    include_once "db.php";
    if (isset($_GET['addi'])) {
    ?>
        <div id="back" class="col-2">
            <button class="btn btn-danger" onclick="window.location.href='body.php?page=additi'"><i class="fa fa-arrow-left"></i> BACK</button>
            <button class="btn btn-danger" onclick="window.location.reload();"> RESET</button>
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
                            <td><label for="product">Prodect </label></td>
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
                                <select name="product" id="product" required>
                                    <option value="">--------------------SELECT PRODUCT--------------------</option>

                                    <?php
                                    $sqlproduct = "SELECT * FROM `basename` WHERE `shipper` = '" . $row['shipper'] . "'";
                                    $queryproduct = mysqli_query($conn, $sqlproduct);
                                    while ($rowproduct = $queryproduct->fetch_array()) {
                                        if ($rowproduct['basename'] == $row['basename'] && $rowproduct['drawername'] == $row['drawername'] && $rowproduct['ch'] == $row['ch']) {
                                    ?>
                                            <option value="<?php echo $rowproduct['id'] ?>" selected><?php echo $rowproduct['basename'] . " - " . $rowproduct['drawername'] . " - " . $rowproduct['ch'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $rowproduct['id'] ?>"><?php echo $rowproduct['basename'] . " - " . $rowproduct['drawername'] . " - " . $rowproduct['ch'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                    ?>

                                </select>
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
    if (isset($_GET['track'])) {
    ?>
        <div id="back" class="col-2">
            <button class="btn btn-danger" onclick="window.location.href='body.php?page=trackmode'"><i class="fa fa-arrow-left"></i> BACK</button>
            <button class="btn btn-danger" onclick="window.location.reload();"> RESET</button>
        </div>
        <div style="text-align: center;">
            <div style="margin-top: 100px;"></div>
            <?php
            $sql = 'SELECT * FROM `track` WHERE `id` = ' . $_GET['track'];
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <form action="update.php" method="post">
                    <table width="75%" style="margin-left: auto; margin-right: auto;">
                        <tr>
                            <td><label for="shipper">Shipper </label></td>
                            <td><label for="product">Prodect </label></td>
                            <td><label for="received">Received </label></td>
                            <td><label for="numberreceived">เลขใบรับสินค้า</label></td>
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
                                <select name="product" id="product" required>
                                    <option value="">--------------------SELECT PRODUCT--------------------</option>

                                    <?php
                                    $sqlproduct = "SELECT * FROM `basename` WHERE `shipper` = '" . $row['shipper'] . "'";
                                    $queryproduct = mysqli_query($conn, $sqlproduct);
                                    while ($rowproduct = $queryproduct->fetch_array()) {
                                        if ($rowproduct['basename'] == $row['basename'] && $rowproduct['drawername'] == $row['drawername'] && $rowproduct['ch'] == $row['ch']) {
                                    ?>
                                            <option value="<?php echo $rowproduct['id'] ?>" selected><?php echo $rowproduct['basename'] . " - " . $rowproduct['drawername'] . " - " . $rowproduct['ch'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $rowproduct['id'] ?>"><?php echo $rowproduct['basename'] . " - " . $rowproduct['drawername'] . " - " . $rowproduct['ch'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <input type="text" name="received" value="<?php echo $row['received']; ?>" required>
                            </td>
                            <td>
                                <input type="text" name="number" value="<?php echo $row['number']; ?>" required>
                            </td>
                        </tr>
                    </table>
                    <!-- <input type="text" name="product" value="<?php echo $row['product']; ?>"> -->
                    <input type="hidden" name="id" value="<?php echo $_GET['track']; ?>">
                    <div style="margin-top: 10px;"></div>
                    <button type="submit" name="updatetrack">Update</button>
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
            <button class="btn btn-danger" onclick="window.location.href='body.php?page=pipelinemode'"><i class="fa fa-arrow-left"></i> BACK</button>
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
                    <table width="60%" style="margin-left: auto; margin-right: auto;">
                        <tr>
                            <td><label for="shipper">Shipper </label></td>
                            <td><label for="product">Prodect </label></td>
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
                                <select name="product" id="product" required>
                                    <option value="">--------------------SELECT PRODUCT--------------------</option>

                                    <?php
                                    $sqlproduct = "SELECT * FROM `basename` WHERE `shipper` = '" . $row['shipper'] . "'";
                                    $queryproduct = mysqli_query($conn, $sqlproduct);
                                    while ($rowproduct = $queryproduct->fetch_array()) {
                                        if ($rowproduct['basename'] == $row['basename'] && $rowproduct['drawername'] == $row['drawername'] && $rowproduct['ch'] == $row['ch']) {
                                    ?>
                                            <option value="<?php echo $rowproduct['id'] ?>" selected><?php echo $rowproduct['basename'] . " - " . $rowproduct['drawername'] . " - " . $rowproduct['ch'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $rowproduct['id'] ?>"><?php echo $rowproduct['basename'] . " - " . $rowproduct['drawername'] . " - " . $rowproduct['ch'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <input type="text" name="received" value="<?php echo $row['received']; ?>" required><br>
                            </td>
                        </tr>
                    </table>
                    <!-- <input type="text" name="product" value="<?php echo $row['product']; ?>"> -->
                    <input type="hidden" name="id" value="<?php echo $_GET['pipeline']; ?>">
                    <div style="margin-top: 10px;"></div>
                    <button type="submit" name="updatepipeline">Update</button>
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