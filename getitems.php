<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

</head>

<body>
<?php
session_start();

$xml =new SimpleXMLElement("goods.xml", null, true);
$allelems = $xml->xpath("/items/item");
$echostr = '';
$links = "<div class = 'pages'>";

$pages;
$index = 1;
$page = 0;
$id = 0;
$iterate = ceil(sizeof($allelems)/4);

while($iterate > 0)
{
	$links .= "<a href = 'buying.php?startswith=$page' class = 'pagelink'> $index </a>";  
	$page = $page +4;
	$iterate=$iterate-1;
	$index = $index+1;
}

$links .= "</div>";

$echostr .= $links;

$echostr .= "<div class = 'allitems'>";

$looptill = 0;

if(sizeof($allelems) < $_SESSION['startswith']+4)
{
	$looptill = sizeof($allelems);
}
else
{
	$looptill = $_SESSION['startswith']+4;
}

for($i =$_SESSION['startswith']; $i<$looptill; $i++)
{
  $id = $id +1;
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

   $echostr .= "<a href = 'itemdesc.php?id=$itemid' class = 'container' id = '$id'>
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

$echostr .= "<br class ='clear'></div>";
$echostr .="</div>";

$echostr .= $links;
echo $echostr;
?>
</body>
</html>