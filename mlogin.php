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
<div class = 'headtag'><h1> Manager Login </h1></div>
<?php
//displays messages whenever redirected to this page by this script. 
if(isset($_GET['message']))
{
  echo "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h></div>";
}
?>
<div class ='clientlogin' id = "clientlogin"><a href = "Login.php"> Client Login</a> </div>
<?php
session_start();
if(isset($_POST['login']))
{
$recvdId = trim($_POST['managerid'], " ");
$recvdPwd = trim($_POST['password'], " ");

if($recvdId == '' || $recvdPwd == '')
{
	$message = 'Please fill in all the fields.';
    header("Location:mlogin.php?message=$message");
	exit();
}

$handle = @fopen("manager.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
		$managerdata = explode(",",$buffer);
		$managerid = trim($managerdata[0], " ");
		$password = str_replace(array("\r", "\n"), '', $managerdata[1]);
		
		if(($recvdId == $managerid))
		{
			if(($recvdPwd ==$password))
			{
			  $_SESSION['manager'] = $managerid;
			  $message = '<h3>Hello '.$_SESSION['manager'].'</h3>';
			  header("Location:listing.php?message=$message");
			  exit();
			}
		}
		
	}
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
	
	$message = 'Manager Id or password does not match.';
    header("Location:mlogin.php?message=$message");
}
}
?>
<form method = "post" action = "" class = ''>
<div class ='registertable' style="padding-bottom:2rem;">
<table class = 'registertable'>
<tr>
<td> Manager ID * </td>
<td> <input type = "text" name = "managerid"></td>
</tr>
<br>
<tr>
<td> Password * </td>
<td> <input type = "password" name = "password"></td>
</tr>
<br>
</table>
</div>
<div class ='button'>
<input type = "submit" name = "login" value = "Login" class = 'addtocart'>
</div>
</form>
</body>
</html>