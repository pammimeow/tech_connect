<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<LINK href="style.css" rel="stylesheet" type="text/css">
<script src="jquery-2.0.3.min.js"></script>
<script>
$(document).ready(function()
{
  $("table#processtable tr:even").css("background-color", "#F0F9FC");
  $("table#processtable tr:odd").css("background-color", "#FDF3D5");
});
</script>
</head>

<body>
<?php  
include('header.html');
?>
<div class = 'headtag'><h1> Processing Form </h1></div>
<div class = 'lmenu'>
<div class ='lbutt' id = "managerlogin"><a href = "listing.php"> Listing </a> </div>
<div class ='lbutt' id = "managerlogin"><a href = "edit.php"> Edit / Delete </a> </div>
</div>

<?php
session_start();
if(!isset($_SESSION['manager']))
{
	$message = "Please login to access admin controls";
	header("Location:mlogin.php?message=$message");
	exit();
}
$message = "You have been successfully logged out ".$_SESSION['manager'].".";
echo "<div class ='rightbutt' id = 'managerlogin'><a href = 'mlogin.php?message=$message'> Logout</a> </div>";
//displays messages whenever redirected to this page by this script. 
if(isset($_GET['message']))
{
  displayMsg($_GET['message']);
}
function displayMsg($message)
{
	echo "<div class = 'message' id = 'message'><h2>" .$message."</h></div>";
}

?>
<div class ='registertable'>
<?php
$xmlfile = "goods.xml";
$dom = DOMDocument::load($xmlfile);
$items = $dom->getElementsByTagName("item"); 

$found = false;

$echostr = "<table width = '100%' class = 'carttable' align='center' id = 'processtable'>
            <tr>
			<td class = 'thead'> Item Number </td>
			<td class = 'thead'> Name </td>
			<td class = 'thead'> Price </td>
			<td class = 'thead'> Quantity Available</td>
			<td class = 'thead'> Quantity On Hold </td>
			<td class = 'thead'> Quantity Sold </td>
			</tr>";

foreach($items as $item)
{
	$itemid = $item->getElementsByTagName("itemid");
	$itemid = $itemid->item(0)->nodeValue;
	
	$itemname = $item->getElementsByTagName("itemname");
	$itemname = $itemname->item(0)->nodeValue;
	
	$itemprice = $item->getElementsByTagName("itemprice");
	$itemprice = $itemprice->item(0)->nodeValue;
	
	$qty = $item->getElementsByTagName("qty");
	$qty = $qty->item(0)->nodeValue;
	
	$qtyonhold = $item->getElementsByTagName("qtyonhold");
	$qtyonhold = $qtyonhold->item(0)->nodeValue;
	
	$qtysold = $item->getElementsByTagName("qtysold");
	$qtysold = $qtysold->item(0)->nodeValue;
	
	if($qtysold > 0 or $qtyonhold >0)
	{
	$echostr .= "<tr>
			<td class = 'titem'> $itemid </td>
			<td class = 'titem'> $itemname </td>
			<td class = 'titem'> $itemprice </td>
			<td class = 'titem'> $qty </td>
			<td class = 'titem'> $qtyonhold </td>
			<td class = 'titem'> $qtysold </td>
			</tr>";
			$found = true;
	}
} 

$echostr .= "</table></div>";
$echostr .= "<div class = 'button'><a href = 'process.php' class = 'purhcasebutt' style='width:100px;'> Process </a></div>";

	if($found == false)
	{
		$message = 'There are no more items remaining to be processed.';
        displayMsg($message);
		exit();
	}

echo $echostr;
?>

<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = 'listing.php'> Listing </a></span> <span class = 'link'> <a href = 'processing.php'>Processing </a></span> <span class = 'link'><a href = 'edit.php'>  Edit / Delete </a></span>
</div>
</body>
</html>