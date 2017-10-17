<?php
	require_once("db_config.php");
	require("ORDER_to_XML.php");
	$uid = $_POST["uid"];
	$sql_select = "select * from orders where uid ='$uid'";
	$result = mysqli_query($con, $sql_select);
	if ($result == false) {
		echo "NULL";
		exit;
	} else {
		OtoXML($result);
	}
	exit();
?>