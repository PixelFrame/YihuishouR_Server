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
		$row = mysqli_fetch_row($result);
	}

	function updateOrder($con, $oid, $alias, $attrib, $date, $status, $items) {
		$sql_create = "CREATE TABLE IF NOT EXISTS orders_".$id.
					"(oid INT NOT NULL,".
					"alias VARCHAR(128),".
					"attrib INT NOT NULL,".
					"date LONG NOT NULL,".
					"status INT NOT NULL),".
					"iid INT NOT NULL".
					"PRIMARY KEY(oid));";
		$res_create=mysqli_query($con, $sql_create);
		createItems($items);
		if($res_create == false) {
			echo "无法创建订单";
		} else {
			$sql_insert = "INSERT INTO orders_".$id.
						"(oid, alias, attrib, date, status, iid)".
						"VALUES".
						"('$oid', '$alias', '$attrib', '$date', '$status', '$iid')";
			$res_insert = mysqli_query($con, $sql_insert);
			if ($res_insert == false) {
				echo "无法创建订单";
			} else {
				
			} 
		}
	}

	function createItems($con, $items) {
		$sql_create = "CREATE TABLE IF NOT EXISTS items_".$id.
					"(name VARCHAR(128),".
					"price INT NOT NULL,".
					"catagory INT NOT NULL),".
					"num INT NOT NULL".
					"PRIMARY KEY(name));";
		$res_create=mysqli_query($con, $sql_create);
		foreach ($items as $item) {
			$sql = "INSERT INTO items_".$iid.
				"(name, price, catagory, num)".
				"VALUES".
				"('$item[0]', '$item[1]', '$item[2]', '$item[3]')";
			mysqli_query($con, $sql);
		}
		return $iid;
	}
?>