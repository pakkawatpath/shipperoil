<?php
include_once "db.php";

$id = $_GET['id'];

if (!empty($_GET['user'])) {
    $user = $_GET['user'];
    $queryuser = mysqli_query($conn, "SELECT * FROM `user` WHERE `user` = '$user'");
    $row = mysqli_fetch_array($queryuser);
}

?>
<!DOCTYPE html>
<html lang="en">

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
    <?php
    if (!empty($id)) { ?>
        <title><?php echo $id ?></title>
    <?php
    } else {
    }

    if (!empty($door)) { ?>
        <title><?php echo $door ?></title>
    <?php
    } else {
    }

    if (!empty($com)) { ?>
        <title><?php echo $com ?></title>
    <?php
    } else {
    }
    ?>
    <style>
        #back {
            margin-top: 10px;
            margin-left: 10px;
        }

        #user {
            margin-left: auto;
            margin-right: auto;
        }

        #pass {
            margin-left: 150px;
        }

        #cpass {
            margin-left: 113px;
        }

        #ppass {
            margin-left: 125px;
        }

        #ccpass {
            margin-left: 85px;
        }

        #oldpass {
            margin-left: 130px;
        }

        #name {
            margin-left: 60px;
        }

        #surname {
            margin-left: 25px;
        }
    </style>
</head>

