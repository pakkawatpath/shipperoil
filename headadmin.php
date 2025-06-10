<?php
include_once "db.php";
$level = $_SESSION["Level"];
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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
        <div class="d-flex flex-row">
            <div class="p-2">
                <?php
                if ($level = "admin") {
                ?>
                    <a href="page.php?page=user" class="btn btn-outline-warning" style="margin-left: 180px;">config</a>
                <?php } ?>
            </div>
            <div class="p-2">
                <form action="log.php" method="post">
                    <button name="Logout" class="btn btn-outline-danger">
                        <f class="fas fa-sign-out-alt"></f>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="row text-center justify-content-between">
        <div class="col">
            <a href='body.php?page=homepage&Page=1'><i class="fa fa-home" style="font-size: 80px;"></i><br>Home</a>
        </div>
        <div class="col">
            <a href='body.php?page=additi&Page=1'><i class="fa fa-cog" style="font-size: 80px;"></i><br>Additive</a>
        </div>
        <div class="col">
            <a href='body.php?page=trackmode&Page=1'><i class="fa fa-truck" style="font-size: 80px;"></i><br>Track Mode</a>
        </div>
        <div class="col">
            <a href='body.php?page=pipelinemode&Page=1'><i class="fa fa-tint" style="font-size: 80px;"></i><br>Pipeline Mode</a>
        </div>
    </div>

</body>

</html>