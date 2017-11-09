<?php
	require_once("db_config.php");
	require("ORDER_to_XML.php");
	$uid = $_POST["uid"];
	if ($uid != "-100000") {
		$sql_select = "select * from orders where uid = '$uid'";
	} else {
		$sql_select = "select * from orders where status != 2";
	}
	$result = mysqli_query($con, $sql_select);
	if ($result == false) {
		echo "NULL";
		exit;
	} else {
		OtoXML($result);
	}
	exit();
?>