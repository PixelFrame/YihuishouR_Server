<?php
    require("db_config.php");
    $uid = $_POST["uid"];
    $aid = $_POST["aid"];
    $avatar_path = "http://115.159.188.117/img/Avatar/" + $aid + ".png";
    $sql = "update user set avatar = '$avatar_path' where uid = '$uid'";
    $rs = mysqli_query($con, $sql);
    if($rs == false) { echo "数据库错误"; }
	else echo "头像修改成功";
    exit();
?>