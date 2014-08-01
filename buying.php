<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<LINK href="style.css" rel="stylesheet" type="text/css">
<script>
window.onload = function()
{
	getallitems();
	//setContainer();
	setInterval(getallitems, 100000);
	var searchnow = document.getElementById("search");
	searchnow.onclick = openurl;
	
}
function openurl()
{
	{
		var keyword = document.getElementById("keyword").value;
		
		var win=window.open('search.php?keyword='+keyword, '_blank');
        win.focus();
	}
}

function getallitems()
{
	var xhr = new XMLHttpRequest();
	xhr.open("post", "getitems.php", true);
	
    xhr.onreadystatechange = function()
	{
		if(xhr.readyState === 4)
		{
			document.getElementById("Catalogue").innerHTML = xhr.responseText;
			setTimeout(changestatus, 100000);
		}
	}
	xhr.send();
}
function changestatus()
{
	document.getElementById("message").innerHTML = "<h2>Add items to your cart</h2>";
}
function setContainer()
{
	var containers = document.getElementsByClassName("container");
	var newdiv = document.createElement("div");
	newdiv.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
	
	console.log(containers.length);
	for(var i =0; i < containers.length; i++)
	{
		 containers[i].onmouseover = function()
		 { 
		   newdiv.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
		   newdiv.style.height = container[i].offsetHeight + "px";
		   newdiv.style.width = container[i].offsetWidth + "px";
		   newdiv.style.left = container[i].offsetLeft + "px";
		   newdiv.style.top = container[i].offsetTop + "px";
		   newdiv.innerHTML = "hello";
		   document.body.appendChild(newdiv);
		 }
	}
	
}
</script>

<style>

</style>
</head>

<body>
<?php  
include('header.html');
?>


<div class = 'headtag'>
<h1> Shopping Catalogue </h1>
</div> 



<?php session_start(); 
if(isset($_GET['message']))
{
  echo "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h2></div>";
}
else
{
	echo "<div class = 'message' id = 'message'><h2> Welcome To Shop </h2></div>";
}
if(!isset($_SESSION['startswith']))
{
	$_SESSION['startswith'] = 0;
}
if(isset($_GET['startswith']))
{
	$_SESSION['startswith'] =$_GET['startswith']; 
}
?>

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
		   </a>
	       </div>";
}

}
?>

</div> 
</div> <!-- End of lmenu -->

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


<div class = 'search'>
   Search Products : <input type = "text" id ='keyword'>
   <a class='searchnow' id = 'search'>Search Now</a>
</div>
</div>
<div id = "Catalogue" style="min-height:3px;min-height:20rem;"> </div>

<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = 'home.php'> Home </a></span> <span class = 'link'> <a href = 'faqs.php'>FAQ's </a></span> <span class = 'link'><a href = 'contact.php'>  Contact </a></span>
</div>

<script src="../library functions/jquery-2.0.3.min.js"></script>
<script src="script.js"></script>
</body>
</html>