<?php
    require_once("db_config.php");
    $oid = $_POST["oid"];
    $location = $_POST["location"];
    $sql = "update orders set status = '$location' where oid = '$oid'";
    $res = mysqli_query($con, $sql);
    if ($res == false) {
        echo "FAILED";
    } else {
        echo "成功";
    }
?>