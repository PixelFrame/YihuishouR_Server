<?php
    require_once ("db_config.php");
	$db_table = "user";
	$query = "select * from ".$db_table;
	$result = mysqli_query($con, $query);

	$array_result = array();
	$index = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$array_result[$index] = $row;
		++$index;
	}

	$array_field = array();
	$index = 0;
	while ($finfo = mysqli_fetch_field($result)){
		$array_field[$index] = $finfo->name;
		++$index;
	}

	$dom = new DOMDocument("1.0", "utf-8");
	header("Content-Type: text/xml");
	$dom->formatOutput = true;
	
	$root = $dom->createElement("yihuishour");
	$dom->appendChild($root);
	foreach($array_result as $res) {
		$record = $dom->createElement($db_table);
		$root->appendChild($record);
		$i = 0;
		foreach($array_field as $fd) {
			$node[$i] = $dom->createElement($fd);
			$node[$i]->appendChild($dom->createTextNode($res[$fd]));
			$record->appendChild($node[$i]);
			++$i;
		}
	}
	echo $dom->saveXML();
	$dom->save("user.xml");
	mysqli_close($con);
?>