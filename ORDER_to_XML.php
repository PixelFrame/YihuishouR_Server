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
	$row = array();
	$index = 0;
	while($cur_row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
		$row[$index] = $cur_row;
		++$index;
	}
	$root = $dom->createElement("orders");
	$dom->appendChild($root);
	foreach ($row as $cur_row) {
		$node_order = $dom->createElement("order");
		$root->appendChild($node_order);
		$i = 0;
		foreach($array_field as $fd) {
			$node[$i] = $dom->createElement($fd);
			$node[$i]->appendChild($dom->createTextNode($cur_row[$fd]));
			$node_order->appendChild($node[$i]);
			++$i;
		}
	}
	echo $dom->saveXML();
	$dom->save("D:/Server/Log/order.xml");
}
?>