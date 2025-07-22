<?php
include_once 'db.php';
include_once 'headadmin.php';
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
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #fff;
            background-color: #0c9ed9;
            width: 40%;
            margin-left: auto;
            margin-right: auto;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #3d69b2;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #00ffff;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 50px 50px;
            /* border: 1px solid #0c9ed9; */
            border-top: none;
        }

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

        body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <br>
    <?php
    include_once('tabaddi.php');

    if (isset($_GET["date"])) {

        $Per_Page = 25;   // Per Page
        $Page = $_GET["date"];
        if (!$_GET["date"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        $query = "SELECT * FROM `addi` ORDER BY `date` DESC LIMIT $Page_Start , $Per_Page";
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
        <div style="text-align:center;">
            <br>
            <a href="addadditivedate.php" class="btn btn-success">เพิ่ม</a>
            <br>
            <br>

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
        <table border='1' width='100%' class="center">
            <tr>
                <th class="text-center" width="1%">ลบ</th>
                <th class="text-center" width="1%">แก้ไข</th>
                <th class="text-center" width="1%">Shipper</th>
                <th class="text-center" width="1%">Date</th>
                <th class="text-center" width="1%">Unopened packaging</th>
                <th class="text-center" width="1%">Stock in day tank</th>
                <th class="text-center" width="1%">Dead stock</th>
                <th class="text-center" width="1%">Delivery</th>
                <th class="text-center" width="1%">Line content</th>
                <th class="text-center" width="1%">Total stock</th>
                <th class="text-center" width="1%">Available stock</th>
                <th class="text-center" width="1%">Remark</th>
            </tr>
            <?php
            $result = mysqli_query($conn, $query);
            while ($rowaddi = $result->fetch_array()) {
                $shipper = $rowaddi['shipper'];
                $querycom = "SELECT * FROM `company` WHERE `drawercompany` = '$shipper'";
                $resultcom = mysqli_query($conn, $querycom);
                while ($rowcom = $resultcom->fetch_array()) {
                    $total = $rowaddi['unopened'] + $rowaddi['stock'] + $rowaddi['line'];
            ?>
                    <tr>
                        <td class="text-center" width="1%"><a href='del.php?addi=<?php echo $rowaddi['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                        <td class="text-center" width="1%"><a href='edit.php?addi=<?php echo $rowaddi['id'] ?>'><img src='icon/edit.gif' /></a></td>
                        <td class="text-center" width="1%"><?php echo $rowcom['company']; ?></td>
                        <td class="text-center" width="3%"><?php echo $rowaddi['date']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['unopened'] ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['stock'] ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['deadstock'] ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['delivery'] ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['line'] ?></td>
                        <td class="text-center" width="1%"><?php echo $total?></td>
                        <td class="text-center" width="1%"><?php echo $total - $rowaddi['deadstock'] - $rowaddi['line'] ?></td>
                        <td class="text-center"><?php echo $rowaddi['remark'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
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
    <?php
    } else if (isset($_GET['month-year'])) {
        $Per_Page = 25; // Per Page
        $Page = $_GET["month-year"];
        if (!$_GET["month-year"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        $query = "SELECT * FROM `addimonth` ORDER BY `id` DESC LIMIT $Page_Start , $Per_Page";
        $objQuery = mysqli_query($conn, "SELECT * FROM `addimonth`");

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
                $links .= "<a href=\" $url?page=additi&Page=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .= "<a href=\" $url?page=additi&Page=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    // continue;
                    // }
                    else {
                        $links .= "<a href=\"$url?page=additi&Page=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>


        <div style="text-align:center;">

            <br>

            <a href="addadditive.php" class="btn btn-success">เพิ่ม</a>

            <br>
            <br>

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
                <th class="text-center" width="1%">Month-Year</th>
                <th class="text-center" width="1%">Remaining</th>
                <th class="text-center" width="1%">Stock in day tank</th>
                <th class="text-center" width="1%">Dead stock</th>
                <th class="text-center" width="1%">Line content</th>
                <th class="text-center" width="1%">Total stock</th>
                <th class="text-center" width="1%">Available stock</th>
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
                        <td class="text-center" width="1%"><a href='del.php?addimonth=<?php echo $rowaddi['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                        <td class="text-center" width="1%"><a href='edit.php?addimonth=<?php echo $rowaddi['id'] ?>'><img src='icon/edit.gif' /></a></td>
                        <td class="text-center" width="1%"><?php echo $rowcom['company']; ?></td>
                        <td class="text-center" width="1%">
                            <?php
                            $monthyear = date_create($rowaddi['monthyear']);
                            echo date_format($monthyear, "M-Y");
                            ?>
                        </td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['remaining']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['stock']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['deadstock']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['line']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['total']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowaddi['available']; ?></td>

                    </tr>
            <?php
                }
            }
            ?>
        </table>
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
    <?php
    }
    ?>
    <br>
</body>

</html>