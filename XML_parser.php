//XML Parser using DOMDocument
//Created by Pixel Frame

<?php
    require("db_config.php");

	$dom = new DOMDocument();
	$dom->loadXML($xmlStr);
	print_r(getArray($dom->documentElement));

function getArray($node) {
	$array = false;
	if ($node->hasAttributes()) {
		foreach ($node->attributes as $attr) {
			$array[$attr->nodeName] = $attr->nodeValue;
		}
	}
	if ($node->hasChildNodes()) {
    	if ($node->childNodes->length == 1) {
      		$array[$node->firstChild->nodeName] = getArray($node->firstChild);
   		} else {
    		foreach ($node->childNodes as $childNode) {
    			if ($childNode->nodeType != XML_TEXT_NODE) {
    				$array[$childNode->nodeName][] = getArray($childNode);
				}
			}
		}
  	} else {
    	return $node->nodeValue;
	}
	return $array;
}

?>