<!doctype html>
<html>

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

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <meta charset="UTF-8">
    <title>Login</title>
    
</head>

<body>

    <form name="frmlogin" method="post" action="log.php">

        <div style="margin: 160px 2% -10px;text-align:center;">
            <p><b> Login </b></p>
        </div>
        <div style="margin: 30px 2% -10px;text-align:center;">
            <p> ชื่อผู้ใช้ :
                <input type="text" id="Username" required name="Username" placeholder="Username">
            </p>
            <div style="margin-right: 9px;">
                <p>รหัสผ่าน :
                    <input type="password" id="Password" required name="Password" placeholder="Password">
                </p>
            </div>
            <p>
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
                &nbsp;&nbsp;
                <button class="btn btn-outline-danger" type="reset"><i class="fas fa-undo"></i> Reset</button>
            </p>
        </div>
    </form>
</body>

</html>