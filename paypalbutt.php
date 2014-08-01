<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$pp_checkout_btn = '';
$pp_checkout_btn .= '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="pammimeow-facilitator@gmail.com">';
$pp_checkout_btn .= '<input type="hidden" name="item_name_1" value="testproduct">
        <input type="hidden" name="amount_1" value="30">
        <input type="hidden" name="quantity_1" value="2">  ';
$pp_checkout_btn .= '<input type="hidden" name="custom" value="">
	<input type="hidden" name="notify_url" value="https://www.yoursite.com/storescripts/my_ipn.php">
	<input type="hidden" name="return" value="https://mercury.ict.swin.edu.au/hit3324/s492441x/Assignment1/administration.php">
	<input type="hidden" name="rm" value="0">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="https://mercury.ict.swin.edu.au/hit3324/s492441x/Assignment1/administration.php">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">
	</form>';
echo $pp_checkout_btn;
?>
</body>
</html>