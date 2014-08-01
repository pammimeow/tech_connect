<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<LINK href="style.css" rel="stylesheet" type="text/css">
</head>

<body>


<?php
include('header.html');

$echostr ='';
if(isset($_GET['id']))
{
	$itemid = $_GET['id'];
	$xml =new SimpleXMLElement("goods.xml", null, true);
	$elem = $xml->xpath("/items/item[itemid='$itemid']");
	
	$itemname = (string)$elem[0]->itemname;
	$itemprice = (int)$elem[0]->itemprice;
	$itemdesc = (string)$elem[0]->itemdesc;
	$imgsrc = (string)$elem[0]->imgsrc;
	$qty = (int)$elem[0]->qty;
		
	$echostr .= "<div class = 'headtag'><h1> $itemname </h1></div>
	             <div class = 'wholewrap'>
				 <div class='message'> <h2> Item Description </h2></div>
	             <div class = 'lmenu'>
                 <div class ='lbutt' id = 'managerlogin'><a href = 'addtocart.php?id=$itemid'> Add to cart </a> </div>
                  <div class ='lbutt' id = 'managerlogin'><a href = 'buying.php'> Back </a> </div>
                 </div>
				 
	             <div class = 'formatdesc'>
				 <img src = '$imgsrc' class ='itemimage'>
				 <div class = 'line'>
				 <table border='0' width='100%' style='margin-top:2rem; border:1px solid #C3E4EF;'>
				 <tr style='border:1px solid #C3E4EF'><td width = '50%' style='background-color:#C3E4EF;padding:0.5rem;'>Item Price </td><td style = 'font-weight:bold;'>$$itemprice</td></tr>
				 <tr style='border:1px solid #FAE08F'><td width = '50%' style='background-color:#FAE08F;padding:0.5rem;'>Quantity Available  </td><td style = 'font-weight:bold;'>$qty</td></tr>
				 </table>
				 
				 <div class = 'imgdesc'>$itemdesc </div>
				 </div>
				 </div>
	             ";
	echo $echostr;
}


?>
<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = ''> Catalogue </a></span> <span class = 'link'> <a href = ''>FAQ's </a></span> <span class = 'link'><a href = ''>  Contact </a></span>
</div></body>
</html>