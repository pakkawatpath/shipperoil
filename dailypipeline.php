<?php
include 'db.php';

$Per_Page = 25;   // Per Page
$Page = $_GET["Page"];
if (!$_GET["Page"]) {
    $Page = 1;
}
$Page_Start = (($Per_Page * $Page) - $Per_Page);

$date = $_GET["date"];
if ($date == "") {
    $date = "";
}

$query = "SELECT * FROM `pipeline` WHERE date(`datetime`) = '$date' ORDER BY `datetime` DESC LIMIT $Page_Start , $Per_Page";
$objQuery = mysqli_query($conn, "SELECT * FROM `pipeline` WHERE date(`datetime`) = '$date' ");

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

function get_pagination_links($current_page, $total_pages, $url, $date)
{
    $links = "";
    if ($total_pages >= 1 && $current_page <= $total_pages) {
        $links .= "<a href=\"$url?date=$date&Page=1\">1</a>";
        $i = max(2, $current_page - 3);
        if ($i > 2)
            $links .= " ... ";
        for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
            if ($current_page == $i) {
                $links .=  "<a href=\"$url?date=$date&Page=$i\"> <b>$i</b> </a>";
            }
            // elseif ($i == $total_pages) {
            //     continue;
            // } 
            else {
                $links .=  "<a href=\"$url?date=$date&Page=$i\"> $i </a>";
            }
        }
    }
    return $links;
}

$_SESSION['url'] = $_SERVER['REQUEST_URI'];
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

        #back {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="back" class="col-2">
        <button class="btn btn-danger" onclick="window.location.href='body.php?page=pipelinemode&Page=1'"><i class="fa fa-arrow-left"></i> BACK</button>
    </div>
    <div style="text-align: center;">
        <h3>Daily Pipeline</h3>
        <br>
        <form action="" method="get">
            <input type="date" name="date">
            <input type="hidden" name="Page" value="1">
            <br><br>
            <input type="submit" class="btn btn-success" value="ค้นหา">
        </form>
        <br>
        <div class="row ">
            <div class="col-4"></div>
            <div class="col-4">
                <?php

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?date=$date&Page=$First_Page'><< First</a> ";
                }

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?date=$date&Page=$Prev_Page'><< Back</a> ";
                }

                echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME'], $date);

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?date=$date&Page=$Next_Page'>Next>></a> ";
                }

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?date=$date&Page=$Last_Page'>Last>></a> ";
                }

                ?>
            </div>
        </div><br>
        <table border='1' width='95%' class="center">
            <tr>
                <th class="text-center" width="1%">ลบ</th>
                <th class="text-center" width="1%">แก้ไข</th>
                <th class="text-center" width="1%">Shipper</th>
                <th class="text-center" width="1%">Product</th>
                <th class="text-center" width="1%">Received</th>
                <th class="text-center" width="1%">ถังจัดเก็บ</th>
                <th class="text-center" width="1%">วันที่บันทึก</th>
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
                        <td class="text-center" width="1%"><?php echo $rowpipeline['basename']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowpipeline['received']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowpipeline['tank']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowpipeline['datetime']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table><br>
        <div class="row ">
            <div class="col-4"></div>
            <div class="col-4">
                <?php

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?date=$date&Page=$First_Page'><< First</a> ";
                }

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?date=$date&Page=$Prev_Page'><< Back</a> ";
                }

                echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME'], $date);

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?date=$date&Page=$Next_Page'>Next>></a> ";
                }

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?date=$date&Page=$Last_Page'>Last>></a> ";
                }

                ?>
            </div>
        </div>
    </div>
</body>

</html>