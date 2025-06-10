<?php

include_once 'db.php';
error_reporting(E_ERROR | E_PARSE);
ini_set('max_execution_time', 0);

$sql = mysqli_query($conn, "INSERT INTO `product`(  `product_code`, 
                                                    `product_code_customer`, 
                                                    `description`, 
                                                    `remark`, 
                                                    `company`) 
                                            SELECT  `product_code`,
                                                    `product_code`,
                                                    `product`,
                                                    `product`,
                                                    `drawer`
                                            FROM    `drawer`
                                            WHERE   `type` = 'new'");

$check = mysqli_query($conn, "SELECT * FROM `drawer`");
if (($check->num_rows) > 0) {
    $sqldb = mysqli_query($conn, "UPDATE `drawer` SET `type`  = 'old' WHERE `type` = 'new'");
}
header("Location: body.php?Page=1");