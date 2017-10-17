<?php
function OtoXml($res){
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
	$root = $dom->createElement("order");
	$dom->appendChild($root);
	$i = 0;
	foreach($array_field as $fd) {
		$node[$i] = $dom->createElement($fd);
		$node[$i]->appendChild($dom->createTextNode($row[$fd]));
		$root->appendChild($node[$i]);
		++$i;
	}
	echo $dom->saveXML();
	$dom->save("D:/Server/Log/order.xml");
}
?>