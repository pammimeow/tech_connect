<?php

//load the file
 $xml = new SimpleXMLElement('goods.xml',null,true);
 $items = $xml->xpath('/items/item');

 //clear the quantity sold for all those items with sold quantities
 for($i =0; $i<sizeof($items); $i++)
 {
	 if($items[$i]->qtysold > 0)
	 {
		$items[$i]->qtysold = 0;
		
	 }
	 
 }
 $xml->asXML("goods.xml"); 
 

//removing those items that have been completely sold. ie, qtyonhold and qty is 0

$xml = new SimpleXMLElement('goods.xml',null,true);
$items = $xml->xpath("/items/item[qty='0' and qtyonhold='0']");
foreach ($items as $item) unset($item[0]);
$xml->asXML("goods.xml");  

$message = 'All the items have been successfully processed.';
header("Location:processing.php?message=$message");

?>