<?php
	require "USER_to_XML.php";
	require "db_config.php";
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "select * from user where username = '$username' and password='$password'";
		$rs = mysqli_query($con, $sql);
		if($rs == false) {
			echo 'DATABASE SELECT ERROR';
		} else if(mysqli_num_rows($rs) == 1){
			toXml($rs);
		} else {
			echo '登录失败';
		}
	} else {
		echo '连接成功';
	}
	exit();
?>