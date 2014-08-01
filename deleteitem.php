<?php
if(isset($_GET['id']))
{
   $itemid = $_GET['id'];
   
   $xml =new SimpleXMLElement("goods.xml", null, true);
   
   foreach($xml->xpath("/items/item[itemid='$itemid']") as $key)
   {
      unset($key[0]); 
   }
 
    foreach($xml->xpath("/items/item[itemid >'$itemid']") as $key)
   {
	  $key[0]->itemid = $key[0]->itemid -1;
   }
    $result = $xml->asXML("goods.xml");
	
   if($result)
   {
   $message= "Item successfully deleted.";
   header("Location:edit.php?message=$message");
   }
   
   
}
?>

