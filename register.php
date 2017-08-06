<?php
	require("db_config.php");
	require("USER_to_XML.php");
	if(isset($_POST["register"])) {
		$user = $_POST["username"];  
		$pwd = $_POST["password"];  
		$pwd_confirm = $_POST["con_password"];  
		if($user == "" || $pwd == "" || $pwd_confirm == "") {
			echo '注册信息不能为空.-1';  
		} else {
			if($pwd == $pwd_confirm) {
				$sql = "select username from user where username = '$user'";
				$result = mysqli_query($con, $sql);
				$num = mysqli_num_rows($result); 
				if($num) {  
					echo '用户名已存在.-1';  
				} else {
					$sql_insert = "insert into user (username, password, level) values('$user', '$pwd', '0')";  
					$res_insert = mysqli_query($con, $sql_insert);  
					if($res_insert) {
						echo '注册成功，请重新登陆.0';
					} else {
						echo '系统繁忙，请稍候.-1';  
					}
				}
			} else { 
				echo '密码不一致.-1';  
			}  
		}  
	} else {  
		echo '提交失败.-1';  
	}
	exit();
?>  