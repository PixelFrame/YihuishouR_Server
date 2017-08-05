<?php
    if($con = mysqli_connect('127.0.0.1:3306', 'client', 'clientlogin', 'yihuishour')) {}
	else {echo 'FAIL TO CONNECT DATABASE';}
	mysqli_query($con, 'set names utf8');
?>