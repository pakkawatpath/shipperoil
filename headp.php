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
</head>

<body>
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
            <!-- <input type="hidden" name="company" value="<?php echo $_SESSION['Company'] ?>"> -->
            
            <button type="submit" class="btn btn-primary">ค้นหา</button>
        
        </form>
    </div>

</body>

</html>