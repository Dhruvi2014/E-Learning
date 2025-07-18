<?php session_start(); if(!isset($_SESSION['email_u'])){ header("Location:index.php"); }else{ ?>
<html>
	<head>
    	<title>E Learning | Payment</title>
    </head>
    
    <body>
    	<?php
			include("inc/function.php");
			echo paypal_cart();
		?>
    </body>
</html>
<?php } ?>