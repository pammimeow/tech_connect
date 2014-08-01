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
  $("table#editable tr:even").css("background-color", "#F0F9FC");
  $("table#editable tr:odd").css("background-color", "#FDF3D5");
});
</script>
</head>

<body>
<?php  
include('header.html');
?>
<div class = 'headtag'><h1> Edit Items </h1></div>
<div class = 'lmenu'>
<div class ='lbutt' id = "managerlogin"><a href = "processing.php"> Processing </a> </div>
<div class ='lbutt' id = "managerlogin"><a href = "listing.php"> Listing </a> </div>
</div>
<?php
session_start();
//displays messages whenever redirected to this page by this script. 
$message = "You have been successfully logged out ".$_SESSION['manager'];
echo "<div class ='rightbutt' id = 'managerlogin'><a href = 'mlogin.php?message=$message'> Logout</a> </div>";

if(isset($_GET['message']))
{
  echo "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h></div>";
}
?>

<div class ='cartdiv'>
<?php
$echostr = '';
$xmlfile = "goods.xml";
$dom = DOMDocument::load($xmlfile);
$items = $dom->getElementsByTagName("item"); 

$echostr .= "<table border = '0' class = 'carttable' id = 'editable' style='text-align : center;background-color : #C3E4EF'>
            <tr class ='theadrow'>
			<td class = 'thead' width = '30%'> Name </td>
			<td class = 'thead' width = '30%'> Item Image </td>
			<td class = 'thead' width = '20%'> Edit </td>
			<td class = 'thead' width = '20%'> Delete </td>
			</tr>";

$i=0;
$tot = sizeof($items);


foreach($items as $item)
{
	$itemid = $item->getElementsByTagName("itemid");
	$itemid = $itemid->item(0)->nodeValue;
	
	$itemname = $item->getElementsByTagName("itemname");
	$itemname = $itemname->item(0)->nodeValue;

	try
	{
	$imgsrc = $item->getElementsByTagName("imgsrc");
	$imgsrc = $imgsrc->item(0)->nodeValue;
	}
	catch(Exception $e)
	{
		echo "found exception";
	}	
	$echostr .= "<tr class ='titemrow'>
			<td class ='titem'> $itemname </td>
			<td class = 'editimg' style = 'padding : 0.3rem;'> <img src = '$imgsrc'> </td>
			<td class ='titem'  align='center'> <a href= 'edititem.php?id=$itemid' class = 'submitbutt'> Edit </a> </td>
			<td class ='titem'  align='center'> <a href= 'deleteitem.php?id=$itemid' class = 'submitbutt'> Delete </a> </td>
			</tr>";

	$i= $i+1;
} 

$echostr .= "</table>";
echo $echostr;



?>
</div>
<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = 'listing.php'> Listing </a></span> <span class = 'link'> <a href = 'processing.php'>Processing </a></span> <span class = 'link'><a href = 'edit.php'>  Edit / Delete </a></span>
</div>
</body>
</html>