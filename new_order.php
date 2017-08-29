<?php
	require "db_config.php";
	require "XML_parser.php";
	$xmlStr = $_POST["xmlStr"];
	$id = $_POST["id"];

	$sql_select = "select * from user where id ='$id'";
	$result = mysqli_query($con, $sql_select);
	if ($result == false) {
		echo "FATAL ERROR: No such user";
		exit();
	} else {
		$order = getArray($xmlStr);
		$uid = mysqli_fetch_assoc($result)['uid'];
	}

	function createOrder($con, $uid, $alias, $attrib, $date, $status, $items) {
		$sql_insert = "INSERT INTO order".
					"(oid, uid, alias, attrib, date, status)".
					"VALUES".
					"($alias', '$uid', '$attrib', '$date', '$status')";
		$res_insert = mysqli_query($con, $sql_insert);
		if ($res_insert == false) {
			echo "无法创建订单";
		} else if(createItems($con, mysqli_fetch_assoc($res_insert)['oid'], $items)) {
			echo "创建成功";
		} else echo "创建失败";
	}

	function createItems($con, $items) {
		foreach ($items as $item) {
			$sql = "INSERT INTO items".
				"(oid, name, price, catagory, num)".
				"VALUES".
				"('$oid', '$item[0]', '$item[1]', '$item[2]', '$item[3]')";
			if(mysqli_query($con, $sql) == false) return false;
		}
		return true;
	}
?>