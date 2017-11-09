<?php
	require_once("db_config.php");
	require("ORDER_to_XML.php");
	$oid = $_POST["oid"];
	$sql_select = "select * from orders where oid = '$oid'";
	$result = mysqli_query($con, $sql_select);
	if ($result == false) {
		echo "NULL";
		exit;
	} else if (mysqli_num_rows($result) == 0) {
		echo "NULL";
		exit;
	} else {
		OtoXML($result);
	}
	exit();
?>