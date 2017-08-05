<?php  
	if(isset($_POST["register"])) {
		$user = $_POST["username"];  
		$pwd = $_POST["password"];  
		$pwd_confirm = $_POST["con_password"];  
		if($user == "" || $pwd == "" || $pwd_confirm == "") {
			echo '注册信息不能为空';  
		} else {
			if($pwd == $pwd_confirm) {
				if($con = mysqli_connect('localhost', 'client', 'clientlogin', 'YihuishouR')) {}
				else { echo 'FAIL TO CONNECT DATABASE'; }
				mysqli_query($con, 'set names utf8');  
				$sql = "select username from user where username = '$user'";
				$result = mysqli_query($con, $sql);
				$num = mysqli_num_rows($result); 
				if($num) {  
					echo '用户名已存在';  
				} else {
					$sql_insert = "insert into user (username, password) values('$user','$pwd')";  
					$res_insert = mysqli_query($con, $sql_insert);  
					//$num_insert = mysql_num_rows($res_insert);  
					if($res_insert) {  
						echo '注册成功！';  
					} else {  
						echo '系统繁忙，请稍候！';  
					}
				}
			} else { 
				echo '密码不一致！';  
			}  
		}  
	} else {  
		echo '提交未成功！';  
	}
?>  