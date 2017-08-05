<?php
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($con = mysqli_connect('127.0.0.1:3306', 'client', 'clientlogin', 'yihuishour')) {}
	else {echo 'FAIL TO CONNECT DATABASE';}
	mysqli_query($con, 'set names utf8');
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

function toXml($res){
	$dom = new DOMDocument("1.0", "utf-8");
	header("Content-Type: text/xml");
	$dom->formatOutput = true;
	
	$array_field = array();
	$index = 0;
	while ($finfo = mysqli_fetch_field($res)){
		$array_field[$index] = $finfo->name;
		++$index;
	}
	$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
	$root = $dom->createElement("user");
	$dom->appendChild($root);
	$i = 0;
	foreach($array_field as $fd) {
		$node[$i] = $dom->createElement($fd);
		$node[$i]->appendChild($dom->createTextNode($row[$fd]));
		$root->appendChild($node[$i]);
		++$i;
	}
	echo $dom->saveXML();
	$dom->save("D:/Server/Log/user.xml");
}

?>