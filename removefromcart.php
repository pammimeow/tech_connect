<?php
session_start();
$id = $_GET['id'];


// removing the first element
if($id == current(current($_SESSION['items'])))
{	
    removefromxmldoc($_SESSION['items'][0][3]);
	array_shift ($_SESSION['items']);
	headertomainpage();
}

while(next($_SESSION['items']))
{
	//echo "<br> id is ".$_SESSION['items'][key($_SESSION['items'])][0];
	
	if($_SESSION['items'][key($_SESSION['items'])][0] == $id)
	{
	   //echo "<br> match found at ".$_SESSION['items'][key($_SESSION['items'])][0];
	   //echo "<br> quantity was ".$_SESSION['items'][key($_SESSION['items'])][3];
	     removefromxmldoc($_SESSION['items'][key($_SESSION['items'])][3]);
	   	 unset($_SESSION['items'][key($_SESSION['items'])]);
		 headertomainpage();
		 exit();
	}
}
 
function headertomainpage()
{
	$message = "One item removed succuessfully"; 
	header("Location:showcart.php?message=$message");
}

function removefromxmldoc($qtyoncart)
{
	$id = $_GET['id'];
	$xml =new SimpleXMLElement("goods.xml", null, true);
	$elem = $xml->xpath("/items/item[itemid='$id']");
	$qtyonhold = (int)$elem[0]->qtyonhold;
	$qty = (int)$elem[0]->qty; 
	$qty = $qty+$qtyoncart; 
	$qtyonhold = $qtyonhold-$qtyoncart;
	$elem[0]->qtyonhold=(string)$qtyonhold;
	$elem[0]->qty=(string)$qty;
	echo $xml->asXML("goods.xml");
}
?>