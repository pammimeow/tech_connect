<?php
session_start();
// called when purchase is to be cancelled. 
// steps to do
// Make the quantity on hold to quantity on hold -quantity in the cart for all product. 
// make the quanty + quantity in the cart for all product. 
// header to buying.php with the message that the purchase is confirmed with total amount due to pay. 
// clear the session cart. 

//----------------------------------------------------------------------------------------------------------------

$xml =new SimpleXMLElement("goods.xml", null, true);
	
foreach($_SESSION['items'] as $item)
{
	// get the itemid for that session array element.
	$itemid = $item[0];
	// get the item qty for that session array element.
	$qty = $item[3];
	
	// finding the xpath value for the itemid	
    $elem = $xml->xpath("/items/item[itemid='$itemid']");
	
	// get the qtyonhold from xml and substract value from qty in session array elem
	$qtyonhold = (int)$elem[0]->qtyonhold; 
	$qtyonhold = $qtyonhold-$qty;
	
	// get the qty from xml and substract value from qty in session array elem
	$qtyinxml = (int)$elem[0]->qty; 
	$qtyinxml = $qtyinxml + $qty;
	
	// writing all values to the file. 
	$elem[0]->qtyonhold=(string)$qtyonhold;
	$elem[0]->qty=(string)$qtyinxml;
		
	echo $xml->asXML("goods.xml");
	
}// end of loop through session vars
  
// unset the session 
unset($_SESSION['items']);

if(isset($_GET['logout']))
{
	$message= "You have been successfully logged out, you are welcome to shop with us again.";
	unset($_SESSION['username']);
	header("Location:Login.php?message=$message");
}
else
{
$message= "Your purchase is cancelled, you are welcome to shop with us again.";
header("Location:buying.php?message=$message");
}


?>