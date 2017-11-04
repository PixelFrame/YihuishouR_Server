<?php
    require_once("db_config.php");
    $oid = $_POST["oid"];
    $status = $_POST["status"];
    $sql = "update orders set status = '$status' where oid = '$oid'";
    $res = mysqli_query($con, $sql);
    if ($res == false) {
        echo "FAILED";
    } else {
        echo "成功";
    }
?>