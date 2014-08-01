<?php
session_start();
?>

<?php
$itemid = $_GET['id'];
$xml =new SimpleXMLElement("goods.xml", null, true);
$elem = $xml->xpath("/items/item[itemid='$itemid']");
$itemname = (string)$elem[0]->itemname;
$itemprice = (int)$elem[0]->itemprice;
$qty = (int)$elem[0]->qty;

if($qty == 0)
{
	$message = "This item is not present in the stock, Sorry!!!!";
	header("Location:buying.php?message=$message");
	exit();
}

$qtyonhold = (int)$elem[0]->qtyonhold; 
$qtyonhold = $qtyonhold+1;
$qty = (int)$elem[0]->qty; 
$qty = $qty-1;
echo "qty on hold".$qtyonhold;
$elem[0]->qtyonhold=(string)$qtyonhold;
$elem[0]->qty=(string)$qty;
echo $xml->asXML("goods.xml");

if(isset($_SESSION['cart']))
{
  
  // add more elements to the cart
  $foundincart = 0;
  for($i =0; $i<sizeof($_SESSION['items']); $i++)
  {
	  if($_SESSION['items'][$i][0] == $itemid)
	  {
		  $_SESSION['items'][$i][3] = (int)($_SESSION['items'][$i][3]) + 1;
		  $foundincart = 1;
	  }
  }
  
  if($foundincart === 0)
  {
	  $numofelems = sizeof($_SESSION['items']);
	  $_SESSION['items'][$numofelems] = array($itemid, $itemname,$itemprice, 1);
  }
 
 $message = "Item successfully added to cart";
 header("Location:buying.php?message=$message");
 exit();
}

//set the cart
$_SESSION['cart'] = 'set';
$_SESSION['items'] = array();
$_SESSION['items'][0] = array($itemid, $itemname,$itemprice, 1);

/*echo "id ".$_SESSION['items'][0][0];
echo "name ".$_SESSION['items'][0][1];
echo $_SESSION['items'][0][2];
echo $_SESSION['items'][0][3];*/

$message = "Item successfully added to cart";
header("Location:buying.php?message=$message");

?>
