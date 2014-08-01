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

if(isset($_POST['login']))
{
	$message = '';
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	// checking if all are required fields have values. 
	if($email == '' || $password == '')
	{
		$message = 'Please enter all the values in all the required fields';
		header("Location:Login.php?message=$message");
		exit();
	}

	// checking if the username and password are right. 
	$xml = new SimpleXMLElement('customer.xml',null,true);
    $customers = $xml->xpath("/customers/customer[email='$email' and password='$password']");
	if(sizeof($customers) == 0)
	{
		$message = 'No records found';
		header("Location:Login.php?message=$message");
	}
	else
	{
		if(isset($_SESSION['shopstatus']))
		{
			$message = 'You can checkout now.';
			$_SESSION['username'] = (string)$customers[0]->firstname;
		    header("Location:showcart.php?message=$message");
			exit();
		}
		
		$_SESSION['username'] = (string)$customers[0]->firstname;
		$message = 'You are welcome to shop with us '.$_SESSION['username'];
		header("Location:buying.php?message=$message");
		exit();
	}
}
?>
<form method = "post" action = "">
<?php  
include('header.html');
?>

<div class = 'headtag'>  <h1>Login here ( Client Login )</h1></div>
<?php
//displays messages whenever redirected to this page by this script. 
if(isset($_GET['message']))
{
  echo "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h></div>";
}
?>
<div class ='managerlogin' id = "managerlogin"><a href = "mlogin.php"> Manager Login</a> </div>
<div class ='rightbutt' id = "managerlogin"><a href = "Register.php"> Clients Register Here </a> </div>



<div class ='registertable'>
<br>
<br>
<table border = "0" class ='registertable'>
<tr>
<td> Email * <br> &nbsp;</td>
<td> <input type = "text" name = "email"><br> &nbsp;</td>
</tr>
<tr>
<td> Password * <br> &nbsp;</td>
<td> <input type = "password" name = "password"><br> &nbsp;</td>
</tr>
</table>
<br> 
<br> 
</div>
<div class = 'clear'></div>
<div class ='button'>
<input type = "submit" name = "login" value = "Login" class = 'addtocart'>
</div>


</form>
</body>
</html>