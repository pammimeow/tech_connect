<?php
session_start();
// called when purchase is to be confirmed. 
// steps to do
// Make the quantity on hold to quantity on hold -quantity in the cart for all product. 
// make the quanty - quantity in the cart for all product. 
// make the quantity sold = quantitysold + quantity in the cart for all product. 
// header to buying.php with the message that the purchase is confirmed with total amount due to pay. 
// clear the session cart. 

//----------------------------------------------------------------------------------------------------------------


if(!(isset($_SESSION['username'])))
{
	$_SESSION['shopstatus'] = 'checkout';
	$message= "You need to login first to ccnfirm your purchase";
    header("Location:Login.php?message=$message");
	exit();

}

// opening the goods.xml file
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
		
	// get the qtysold from xml and substract value from qty in session array elem
	$qtysold = (int)$elem[0]->qtysold; 
	$qtysold = $qtysold + $qty;
	
	// writing all values to the file. 
	$elem[0]->qtyonhold=(string)$qtyonhold;
	$elem[0]->qtysold=(string)$qtysold;
	
	echo $xml->asXML("goods.xml");
	
}// end of loop through session vars
  
// unset the session

unset($_SESSION['items']);
$message= "Your purchase is confirmed. Thanks for shopping with us.";
header("Location:buying.php?message=$message");
?>