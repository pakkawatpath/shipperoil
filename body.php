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

    <scrip; src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'>
        </script>
        <title>Home</title>
        <style>
            table.center {
                margin-left: auto;
                margin-right: auto;
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
    if ($_SESSION["Level"] == "admin") {
        include_once "headadmin.php";
    } else {
        include_once "head.php";
        // $l = $_SESSION["Level"];
        // $c = mysqli_query($conn ,"SELECT * FROM `company` WHERE `company` = '$l'");
        // $r = $c->fetch_array();
        // $rr = $r['drawercompany'];
        // $sql = mysqli_query($conn, "SELECT * FROM `data` WHERE `drawercompany` = '$rr'");
    }

    $page = $_GET["page"];

    if ($page == 'homepage') {

        $Per_Page = 25;   // Per Page
        $Page = $_GET["Page"];
        if (!$_GET["Page"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);
        if ($_SESSION["Level"] == "admin") {
    ?>
            <br>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                    <div class="col">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileInput" accept=".csv" name="file">
                                <label class="custom-file-label" for="customFileInput"></label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" name="submitcsv" class="btn btn-primary"> Upload</button>
                            </div>
                        </div>
                    </div>

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
            <div class="d-flex justify-content-center">
                <form action="product.php" method="get">
                    <!-- <label for="product_code">รหัสสินค้า</label>
            <select id="code" name="product_code">
                <option value="" disabled selected>--SELECT--</option>
                <?php
                $query = mysqli_query($conn, "SELECT DISTINCT `drawername` FROM `data`");

                while ($row = $query->fetch_array()) :
                ?>
                    <option value=""></option>
                <?php endwhile ?>
            </select> -->
                    <!-- <label for="st">ตั้งแต่</label> -->
                    <input type="date" name="st" required>&nbsp;&nbsp;
                    <label for="to"> To </label>&nbsp;&nbsp;
                    <input type="date" name="to" required>&nbsp;&nbsp;

                    <!-- <input type="hidden" name="company" value="<?php echo $_SESSION['Company'] ?>"> -->
                    <button type="submit" id="save" class="btn btn-primary">ค้นหา</button>
                </form>
            </div>

            <script>
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>
        <?php
            $sqldbs = "SELECT * FROM `data` ORDER BY `date` DESC, `id` ASC  LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `data`");
        } else {
            $shipper = $_SESSION["Shipper"];
            $sqldbs = "SELECT * FROM `data` WHERE `drawercompany` = '$shipper' ORDER BY `date` DESC, `id` ASC  LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `data` WHERE `drawercompany` = '$shipper'");
        }


        $Num_Rows = mysqli_num_rows($objQuery);
        if ($Num_Rows <= $Per_Page) {
            $Num_Pages = 1;
        } else if (($Num_Rows % $Per_Page) == 0) {
            $Num_Pages = ($Num_Rows / $Per_Page);
        } else {
            $Num_Pages = ($Num_Rows / $Per_Page) + 1;
            $Num_Pages = (int)$Num_Pages;
        }

        $First_Page = min(1, $Page);
        $Prev_Page = $Page - 1;
        $Next_Page = $Page + 1;
        $Last_Page = max($Num_Pages, $Page);

        function get_pagination_links($current_page, $total_pages, $url)
        {
            $links = "";
            if ($total_pages >= 1 && $current_page <= $total_pages) {
                $links .= "<a href=\"$url?page=homepage&Page=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?page=homepage&Page=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?page=homepage&Page=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }

        ?>
        <br>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <div class="container">
            <table border='1'>
                <thead>
                    <tr>
                        <?php
                        if ($_SESSION["Level"] == "admin") {
                        ?>
                            <th width="1%" class="text-center">ลบ</th>
                        <?php
                        }
                        ?>
                        <th width="3%" class="text-center">DATE</th>
                        <th width="1%" class="text-center">Drawer Company</th>
                        <th width="1%" class="text-center">Basename</th>
                        <th width="1%" class="text-center">Additive</th>
                        <th width="5%" class="text-center">Trip No</th>
                        <th width="1%" class="text-center">OBS (L)</th>
                        <th width="5%" class="text-center">Density</th>
                        <th width="1%" class="text-center">STD (L)</th>
                        <th width="1%" class="text-center">Temp (c)</th>
                        <th width="1%" class="text-center">Branch</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    //echo $sqldbs;
                    $sql = mysqli_query($conn, $sqldbs);
                    while ($row = $sql->fetch_array()) :
                        $d = $row['drawercompany'];
                        $x = mysqli_query($conn, "SELECT * FROM `company` WHERE `drawercompany` = '$d'");
                        $r = $x->fetch_array();
                        $a = $row['basename'];

                        $drawername = $row['drawername'];
                        if ($_SESSION["Level"] == "admin") {
                            $shipperall = $r['drawercompany'];
                            $b = mysqli_query($conn, "SELECT * FROM `basename` WHERE `shipper` = '$shipperall' AND `basename` = '$a' AND `drawername` = '$drawername'");
                            $c = $b->fetch_array();
                        } else {
                            $b = mysqli_query($conn, "SELECT * FROM `basename` WHERE `shipper` = '$shipper' AND `basename` = '$a' AND `drawername` = '$drawername'");
                            $c = $b->fetch_array();
                        }


                        if (empty($c['ch'])) {
                            $c = 'No Data';
                        } else {
                            $c = $c['ch'];
                        }
                    ?>
                        <tr>
                            <?php
                            if ($_SESSION["Level"] == "admin") {
                            ?>
                                <form action="del.php">
                                    <td class="text-center"><button type="submit" name="del"><img src='icon/delete.gif' /></button></td>
                                </form>
                                <!-- <td  width="1%"><a href='del.php?date=<?php echo $row['date'] ?>&id=<?php echo $row['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td> -->
                            <?php
                            }
                            ?>
                            <td class="text-center"><?php echo $row['date']; ?></td>
                            <td class="text-center"><?php echo $r['company']; ?></td>
                            <td class="text-center"><?php echo $c ?></td>
                            <td class="text-center"><?php echo $row['additive']; ?></td>
                            <td class="text-center"><?php echo $row['tripno']; ?></td>
                            <td class="text-center"><?php echo $row['obs']; ?></td>
                            <td class="text-center"><?php echo $row['density']; ?></td>
                            <td class="text-center"><?php echo $row['std']; ?></td>
                            <td class="text-center"><?php echo $row['temp']; ?></td>
                            <td class="text-center"><?php echo $row['branch']; ?></td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=homepage&Page=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
    <?php }

    if ($page == "additi") {
        $Per_Page = 25;   // Per Page
        $Page = $_GET["Page"];
        if (!$_GET["Page"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        $query = "SELECT * FROM `addi` ORDER BY `time` DESC LIMIT $Page_Start , $Per_Page";
        $objQuery = mysqli_query($conn, "SELECT * FROM `addi`");

        $Num_Rows = mysqli_num_rows($objQuery);
        if ($Num_Rows <= $Per_Page) {
            $Num_Pages = 1;
        } else if (($Num_Rows % $Per_Page) == 0) {
            $Num_Pages = ($Num_Rows / $Per_Page);
        } else {
            $Num_Pages = ($Num_Rows / $Per_Page) + 1;
            $Num_Pages = (int)$Num_Pages;
        }

        $First_Page = min(1, $Page);
        $Prev_Page = $Page - 1;
        $Next_Page = $Page + 1;
        $Last_Page = max($Num_Pages, $Page);

        function get_pagination_links($current_page, $total_pages, $url)
        {
            $links = "";
            if ($total_pages >= 1 && $current_page <= $total_pages) {
                $links .= "<a href=\"$url?page=additi&Page=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?page=additi&Page=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?page=additi&Page=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>
        <br>
        <div style="text-align: center;">
            <form action="in.php" method="post">
                <table width="60%" class="center">
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
                                $querycom = mysqli_query($conn, $sql);
                                while ($row = $querycom->fetch_array()) {
                                ?>
                                    <option value="<?php echo $row['drawercompany'] ?>"><?php echo $row['company'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="product" id="product" required>
                                <option value="">--------------------SELECT PRODUCT--------------------</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="received" placeholder="Received" required>
                        </td>
                    </tr>
                </table>
                <div style="margin-top: 10px;"></div>
                <input type="submit" name="additi" value="เพิ่ม">
            </form>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?page=additi&Page=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?page=additi&Page=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?page=additi&Page=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?page=additi&Page=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
            <table border='1' width='80%' class="center">
                <tr>
                    <th class="text-center" width="1%">ลบ</th>
                    <th class="text-center" width="1%">แก้ไข</th>
                    <th class="text-center" width="1%">Shipper</th>
                    <th class="text-center" width="1%">Product</th>
                    <th class="text-center" width="1%">Received</th>
                    <th class="text-center" width="1%">Time</th>
                </tr>
                <?php
                $result = mysqli_query($conn, $query);
                while ($rowaddi = $result->fetch_array()) {
                    $shipper = $rowaddi['shipper'];
                    $querycom = "SELECT * FROM `company` WHERE `drawercompany` = '$shipper'";
                    $resultcom = mysqli_query($conn, $querycom);
                    while ($rowcom = $resultcom->fetch_array()) {
                ?>
                        <tr>
                            <td class="text-center" width="1%"><a href='del.php?addi=<?php echo $rowaddi['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center" width="1%"><a href='edit.php?addi=<?php echo $rowaddi['id'] ?>'><img src='icon/edit.gif' /></a></td>
                            <td class="text-center" width="1%"><?php echo $rowcom['company']; ?></td>
                            <td class="text-center" width="3%"><?php echo $rowaddi['basename'] . " - " . $rowaddi['drawername'] . " - " . $rowaddi['ch']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowaddi['received']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowaddi['time']; ?></td>

                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            <br>
        </div>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=additi&Page=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=additi&Page=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=additi&Page=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=additi&Page=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
    <?php
    }

    if ($page == "trackmode") {
        $Per_Page = 25;   // Per Page
        $Page = $_GET["Page"];
        if (!$_GET["Page"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        $query = "SELECT * FROM `track` ORDER BY `time` DESC LIMIT $Page_Start , $Per_Page";
        $objQuery = mysqli_query($conn, "SELECT * FROM `track`");

        $Num_Rows = mysqli_num_rows($objQuery);
        if ($Num_Rows <= $Per_Page) {
            $Num_Pages = 1;
        } else if (($Num_Rows % $Per_Page) == 0) {
            $Num_Pages = ($Num_Rows / $Per_Page);
        } else {
            $Num_Pages = ($Num_Rows / $Per_Page) + 1;
            $Num_Pages = (int)$Num_Pages;
        }

        $First_Page = min(1, $Page);
        $Prev_Page = $Page - 1;
        $Next_Page = $Page + 1;
        $Last_Page = max($Num_Pages, $Page);

        function get_pagination_links($current_page, $total_pages, $url)
        {
            $links = "";
            if ($total_pages >= 1 && $current_page <= $total_pages) {
                $links .= "<a href=\"$url?page=trackmode&Page=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?page=trackmode&Page=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?page=trackmode&Page=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>
        <br>
        <div style="text-align: center;">
            <form action="in.php" method="post">
                <table width="80%" class="center">
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
                                $querycom = mysqli_query($conn, $sql);
                                while ($row = $querycom->fetch_array()) {
                                ?>
                                    <option value="<?php echo $row['drawercompany'] ?>"><?php echo $row['company'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="product" id="product" required>
                                <option value="">--------------------SELECT PRODUCT--------------------</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="received" placeholder="Received" required>
                        </td>
                        <td>
                            <input type="text" name="numberreceived" placeholder="เลขใบรับสินค้า" required>
                        </td>
                    </tr>
                </table>
                <div style="margin-top: 10px;"></div>
                <input type="submit" name="track" value="เพิ่ม">
            </form>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
            <table border='1' width='80%' class="center">
                <tr>
                    <th class="text-center" width="1%">ลบ</th>
                    <th class="text-center" width="1%">แก้ไข</th>
                    <th class="text-center" width="1%">Shipper</th>
                    <th class="text-center" width="1%">Product</th>
                    <th class="text-center" width="1%">Received</th>
                    <th class="text-center" width="1%">เลขใบรับสินค้า</th>
                    <th class="text-center" width="1%">Time</th>
                </tr>
                <?php
                $result = mysqli_query($conn, $query);
                while ($rowtrack = $result->fetch_array()) {
                    $shipper = $rowtrack['shipper'];
                    $querycom = "SELECT * FROM `company` WHERE `drawercompany` = '$shipper'";
                    $resultcom = mysqli_query($conn, $querycom);
                    while ($rowcom = $resultcom->fetch_array()) {
                ?>
                        <tr>
                            <td class="text-center" width="1%"><a href='del.php?track=<?php echo $rowtrack['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center" width="1%"><a href='edit.php?track=<?php echo $rowtrack['id'] ?>'><img src='icon/edit.gif' /></a></td>
                            <td class="text-center" width="1%"><?php echo $rowcom['company']; ?></td>
                            <td class="text-center" width="3%"><?php echo $rowtrack['basename'] . " - " . $rowtrack['drawername'] . " - " . $rowtrack['ch']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowtrack['received']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowtrack['number']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowtrack['time']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            <br>
        </div>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=trackmode&Page=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
    <?php
    }

    if ($page == "pipelinemode") {
        $Per_Page = 25;   // Per Page
        $Page = $_GET["Page"];
        if (!$_GET["Page"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        $query = "SELECT * FROM `pipeline` ORDER BY `time` DESC LIMIT $Page_Start , $Per_Page";
        $objQuery = mysqli_query($conn, "SELECT * FROM `pipeline`");

        $Num_Rows = mysqli_num_rows($objQuery);
        if ($Num_Rows <= $Per_Page) {
            $Num_Pages = 1;
        } else if (($Num_Rows % $Per_Page) == 0) {
            $Num_Pages = ($Num_Rows / $Per_Page);
        } else {
            $Num_Pages = ($Num_Rows / $Per_Page) + 1;
            $Num_Pages = (int)$Num_Pages;
        }

        $First_Page = min(1, $Page);
        $Prev_Page = $Page - 1;
        $Next_Page = $Page + 1;
        $Last_Page = max($Num_Pages, $Page);

        function get_pagination_links($current_page, $total_pages, $url)
        {
            $links = "";
            if ($total_pages >= 1 && $current_page <= $total_pages) {
                $links .= "<a href=\"$url?page=pipelinemode&Page=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?page=pipelinemode&Page=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?page=pipelinemode&Page=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>
        <br>
        <div style="text-align: center;">
            <form action="in.php" method="post">
                <table width="60%" class="center">
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
                                $querycom = mysqli_query($conn, $sql);
                                while ($row = $querycom->fetch_array()) {
                                ?>
                                    <option value="<?php echo $row['drawercompany'] ?>"><?php echo $row['company'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="product" id="product" required>
                                <option value="">--------------------SELECT PRODUCT--------------------</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="received" placeholder="Received" required>
                        </td>
                    </tr>
                </table>
                <div style="margin-top: 10px;"></div>
                <input type="submit" name="pipeline" value="เพิ่ม">
            </form>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
            <table border='1' width='80%' class="center">
                <tr>
                    <th class="text-center" width="1%">ลบ</th>
                    <th class="text-center" width="1%">แก้ไข</th>
                    <th class="text-center" width="1%">Shipper</th>
                    <th class="text-center" width="1%">Product</th>
                    <th class="text-center" width="1%">Received</th>
                    <th class="text-center" width="1%">Time</th>
                </tr>
                <?php
                $result = mysqli_query($conn, $query);
                while ($rowpipeline = $result->fetch_array()) {
                    $shipper = $rowpipeline['shipper'];
                    $querycom = "SELECT * FROM `company` WHERE `drawercompany` = '$shipper'";
                    $resultcom = mysqli_query($conn, $querycom);
                    while ($rowcom = $resultcom->fetch_array()) {
                ?>
                        <tr>
                            <td class="text-center" width="1%"><a href='del.php?pipeline=<?php echo $rowpipeline['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center" width="1%"><a href='edit.php?pipeline=<?php echo $rowpipeline['id'] ?>'><img src='icon/edit.gif' /></a></td>
                            <td class="text-center" width="1%"><?php echo $rowcom['company']; ?></td>
                            <td class="text-center" width="3%"><?php echo $rowpipeline['basename'] . " - " . $rowpipeline['drawername'] . " - " . $rowpipeline['ch']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowpipeline['received']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowpipeline['time']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            <br>
        </div>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=pipelinemode&Page=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
    <?php
    }
    ?>


    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>

</body>


</html>