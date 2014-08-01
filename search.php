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
if(isset($_GET['keyword']))
{
  	
   if(isset($_GET['message']))
   {
    echo "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h2></div>";
   }
	
  if(strlen($_GET['keyword']) < 3)	
  {
	$message = "Keyword should be atleast 3 charecters long";
	header("Location:search.php?message=$message");
	exit();
  }

  $echostr .= "<div class = 'headtag'><h2>Search For : " .$_GET['keyword']."</h2></div>";


$keyword = strtolower($_GET['keyword']);
$inname = 0;
$indesc = 0;
$found = 0;

$echostr .= "<div class = 'allitems'>";

$xml =new SimpleXMLElement("goods.xml", null, true);
$allelems = $xml->xpath("/items/item");

for($i =0; $i<sizeof($allelems); $i++)
{
  $itemid = $allelems[$i]->itemid;
  $itemname = $allelems[$i]->itemname;
  $itemprice = $allelems[$i]->itemprice;
  $itemdesc = $allelems[$i]->itemdesc;
  $imgsrc = $allelems[$i]->imgsrc;
  $itemqty = $allelems[$i]->qty;
  
  if(strlen($itemdesc)>100)
	{
	   $itemdescshort = substr($itemdesc,0,100);
	}
	else
	{
		$itemdescshort = $itemdesc;
	}

   
  $inname = preg_match("/$keyword/",strtolower($itemname));
  $indesc = preg_match("/$keyword/",strtolower($itemdesc));
  
  
  if($inname == 1 || $indesc == 1)
  {
	$found = true;
	$echostr .= "<a href = 'itemdesc.php?id=$itemid' class = 'container'>
					  <div class ='itemcontainer'>
					  <div class='itemtitle'>
						<h3>$itemname</h3>
					  </div>
					  <div class = 'itemimage'>
						<img src = '$imgsrc'>
					  </div>
					  <div class = 'itemdesc'>
						 $itemdescshort
					  </div>
					  <div class = 'others'>
						  <table align = 'center'>
						  <tr><td class ='thead'><h4>Cost</h4></td>
						  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						  <td class ='thead'><h4>Qty</h4></td></tr>
						  <tr><td>$itemprice</td>
						  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						  <td>$itemqty</td></tr>
						  </table>
					  </div>
					  <div class = 'addtocart'>
						  <a href= 'addtocart.php?id=$itemid'> Add to cart </a>
					  </div>
				 </div>
				 </a>";
  }

}

if($found != true)
{
	$echostr .= "No Items matching your search";
	$echostr .= "<br class = 'clear'></div>";
	echo $echostr;
}
if($found == true)
{
	$echostr .= "<br class = 'clear'></div>";
echo $echostr;
}
}

?>
<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = ''> Catalogue </a></span> <span class = 'link'> <a href = ''>FAQ's </a></span> <span class = 'link'><a href = ''>  Contact </a></span>
</div></div>
</body>
</body>
</html>