<?php
include_once "db.php";

$page = $_GET['page'];
?>

<!doctype html>
<html>

<head>

    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <meta charset="UTF-8">
    <title>Config</title>

    <style>
        table.center {
            margin-left: auto;
            margin-right: auto;
        }

        #bt {
            margin-left: 310px;
        }

        #do {
            margin-left: 1140px;
            color: #3d69b2;
        }

        #save {
            margin-bottom: 5px;
        }
    </style>

</head>

<body>
    <?php
    include_once 'headconfig.php';
    ?>

    <?php

    if ($page == "user") {
    ?>
        <br />
        <div class="d-flex justify-content-center">
            <div>
                <form action="in.php" method="post">
                    <label for="shipper">Shipper:</label>
                    <select name="shipper">
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
                    <label for="user">Username:</label>
                    <input type="text" name="user">
                    <label for="pass">Password:</label>
                    <input type="text" name="pass">
                    <label for="com">ระดับผู้ใช้:</label>
                    <select name="level">
                        <option value="" disabled selected>--SELECT--</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                        <!-- <?php
                                $r = mysqli_query($conn, "SELECT * FROM `company`");
                                while ($row = $r->fetch_array()) :
                                ?>
                            <option value="<?php echo $row['company'] ?>"><?php echo $row['company'] ?></option>
                        <?php
                                endwhile;
                        ?> -->
                    </select>&nbsp;
                    <input type="submit" value="เพิ่ม" name="sub">
                </form>
            </div>
        </div>
        <br>

        <table border='1' width='80%' class="center">

            <thead>

                <tr>
                    <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                    <th class="text-center" width="1%">ลบ</th>
                    <th class="text-center" width="1%">Shipper</th>
                    <th class="text-center" width="10%">User</th>
                    <th class="text-center" width="10%">ระดับผู้ใช้</th>
                </tr>
            </thead>

            <tbody>
                <div style="margin: 10px 2% -10px;text-align:center;"></div>
                <?php
                $sqldbs = "SELECT * FROM `user`";
                $resultdbs = mysqli_query($conn, $sqldbs);
                while ($rowdbs = $resultdbs->fetch_array()) :
                ?>
                    <tr>
                        <?php if ($_SESSION['UserID'] == $rowdbs['user']) { ?>
                            <!-- <td class="text-center" width="1%"><a href='ie.php?id=user&user=<?php echo $rowdbs['user'] ?>'><img src='icon/edit.gif' /></button></a></td> -->
                            <td></td>
                            <td></td>
                            <td class="text-center" width="1%"><?php echo $rowdbs['user']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowdbs['level'] ?></td>
                        <?php } else { ?>
                            <!-- <td class="text-center" width="1%"><a href='ie.php?id=user&user=<?php echo $rowdbs['user'] ?>'><img src='icon/edit.gif' /></button></a></td> -->
                            <td class="text-center" width="1%"><a href='del.php?user=<?php echo $rowdbs['user'] ?>&id=<?php echo $rowdbs['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center" width="1%"><?php echo $rowdbs['shipper']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowdbs['user']; ?></td>
                            <td class="text-center" width="1%"><?php echo $rowdbs['level'] ?></td>
                        <?php } ?>
                    </tr>

                <?php endwhile ?>

            </tbody>

        </table></br>
    <?php }

    if ($page == "oil") {

        $Per_Page = 25;   // Per Page
        $Page = $_GET["number"];
        if (!$_GET["number"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        $query = "SELECT * FROM `basename` LIMIT $Page_Start , $Per_Page";
        $objQuery = mysqli_query($conn, "SELECT * FROM `basename`");

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
                $links .= "<a href=\"$url?page=oil&number=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?page=oil&number=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?page=oil&number=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }

    ?>
        <br />
        <div style="text-align:center;">
            <a href="addoil.php" class="btn btn-success">เพิ่ม</a>

            <br>
            <br>
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=oil&number=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=oil&number=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=oil&number=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=oil&number=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
        <table border='1' width='99%' class="center">
            <thead>
                <tr>
                    <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                    <th class="text-center" width="1%">ลบ</th>
                    <th class="text-center" width="10%">Shipper</th>
                    <th class="text-center" width="10%">Product Code</th>
                    <th class="text-center" width="10%">Base Code</th>
                    <th class="text-center" width="10%">Basename</th>
                    <th class="text-center" width="10%">Drawer Name</th>
                    <th class="text-center" width="10%">Basename Customer</th>
                </tr>
            </thead>

            <tbody>
                <div style="margin: 10px 2% -10px;text-align:center;"></div>

                <?php

                $resultdbs = mysqli_query($conn, $query);
                while ($rowdbs = $resultdbs->fetch_array()) :
                ?>
                    <tr>
                        <!-- <td class="text-center" width="1%"><a href='editpage.php?door=<?php echo $rowdbs['doorname'] ?>'><img src='icon/edit.gif' /></a></td> -->
                        <td class="text-center" width="1%"><a href='del.php?oil=<?php echo $rowdbs['basename'] ?>&id=<?php echo $rowdbs['id'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['shipper']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['productname']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['basecode']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['basename']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['drawername']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['ch'] ?></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table></br>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=oil&number=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?page=oil&number=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=oil&number=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=oil&number=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
    <?php }

    if ($page == "company") { ?>
        <br />
        <div class="d-flex justify-content-center">
            <form action="in.php" method="post">
                <label for="code">รหัส Shipper:</label>&nbsp;&nbsp;
                <input type="text" name="code">&nbsp;&nbsp;
                <label for="com">ชื่อ Shipper:</label>&nbsp;&nbsp;
                <input type="text" name="com">&nbsp;&nbsp;
                <input type="submit" value="เพิ่ม" name="company">
            </form>

        </div>
        <br>
        <table border='1' width='80%' class="center">

            <thead>

                <tr>
                    <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                    <th class="text-center" width="1%">ลบ</th>
                    <th class="text-center" width="10%">รหัส Shipper</th>
                    <th class="text-center" width="10%">Shipper</th>
                </tr>
            </thead>

            <tbody>
                <div style="margin: 10px 2% -10px;text-align:center;"></div>

                <?php
                $sqldbs = "SELECT * FROM `company`";
                $resultdbs = mysqli_query($conn, $sqldbs);
                while ($rowdbs = $resultdbs->fetch_array()) :
                ?>

                    <tr>
                        <!-- <td class="text-center" width="1%"><a href='editpage.php?company=<?php echo $rowdbs['Companyname'] ?>'><img src='icon/edit.gif' /></button></a></td> -->
                        <td class="text-center" width="1%"><a href='del.php?company=<?php echo $rowdbs['company'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['drawercompany']; ?></td>
                        <td class="text-center" width="1%"><?php echo $rowdbs['company']; ?></td>
                    </tr>

                <?php endwhile ?>

            </tbody>

        </table></br>
    <?php
    }
    ?>
</body>

</html>