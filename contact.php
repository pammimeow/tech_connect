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
?>


<div class = 'headtag'>
<h1> Shopping Catalogue </h1>
</div> 

<div class = 'wholewrap'>
<div class = 'message' id = 'message'><h2> Your FAQ'S </h2></div>
<div class = 'lmenu'>
<!-- <div class = 'logo'> <img src="Images/logotitle.jpg" class = 'logotitle'> <img src="Images/logofin.jpg" class = 'logoimg'> </div> -->

<div class ='lbutt' id = "managerlogin"><a href = "index.php"> Home </a> </div>
<div class ='lbutt' id = "managerlogin"><a href = "buying.php"> Catalogue </a> </div>
<div class ='lbutt' id = "managerlogin"><a href = "faqs.php"> FAQ'S </a> </div>
<div class ='lbutt' id = "managerlogin"><a href = "contact.php"> Contact </a> </div>
<?php
if(isset($_SESSION['items']))
{
	
$sizeofcart = sizeof($_SESSION['items']);
if($sizeofcart>0)
{
	 //echo "<div class = 'cart' id = 'cart'><h2><a href ='showcart.php'> Your Cart</a></h2></div>";
	 echo "<div class = 'cart' id = 'cart'>
	       <a href ='showcart.php'><img src='Images/cart.png'>
		   <div class = 'flyout'>  </div></a>
	       </div>";
}

}
?>

</div> 
<div class = 'clear'> </div>
</div> <!-- End of lmenu -->


<div class = "maincont"> </div>

<?php
if(isset($_SESSION['username']))
{
   echo '<div class ="rightbutt" id = "logout"><a href = "cancelpurchase.php?logout"> Logout</a> </div>';
}
else
{
   echo '<div class ="rightbutt" id = "login"><a href = "Login.php"> Login</a> </div>';
}
?>

</body>

</body>
</html>