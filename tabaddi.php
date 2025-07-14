<?php
include_once 'menu.php';
include_once 'db.php';
?>

<!DOCTYPE html>
<html>

<head>
    
    <style>
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #0c9ed9;
            width: 40%;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #3d69b2;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            /* border: 1px solid #ccc; */
            border-top: none;
        }
    </style>
</head>

<body>
    <div class="tab">
        <form action="additive.php" method="get">
            <button class="submit" name="date" value="1">Date</button>
            <button class="submit" name="month-year" value="1">Month-Year</button>
        </form>
    </div>
</body>

</html>