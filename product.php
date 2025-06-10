<?php

include_once "db.php";
error_reporting(E_ERROR | E_PARSE);

$product_code = $_GET['product_code'];
//$product_code_customer = $_POST['product_code_customer'];
$description = $_GET['de'] . "%";
$remark = $_GET['remark'];
$company = $_GET['company'];
$st = $_GET['st'];
$to = $_GET['to'];
$select = $_GET['select'];
// $lev = $_GET['lev'];
// $c = mysqli_query($conn, "SELECT * FROM `company` WHERE `company` = '$lev'");
// $r = $c->fetch_array();
// $rr = $r['drawercompany'];

//mysqli_query($conn, "INSERT INTO `product`(`product_code`, `product_code_customer`, `description`, `remark`, `company`) VALUES ('$product_code','$product_code_customer','$description','$remark','$company')");
//$sql = mysqli_query($conn, "SELECT * FROM `product` WHERE (`product_code` = '$product_code' OR `description` LIKE '$description') AND (`remark` = '$remark' OR `company` = '$company')");
//echo "SELECT * FROM `product` WHERE (`product_code` = '$product_code' OR `description` = '$description') AND (`remark` = '$remark' OR `company` = '$company')";
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

        <style>
            #back {
                margin-left: 85px;
                margin-bottom: 10px;
            }
        </style>
        <title>Search</title>
</head>

<body>
    <br>
    <?php
    include_once "headp.php";
    $Per_Page = 25;   // Per Page
    $Page = $_GET["Page"];
    if (!$_GET["Page"]) {
        $Page = 1;
    }
    $Page_Start = (($Per_Page * $Page) - $Per_Page);

    if ($_SESSION["Level"] == "admin") {
        $sql = "SELECT * FROM `data` WHERE `date` BETWEEN '$st' AND '$to' ORDER BY `date` DESC, `id` ASC LIMIT $Page_Start , $Per_Page";
        $sqlobj = "SELECT * FROM `data` WHERE `date` BETWEEN '$st' AND '$to'";
    } else {
        $shipper = $_SESSION["Shipper"];
        $sql = "SELECT * FROM `data` WHERE `drawercompany` = '$shipper' AND `date` BETWEEN '$st' AND '$to' ORDER BY `date` DESC, `id` ASC LIMIT $Page_Start , $Per_Page";
        $sqlobj = "SELECT * FROM `data` WHERE `drawercompany` = '$shipper' AND `date` BETWEEN '$st' AND '$to'";
    }


    $objQuery = mysqli_query($conn, $sqlobj);

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

    function get_pagination_links($current_page, $total_pages, $url, $st, $to, $select)
    {
        $links = "";
        if ($total_pages >= 1 && $current_page <= $total_pages) {
            $links .= "<a href=\"$url?Page=1&st=$st&to=$to&select=$select\">1</a>";
            $i = max(2, $current_page - 3);
            if ($i > 2)
                $links .= " ... ";
            for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                if ($current_page == $i) {
                    $links .=  "<a href=\"$url?Page=$i&st=$st&to=$to&select=$select\"> <b>$i</b> </a>";
                }
                // elseif ($i == $total_pages) {
                //     continue;
                // } 
                else {
                    $links .=  "<a href=\"$url?Page=$i&st=$st&to=$to&select=$select\"> $i </a>";
                }
            }
        }
        return $links;
    }
    ?>
    <div class="d-flex justify-content-between">
        <div class="p-2">
            <button class="btn btn-danger" onclick="window.location.href='body.php?page=homepage&Page=1'"><i class="fa fa-arrow-left"></i> BACK</button>
        </div>
        <div class="p-2">
            <form action="down.php" method="post">
                <input type="hidden" name="st" value="<?php echo $st ?>">
                <input type="hidden" name="to" value="<?php echo $to ?>">
                <input type="hidden" name="select" value="<?php echo $select ?>">
                <!-- <input type="hidden" name="lev" value="<?php echo $rr ?>"> -->
                <input type="submit" class="btn btn-outline-success" value="Download">
            </form>
        </div>
    </div>
    <br>
    <div style="text-align:center;">
        <div class="row ">
            <div class="col-4"></div>
            <div class="col-4">
                <?php

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$First_Page&st=$st&to=$to&select=$select'><< First</a> ";
                }

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&st=$st&to=$to&select=$select'><< Back</a> ";
                }

                echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME'], $st, $to, $select);

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&st=$st&to=$to&select=$select'>Next>></a> ";
                }

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Last_Page&st=$st&to=$to&select=$select'>Last>></a> ";
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
                // $sql = mysqli_query($conn, "SELECT * FROM `data` WHERE `drawercompany` = '$rr' AND `date` BETWEEN '$st' AND '$to'");


                //echo("SELECT * FROM `data` WHERE `date` BETWEEN '$st' AND '$to'");
                $sql = mysqli_query($conn, $sql);
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
                            <td class="text-center" width="1%"><a href='del.php?date=<?php echo $row['date'] ?>&id=<?php echo $row['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
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
                    echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$First_Page&st=$st&to=$to&select=$select'><< First</a> ";
                }

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&st=$st&to=$to&select=$select'><< Back</a> ";
                }

                echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME'], $st, $to, $select);

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&st=$st&to=$to&select=$select'>Next>></a> ";
                }

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Last_Page&st=$st&to=$to&select=$select'>Last>></a> ";
                }

                ?>
            </div>
        </div>
    </div>


</body>

</html>