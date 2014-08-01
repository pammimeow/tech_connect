<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<LINK href="style.css" rel="stylesheet" type="text/css">

<script>
window.onload = function()
{
  var reset =document.getElementById("reset");
  
  reset.onclick = function()
  {
	  var allinputs = document.body.getElementsByClassName("resetfield");
	  
	  for(var i =0; i<allinputs.length; i++)
	  {
		  allinputs[i].value = "";
	  }
  }
  
}

function CopyMe(oFileInput, sTargetID) {
    document.getElementById(sTargetID).value = oFileInput.val();
}
</script>

</head>

<body>
<?php
session_start();
if(!isset($_SESSION['manager']))
{
	$message = "Please login to access admin controls";
	header("Location:mlogin.php?message=$message");
	exit();
}
if(isset($_POST['additem']))
{
	$name = $_POST['itemname'];
	$price = $_POST['itemprice'];
	$qty = $_POST['itemqty'];
	$desc = $_POST['itemdesc']; 
	$imgsrcval = "productImages/".$_POST['imgsrc'];
	
	if($name == '' || $price == '' || $qty == '' || $desc == '')
	{  
	$message = 'Please enter values in all the fields. ';
	header("Location:listing.php?message=$message");
	exit();
	}
	
	$exists = file_exists('goods.xml');
	if($exists)
	{
		  $xml =new SimpleXMLElement("goods.xml", null, true);
		  $last = $xml->xpath("/items/item[last()]");
		  $id = $last[0]->itemid;
		  $id= $id +1;
		
		  $doc = new DomDocument( '1.0' );
		  $doc->preserveWhiteSpace = false;
		  $doc->formatOutput = true;
		
		if( $xml = file_get_contents( 'goods.xml') ) {
			$doc->loadXML( $xml, LIBXML_NOBLANKS );
		
			$items = $doc->getElementsByTagName('items')->item(0);
		
			$item = $doc->createElement('item');
			$item = $items->appendChild($item);
			
			$itemid = $doc->createElement('itemid'); 
			$itemid = $item->appendChild($itemid);   
			$value = $doc->createTextNode("".$id."");
			$value = $itemid->appendChild($value);
			
			$itemname = $doc->createElement('itemname'); 
			$itemname = $item->appendChild($itemname);   
			$value = $doc->createTextNode($name);
			$value = $itemname->appendChild($value);
			
			$itemprice = $doc->createElement('itemprice'); 
			$itemprice = $item->appendChild($itemprice);   
			$value = $doc->createTextNode($price);
			$value = $itemprice->appendChild($value);
			
			$itemdesc = $doc->createElement('itemdesc'); 
			$itemdesc = $item->appendChild($itemdesc);   
			$value = $doc->createTextNode($desc);
			$value = $itemdesc->appendChild($value);
			
			$itemqty = $doc->createElement('qty'); 
			$itemqty = $item->appendChild($itemqty);   
			$value = $doc->createTextNode($qty);
			$value = $itemqty->appendChild($value);
			
			$imgsrc = $doc->createElement('imgsrc'); 
			$imgsrc = $item->appendChild($imgsrc);   
			$value = $doc->createTextNode($imgsrcval);
			$value = $imgsrc->appendChild($value);
			
			$qtysold = $doc->createElement('qtysold'); 
			$qtysold = $item->appendChild($qtysold);   
			$value = $doc->createTextNode("0");
			$value = $qtysold->appendChild($value);
			
			$qtyonhold = $doc->createElement('qtyonhold'); 
			$qtyonhold = $item->appendChild($qtyonhold);   
			$value = $doc->createTextNode("0");
			$value = $qtyonhold->appendChild($value);
			
		    $doc->save('goods.xml');
			
		}
        
	}
	else 
	{
		$doc = new DomDocument('1.0');
        $items = $doc->createElement('items');
        $items = $doc->appendChild($items);

		$item = $doc->createElement('item');
		$item = $items->appendChild($item);
		
		$itemid = $doc->createElement('itemid'); 
		$itemid = $item->appendChild($itemid);   
		$value = $doc->createTextNode("1");
		$value = $itemid->appendChild($value);
		
		$itemname = $doc->createElement('itemname'); 
		$itemname = $item->appendChild($itemname);   
		$value = $doc->createTextNode($name);
		$value = $itemname->appendChild($value);
		
		$itemprice = $doc->createElement('itemprice'); 
		$itemprice = $item->appendChild($itemprice);   
		$value = $doc->createTextNode($price);
		$value = $itemprice->appendChild($value);
		
		$itemdesc = $doc->createElement('itemdesc'); 
		$itemdesc = $item->appendChild($itemdesc);   
		$value = $doc->createTextNode($desc);
		$value = $itemdesc->appendChild($value);
		
		$itemqty = $doc->createElement('qty'); 
			$itemqty = $item->appendChild($itemqty);   
			$value = $doc->createTextNode($qty);
			$value = $itemqty->appendChild($value);
		
		$qtysold = $doc->createElement('qtysold'); 
		$qtysold = $item->appendChild($qtysold);   
		$value = $doc->createTextNode("0");
		$value = $qtysold->appendChild($value);
		
		$qtyonhold = $doc->createElement('qtyonhold'); 
		$qtyonhold = $item->appendChild($qtyonhold);   
		$value = $doc->createTextNode("0");
		$value = $qtyonhold->appendChild($value);
				
		$doc->save('goods.xml');
      }
	 $message = 'New item has been added successfully';
	 header("Location:listing.php?message=$message");
	 exit();
}

