<?php session_start(); ?>
<html>
	<head>
    	<title>E Learning | Payment</title>
    </head>
    
    <body>
    	<?php
			include("inc/function.php");
			echo paypal_single();
		?>
    </body>
</html>