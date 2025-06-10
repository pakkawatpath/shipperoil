<?php
include_once "db.php";
$sql = mysqli_query($conn, "SELECT * FROM `data`");
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
            #submit {
                margin-top: 40px;
                margin-left: 950px;
            }

            #back {
                margin-top: 40px;
                margin-left: 100px;
            }
        </style>
</head>

<body>
    <br />
    <div class="row">
        <a href="del.php?delb=delall" id="back" class="btn btn-danger" onclick="return confirm('ต้องการกลับไปหน้าแรกหรือไม่')">BACK</a>
        <a href="body.php?Page=1" id="submit" class="btn btn-primary">SUBMIT</a>
    </div>
    <br />
    <div class="container">
        <table border='1'>
            <thead>
                <tr>
                    <th width="1%" class="text-center">DATE</th>
                    <th width="1%" class="text-center">Drawer Company</th>
                    <th width="1%" class="text-center">Base Name</th>
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
                while ($row = $sql->fetch_array()) :
                ?>
                    <tr>
                        <td class="text-center"><?php echo $row['date']; ?></td>
                        <td class="text-center"><?php echo $row['drawercompany']; ?></td>
                        <td class="text-center"><?php echo $row['basename']; ?></td>
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
</body>

</html>