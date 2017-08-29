<?php
    require("db_config.php");
    $uid = $_POST["id"];
    $aid = $_POST["aid"];
    $avatar_path = "http://115.159.188.117/img/Avatar/" + $aid + ".png";
    $sql = "update user set avatar = '$avatar_path' where uid = '$uid'";
    $rs = mysqli_query($con, $sql);
    if($rs == false) { echo "数据库错误"; }
	else if(mysqli_num_rows($rs) != 1) { echo "数据库异常"; }
	else echo "头像修改成功";
    exit();
?>