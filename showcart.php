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
  $("table#carttable tr:even").css("background-color", "#F0F9FC");
  $("table#carttable tr:odd").css("background-color", "#FDF3D5");
});
function changeqty(itemid)
{
	itemidqty = document.getElementById(itemid).value;
	if(!parseInt(itemidqty))
	{
		alert("You cannot enter a non-integer value.");
	}
	else
	{
    ///alert("itemid "+ itemid + "qty "+itemidqty);
	var xhr = new XMLHttpRequest();
	xhr.open("get", "changeqty.php?itemid="+itemid+"&itemidqty="+itemidqty, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//var vars = "itemid="+itemid;
    xhr.onreadystatechange = function()
	{
		if(xhr.readyState === 4)
		{
		    if(xhr.responseText!= '')
			{
				alert(xhr.responseText);
			}
			window.location="showcart.php";
		}
	}
	xhr.send();
	
	}
}


</script>
</head>

<body>
<?php  
include('header.html');
?>


<div class = 'headtag'><h1> Your Cart </h1></div>
<div class = 'shop' id = 'cart'><h2><a href ='buying.php'> Back </a></h2></div>
<?php 
if(isset($_GET['message']))
{
  showmessage($_GET['message']);
}

function showmessage($message)
{
     echo "<div class = 'message' id = 'message'><h2>" .$message."</h2></div>";
}
?>
<div class ='cartdiv'>

<?php
 session_start();
 $echostr = "";
 $echostr .=  "<table class = 'carttable' id = 'carttable' style = 'background-color : #C3E4EF'>
			   <tr class ='theadrow'>
			   <td class ='thead'> Item Name </td>
			   <td class ='thead'> Price </td>
			   <td class ='thead'> Qty </td>
			   <td class ='thead'> Total </td>
			   <td class ='thead'> Remove Items </td>
	           </tr>";
			   
 
$pp_checkout_btn = '';
$pp_checkout_btn .= '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="pammimeow-facilitator@gmail.com">';

if(isset($_SESSION['items']))
{
if(sizeof($_SESSION['items']) == 0)
{
   echo "<h2>There are no elements in the cart right now</h2>"; 
   exit();
}

$totalcost = 0;
$x =1;
foreach($_SESSION['items'] as $item)
{
	   $totalcost = $totalcost + $item[2]*$item[3];
	   $itemid = $item[0];
	   $echostr .=  "<tr class ='titemrow'>
	   <td class ='titem'> ".$item[1]."</td>
	   <td class ='titem'> ".$item[2]." </td>
	   <td class ='titem'> <input type='text' onblur = 'changeqty($item[0])' onclick='storeqty($item[0])'  value =$item[3] id = $item[0]>"." </td>
	   <td class ='titem'> ".$item[2]*$item[3] ."</td>
	   <td class ='titem'> <a href = 'removefromcart.php?id=$itemid' class = 'remove'> Remove </a></td>
	   </tr>";
	   $pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $item[1] . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $item[2] . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $item[3] . '">  ';
		
		$x = $x+1;
}// end pf loop through session vars
  
//showing the total 
 

$echostr .= "</table>";

$totalcost = "$".$totalcost;
$echostr .=  "<table class ='totcost'> 
             <tr>
            <td class ='totcosttd'>  Total Cost</td>
	        <td class ='totcosttdval'> $totalcost </td>  
	   ";

$pp_checkout_btn .= '<input type="hidden" name="custom" value="">
	<input type="hidden" name="notify_url" value="https://www.yoursite.com/storescripts/my_ipn.php">
	<input type="hidden" name="return" value="http://localhost/Assignment/Portfolio/e-commerce/confirmpurchase.php">
	<input type="hidden" name="rm" value="0">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="http://localhost/Assignment/Portfolio/e-commerce/buying.php">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">
	</form>';
// showing the buttons
if(isset($_SESSION['username']))
{
$echostr .=  "
            <td><div class = 'paypal'>". $pp_checkout_btn ."</div></td>"; }
else
{
	$echostr .=  "
	        <td>  <a href = 'Login.php' class = 'purhcasebutt'> Login To Purchase </a></td>";
}
$echostr .=  "
	        <td>  <a href = 'cancelpurchase.php' class = 'purhcasebutt'> Cancel Purchase </a></td>
	    </tr>
	   </table>
	   ";	  
echo $echostr;
 }// end of if, session is set


?>
</div>
<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = ''> Catalogue </a></span> <span class = 'link'> <a href = ''>FAQ's </a></span> <span class = 'link'><a href = ''>  Contact </a></span>
</div></div>
</body>
</html>