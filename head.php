<?php
include_once "db.php";
$level = $_SESSION["Level"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    </script>
    <style>
        #up {
            margin-left: 123px;
        }

        #bt {
            margin-left: 90px;
            margin-right: 90px;
        }

        #name {
            margin-left: 990px;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-end">
        <div class="p-3">
            <?php
            $user = $_SESSION["UserID"];
            $sql = "SELECT * FROM `user` WHERE `user` = '$user'";
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) :
            ?>
                <h6>
                    <img src='icon/user.png' width="20" height="20" /> User:<?php echo " " . $row['user'] ?>
                    <!-- <i class="fas fa-id-card-alt"></i>  Level:<?php echo " " . $level ?> -->
                </h6>
            <?php endwhile; ?>
        </div>
        <div class="p-2">
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-nowrap">
                <!-- <div class="p-2">
                    <?php
                    if ($level = "admin") {
                    ?>
                        <a href="page.php?page=user" class="btn btn-outline-warning" style="margin-left: 180px;">config</a>
                    <?php } ?>
                </div> -->
                <div class="p-2">
                    <form action="log.php" method="post">
                        <button name="Logout" class="btn btn-outline-danger">
                            <f class="fas fa-sign-out-alt"></f>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="d-flex justify-content-center">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="my-5 col-sm-9 col-md-6 col-lg-8 col-xl-10">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileInput" accept=".csv" name="file">
                            <label class="custom-file-label" for="customFileInput"></label>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-primary"> Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> -->


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
            <input type="date" name="st">&nbsp;&nbsp;
            <label for="to"> To </label>&nbsp;&nbsp;
            <input type="date" name="to">&nbsp;&nbsp;
            <!-- <select name="select">
                <option value="all">ทั้งหมด</option>
                <?php
                $c = mysqli_query($conn, "SELECT * FROM `company`");
                while ($x = $c->fetch_array()) {
                    $drawercompany = $x['drawercompany'];
                    $company = $x['company'];
                    ?>
                    <option value="<?php echo $drawercompany ?>"><?php echo $company ?></option>
                    <?php
                }
                ?>
            </select>&nbsp;&nbsp; -->
            <!-- <input type="hidden" name="lev" value="<?php echo $_SESSION['Level'] ?>"> -->
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

</body>

</html>