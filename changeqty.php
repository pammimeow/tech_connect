<?php
session_start();

$itemid = $_GET['itemid'];
$itemidqty = $_GET['itemidqty'];
$origqty = 0;

for($i = 0; $i<sizeof($_SESSION['items']); $i++)
{
	if($_SESSION['items'][$i][0] == $itemid)
	{		
        $origqty= $_SESSION['items'][$i][3];
		$_SESSION['items'][$i][3] = $itemidqty;
		if($origqty!=$itemidqty)
		      echo "Quantity changed"; 
	}
}

// making the change in the xml doc
$xml =new SimpleXMLElement("goods.xml", null, true);
$elem = $xml->xpath("/items/item[itemid='$itemid']");
$qty = (int)$elem[0]->qty;

if($qty == 0 || $qty < $itemidqty)
{
	echo "Sorry, We dont have that much quantity in the stock. Maximum is ".$qty;
	exit();
}

$qtyonhold = (int)$elem[0]->qtyonhold; 
$qtyonhold = $qtyonhold+$itemidqty-$origqty;
$qty = (int)$elem[0]->qty; 
$qty = ($qty-$itemidqty)+$origqty;
//echo "qty on hold".$qtyonhold;
$elem[0]->qtyonhold=(string)$qtyonhold;
$elem[0]->qty=(string)$qty;
$xml->asXML("goods.xml");

?>