<?php
	$xmlStr = $_POST["xmlStr"];
	$uid = $_POST["uid"];
	require_once("db_config.php");
	//require("XML_parser.php"); //已废弃的DOMDocument解析方案

	$sql_select = "select * from user where uid ='$uid'";
	$result = mysqli_query($con, $sql_select);
	if ($result == false) {
		echo "FATAL ERROR: No such user";
		exit();
	} else {
		/*
		$dom = new DOMDocument();
		$dom->loadXML($xmlStr);
		$order = getArray($dom->documentElement);
		*/
		$orders = simplexml_load_string($xmlStr);
		$order = $orders->order;
		$alias = (string) $order->alias;
		$attrib = (string) $order->attrib;
		$date = (string) $order->date;
		$status = (string) $order->status;
		$items = $order->item;
		createOrder($con, $uid, $alias, $attrib, $date, $status, $items);
		exit();
	}

	function createOrder($con, $uid, $alias, $attrib, $date, $status, $items) {
		$sql_insert = "INSERT INTO orders".
					"(uid, alias, attrib, date, status)".
					" VALUES ".
					"('$uid', '$alias', '$attrib', '$date', '$status')";
		$res_insert = mysqli_query($con, $sql_insert);
		$sql_find_oid = "SELECT oid FROM ORDERS WHERE uid = '$uid' AND date = '$date'";
		$res_find_oid = mysqli_query($con, $sql_find_oid);
		$oid = mysqli_fetch_all($res_find_oid)[0][0];
		if ($res_find_oid == false) {
			echo "无法创建订单";
		} else if(createItems($con, $oid, $items)) {
			echo "创建成功";
		} else echo "创建失败";
	}

	function createItems($con, $oid, $items) {
		foreach ($items as $item) {
			$name = (string) $item->name;
			$price = (string) $item->price;
			$catagory = (string) $item->catagory;
			$num = (string) $item->num;
			$sql = "INSERT INTO items".
				"(oid, name, price, catagory, num)".
				"VALUES".
				"('$oid', '$name', '$price', '$catagory', '$num')";
			if(mysqli_query($con, $sql) == false) return false;
		}
		return true;
	}
?>