?>
<?php  
include('header.html');
?>
<div class = 'headtag'> <h1>Add New Items </h1></div>
<div class = 'lmenu'>
<div class ='lbutt' id = "managerlogin"><a href = "processing.php"> Processing </a> </div>
<div class ='lbutt' id = "managerlogin"><a href = "edit.php"> Edit / Delete</a> </div>
</div>
<?php
//displays messages whenever redirected to this page by this script. 
$message = "You have been successfully logged out ".$_SESSION['manager'];
echo "<div class ='rightbutt' id = 'managerlogin'><a href = 'mlogin.php?message=$message'> Logout</a> </div>";

if(isset($_GET['message']))
{
  echo "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h></div>";
}
?>

     
<div class ='registertable'>
<form method = "post" action = "">
<table class = 'registertable'>
<tr>
<td>Item Name :<br>&nbsp;</td>
<td> <input type ="text" name = "itemname" id = "itemname"> <br>&nbsp;</td>
</tr>
<tr>
<td>Item Price :<br>&nbsp;</td>
<td> <input type ="text" name = "itemprice" id = "itemprice"> <br>&nbsp;</td>
</tr>
<br>
<tr>
<td>Item Quantity :<br>&nbsp;</td>
<td> <input type ="text" name = "itemqty" id = "itemqty"> <br>&nbsp;</td>
</tr>
<br>
<tr>
<td>Item Image :<br>&nbsp;</td>
<td><input type ="file" name = "imgsrc" id = "imgsrc" class = "resetfield" onchange="CopyMe(this, 'imgsrcname');" > <br>&nbsp;</td>
</tr>
<br>
<tr>
<td>Item Description :<br>&nbsp;</td>
<td> <textarea name = "itemdesc" id = "itemdesc" rows = "4" cols = "17"></textarea> <br>&nbsp;</td>
</tr>
</table>
</div>

<div style='width:50%; margin:0 auto;'>
<input type ="submit" name = "additem" id = "additem" value = "Add Item" class = 'addtocart' style = 'width : 30%;margin-left:14%;'>
<input type ="submit" name = "reset" id = "reset" value = "Reset" class = 'addtocart' style = 'width : 30%;margin-left:14%;'>
</div>


<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = 'listing.php'> Listing </a></span> <span class = 'link'> <a href = 'processing.php'>Processing </a></span> <span class = 'link'><a href = 'edit.php'>  Edit / Delete </a></span>
</div>
</body>
</html>