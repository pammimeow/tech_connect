<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_GET['submit']))
{
   $itemid = $_GET['itemid'];
   $itemname = $_GET['itemname'];
   $itemprice = $_GET['itemprice'];
   $itemdesc = $_GET['itemdesc'];
   $itemqty = $_GET['itemqty'];
   
   $xml =new SimpleXMLElement("goods.xml", null, true);
   $elem = $xml->xpath("/items/item[itemid='$itemid']");
	
   $elem[0]->itemid=(string)$itemid;
   $elem[0]->itemname=(string)$itemname;
   $elem[0]->itemprice=(string)$itemprice;
   $elem[0]->itemdesc=(string)$itemdesc;
   $elem[0]->qty=(string)$itemqty;
   
   $result = $xml->asXML("goods.xml");
   if($result)
   {
   $message= "Item is successfully edited.";
   header("Location:edit.php?message=$message");
   }
	
}
?>
</body>
</html>