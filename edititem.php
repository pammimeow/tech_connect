<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<LINK href="style.css" rel="stylesheet" type="text/css">

</head>

<body>

<?php
session_start();
include('header.html');
$echostr = '';
//displays messages whenever redirected to this page by this script. 
$message = "You have been successfully logged out ".$_SESSION['manager'];

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
	$xml =new SimpleXMLElement("goods.xml", null, true);
	$elem = $xml->xpath("/items/item[itemid='$id']");
	
   $itemid = $elem[0]->itemid;
   $itemname = $elem[0]->itemname;
   $itemprice = $elem[0]->itemprice;
   $itemdesc = $elem[0]->itemdesc;
   $imgsrc = $elem[0]->imgsrc;
   $itemqty = $elem[0]->qty;
	
   $echostr .= " <form action = 'saveediteditem.php' method = 'get'>
                 <div class = 'headtag'><h1> Itemname : <input type = 'text' value = '$itemname' name = 'itemname' style='padding:0.3rem;'> </h1></div>";
				 if(isset($_GET['message']))
{
  $echostr .= "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h2></div>";
}
else
{
	$echostr .= "<div class = 'message' id = 'message'>Edit Items</div>";
}
				 $echostr.="
				 <div class ='rightbutt' id = 'managerlogin'><a href = 'mlogin.php?message=$message'> Logout</a> </div>
				 <div class = 'edittable'>
					 <div class = 'edittablecol editcolhead'>
						Item Id :
					 </div>
					 <div class = 'edittablecol editcolhead'>
						Itemprice :
					 </div>
					 <div class = 'edittablecol editcolhead'>
						Quantity Available :
					 </div>
				 </div>
				 <div class = 'clear'></div>
				 <div class = 'edittable'>
					 <div class = 'edittablecol'>
						$itemid
					 </div>
					 <div class = 'edittablecol'>
						<input type = 'text' value = '$itemprice' name = 'itemprice'>
					 </div>
					 <div class = 'edittablecol'>
						<input type = 'text' value = '$itemqty' name ='itemqty'>
					 </div>
				 </div>
				 <div class = 'clear'></div>
				
	             <div class = 'formatdesc'>
	             <img src = '$imgsrc' class ='itemimage'>
	             <div class = 'description'>Description </div> <textarea rows ='20' cols = '70' name = 'itemdesc' style='padding:15px;'>'$itemdesc' </textarea></div>
				 <input type ='submit' name = 'submit' value = 'Save' class = 'addtocart' style = 'margin-left : 38rem;width : 10%;'> 
				 </form>
	             ";
	echo $echostr;
	

}
?>

<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = 'listing.php'> Listing </a></span> <span class = 'link'> <a href = 'processing.php'>Processing </a></span> <span class = 'link'><a href = 'edit.php'>  Edit / Delete </a></span>
</div>
</body>
</html>