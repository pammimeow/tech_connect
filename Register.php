<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<LINK href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
// executes when user clicks on the register button. 
if(isset($_POST['register']))
{
	$message = '';
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	$phoneno = $_POST['phoneno'];
	
	
	// checking if all are required fields have values. 
	if($email == '' || $firstname == '' || $lastname == '' || $password == '' || $confirmpassword == '')
	{
		$message = 'Please enter all the values in all the required fields';
		header("Location:Register.php?message=$message");
		exit();
	}
	
	$rulesviolated = false;
	// checking if passwords match
	if($password != $confirmpassword)
	{
		$message = "The passwords do not match";
		$rulesviolated = true;
	}
	
	// checking if phone number is valid
	if($phoneno != '')
	{
	  $validphone = preg_match("/^[(]?0[0-9][)]?[0-9]{8,8}/", $phoneno);
	  
	  if(!$validphone)
	  {
	   	  $message .= "<br> The phone number is not valid";
		  $rulesviolated = true;
	  }
	}

    // checking if email is valid
	 $validemail = preg_match("/^[_!#%&=~a-z0-9-]+(\.[_!#%&=~a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email);
	  
	  if(!$validemail)
	  {
	   	  $message .= "<br> The email address is not valid";
		  $rulesviolated = true;
	  }

    
    if($rulesviolated == true)
	{
      header("Location:Register.php?message=$message");
	  exit();
	}
	
	// checking the data with the xml file. 
	$exists = file_exists('customer.xml');
	
	if($exists)
	{
	  $xml = new SimpleXMLElement('customer.xml',LIBXML_NOBLANKS ,true);
      $customers = $xml->xpath("/customers/customer");
	  
	  if(sizeof($customers > 0))
	  {
		foreach ($customers as $customer) 
		{
			 if($customer[0]->email == $email)
			 {
				 // if email is already resistered, header them back to register page. Exit the script. 
				 $message = "This e-mail address is already registered with us";
				 header("Location:Register.php?message=$message");
				 exit();
			 }
		}
	  }
	  // if email not registered, create a new customer and save in xml. Exit script. 
	 
	  $lastid = $xml->xpath("/customers/customer[last()]");
	  $customerid = $lastid[0]->customerid+1;
	
	  $newcust = $xml->addChild('customer');
      $newcust->addChild('customerid', $customerid);
      $newcust->addChild('firstname', $firstname);
      $newcust->addChild('lastname', $lastname);
      $newcust->addChild('email', $email);
      $newcust->addChild('password', $password);
	  $newcust->addChild('phoneno', $phoneno);
	  $xml->asXML("customer.xml"); 
	  $message ="You have been successfully registered with us.";
	  header("Location:Register.php?message=$message");
	  exit();
	}
	
	// if the customer.xml does not exist, create a new one. 
	$doc = new DomDocument('1.0');
    $customers = $doc->createElement('customers');
    $customers = $doc->appendChild($customers);

	$customer = $doc->createElement('customer');
	$customer = $customers->appendChild($customer);
	
	$customerid = $doc->createElement('customerid'); 
	$customerid = $customer->appendChild($customerid);   
	$value = $doc->createTextNode("1");
	$value = $customerid->appendChild($value);
    
    $firstnamexml = $doc->createElement('firstname'); 
	$firstnamexml = $customer->appendChild($firstnamexml);   
	$value = $doc->createTextNode($firstname);
	$value = $firstnamexml->appendChild($value);
		
	$lastnamexml = $doc->createElement('lastname'); 
	$lastnamexml = $customer->appendChild($lastnamexml);   
	$value = $doc->createTextNode($lastname);
	$value = $lastnamexml->appendChild($value);
	
	$emailxml = $doc->createElement('email'); 
	$emailxml = $customer->appendChild($emailxml);   
	$value = $doc->createTextNode($email);
	$value = $emailxml->appendChild($value);
	
	$passwordxml = $doc->createElement('password'); 
	$passwordxml = $customer->appendChild($passwordxml);   
	$value = $doc->createTextNode($password);
	$value = $passwordxml->appendChild($value);
		
	$phonenoxml = $doc->createElement('phoneno'); 
	$phonenoxml = $customer->appendChild($phonenoxml);   
	$value = $doc->createTextNode($phoneno);
	$value = $phonenoxml->appendChild($value);
		
	$doc->save('customer.xml');
	$message = "You have been successfully registered with us.";
	header("Location:Register.php?message=$message");
}
?>
<?php  
include('header.html');
?>
<div class = 'headtag'><h1> Customer Registration </h1></div>
<?php
//displays messages whenever redirected to this page by this script. 
if(isset($_GET['message']))
{
  echo "<div class = 'message' id = 'message'><h2>" .$_GET['message']."</h></div>";
  
  if($_GET['message'] == 'You have been successfully registered with us.')
  {  
      echo "<div class ='processing'> <a href = 'login.php'> Login Now </a> </div>";
  }
}
?>
<form method = "post" action = "">

<div class ='registertable'>
<br>
<table border = "0" class ='registertable'>
<tr>
<td class ='label'> Email Address * <br>&nbsp;</td>
<td>  <input type = "text" name = "email"><br>&nbsp;</td>
</tr>
<tr>
<td class ='label'> Firstname * <br>&nbsp;</td>
<td> <input type = "text" name = "firstname"><br>&nbsp;</td>
</tr>
<tr>
<td class ='label'> Lastname * <br>&nbsp;</td>
<td> <input type = "text" name = "lastname"><br>&nbsp;</td>
</tr>
<tr>
<td class ='label'> Password * <br>&nbsp;</td>
<td>  <input type = "password" name = "password"><br>&nbsp;</td>
</tr>
<tr>
<td class ='label'> Confirm Password * <br>&nbsp;</td>
<td> <input type = "password" name = "confirmpassword"><br>&nbsp;</td>
</tr>
<tr>
<td class ='label'> Phone number <br>&nbsp;</td>
<td> <input type = "text" name = "phoneno"><br>&nbsp;</td>
</tr>
</table>
</div>
<div class ='button'>
<input type = "submit" name = "register" value = "Register" class="addtocart">
</div>


</form>
</body>
</html>