<body>
    <button id="back" class="btn btn-danger" onclick="window.location.href='page.php?page=user'"><i class="fa fa-arrow-left"></i> BACK</button>
    <div style="margin: 100px 2% -10px;text-align:center;"></div>
    <div style="margin: 100px 2% -10px;text-align:center;"> <br>
        <?php
        if ($id == 'newuser') {
        ?>
            <h4>เพิ่มUser</h4>
        <?php } ?>
        <?php
        if ($id == 'user') {
        ?>
            <h4>แก้ไขUser</h4>
        <?php } ?>
        <br />
        <form action="in.php" method="post">
            <div id="user" style="text-align:center;">
                <div class="col">
                    <?php
                    if ($id == 'newuser') {
                    ?>
                        ไอดีผู้ใช้งาน: <input type="text" required name="iuser" class="form-group mx-sm-3 mb-2" required minlength="3">
                    <?php } elseif ($id == 'user') { ?>
                        ไอดีผู้ใช้งาน: <input type="text" require name="user" class="form-group mx-sm-3 mb-2" require minlength="3" value="<?php echo $user ?>">
                    <?php } ?>
                </div>
            </div>

            <?php
            if ($id == 'newuser') {
            ?><div id="pass" style="text-align:center;">
                    <div class="col">
                        รหัสผ่าน: <input type="password" id="myInput" require name="ipass" class="form-group mx-sm-3 mb-2" require minlength="3">
                        <input type="checkbox" onclick="myFunctionx()">Show Password
                    </div>
                </div>
            <?php } elseif ($id == 'user') { ?>
                <div id="ppass" style="text-align:center;">
                    <div class="col">
                        รหัสผ่านใหม่: <input type="password" id="myInput" require name="pass" class="form-group mx-sm-3 mb-2" require minlength="3">
                        <input type="checkbox" onclick="myFunctionx()">Show Password
                    </div>
                </div>
            <?php } ?>

            <?php
            if ($id == 'newuser') {
            ?>
                <div id="cpass" style="text-align:center;">
                    <div class="col">
                        ยืนยันรหัสผ่าน: <input type="password" id="Input" require name="iconpass" class="form-group mx-sm-3 mb-2" require minlength="3">
                        <input type="checkbox" onclick="myFunctiony()">Show Password
                    </div>
                </div>
            <?php } elseif ($id == 'user') { ?>
                <div id="ccpass" style="text-align:center;">
                    <div class="col">
                        ยืนยันรหัสผ่านใหม่: <input type="password" id="Input" require name="conpass" class="form-group mx-sm-3 mb-2" require minlength="3">
                        <input type="checkbox" onclick="myFunctiony()">Show Password
                    </div>
                </div>
            <?php } ?>

            <?php
            if ($id == 'user') { ?>
                <div id="oldpass" style="text-align:center;">
                    <div class="col">
                        รหัสผ่านเก่า: <input type="password" id="oldInput" require name="oldpass" class="form-group mx-sm-3 mb-2" require minlength="3">
                        <input type="checkbox" onclick="myFunctionz()">Show Password
                    </div>
                </div>
            <?php }
            ?>
            <div id="company" style="text-align:center;">
                <div class="col">
                    <?php if ($id == 'newuser') { ?>
                        <div style="text-align:center;">
                            <label for="icompany">เลือกบริษัท</label>
                            <select id="icompany" name="icompany">
                                <option value="" disabled selected>--SELECT--</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT DISTINCT `company` FROM `product`");
                                while ($row = $sql->fetch_array()) :
                                ?>
                                    <option value="<?php echo $row['company'] ?>"><?php echo $row['company'] ?></option>
                                <?php
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <label for="ilevel">เลือกระดับผู้ใช้</label>
                        <select id="ilevel" name="ilevel" required>
                            <option value="" disabled selected>--SELECT--</option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                    <?php } elseif ($id == 'user') {

                    ?>
                        <!-- <div style="text-align:center;">
                            <label for="company">เลือกบริษัท</label>
                            <select id="company" name="company">
                                <?php
                                if (empty($row['company'])) { ?>
                                    <option value="">--SELECT--</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT DISTINCT `company` FROM `product`");
                                    while ($row = $sql->fetch_array()) :
                                    ?>
                                        <option value="<?php echo $row['company'] ?>"><?php echo $row['company'] ?></option>
                                    <?php endwhile;
                                } else {
                                    $queryuser = mysqli_query($conn, "SELECT * FROM `users` WHERE `user` = '$user'");
                                    $row = mysqli_fetch_array($queryuser);
                                    $com = $row['company'];
                                    $querycom = mysqli_query($conn, "SELECT DISTINCT `company` FROM `product` WHERE `company` NOT IN ('$com')");
                                    ?>
                                    <option value="<?php echo $row['company'] ?>"><?php echo $row['company'] ?></option>
                                    <?php
                                    while ($rowcom = $querycom->fetch_array()) :
                                    ?>
                                    <option value="<?php echo $rowcom['company'] ?>"><?php echo $rowcom['company'] ?></option>

                                <?php 
                                endwhile;
                            } ?>
                            </select>
                        </div> -->
                        <?php
                        if ($_SESSION['UserID'] == $user) {
                            $queryuser = mysqli_query($conn, "SELECT * FROM `user3` WHERE `user` = '$user'");
                            $row = mysqli_fetch_array($queryuser);
                        ?>
                            <input type="hidden" id="level" name="level" value="<?php echo $row['level'] ?>">
                        <?php
                        } else { ?>
                            <div style="text-align:center;">
                                <label for="level">เลือกระดับผู้ใช้</label>
                                <select id="level" name="level">
                                    <?php
                                    if (empty($row['level'])) { ?>
                                        <option value="" disabled selected>--SELECT--</option>
                                        <option value="admin">admin</option>
                                        <option value="user">user</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $row['level'] ?>"><?php echo $row['level'] ?></option>
                                        <?php if ($row['level'] == 'admin') { ?>
                                            <option value="user">user</option>
                                        <?php } else { ?>
                                            <option value="admin">admin</option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>

            <div style="margin: 30px;text-align:center;">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> บันทึก</button>
            </div>
        </form>
    </div>

    <script>
        function myFunctionx() {
            var x = document.getElementById("myInput")

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

        }

        function myFunctiony() {
            var y = document.getElementById("Input");

            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }

        }

        function myFunctionz() {
            var z = document.getElementById("oldInput");

            if (z.type === "password") {
                z.type = "text";
            } else {
                z.type = "password";
            }

        }
    </script>
</body>

</html>