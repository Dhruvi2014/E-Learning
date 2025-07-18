<?php session_start(); ?>
<html>
	<head>
    	<title>E Learning | Payment</title>
		<script src="../js/jquery.js"></script>
    </head>
    
    <body>
    	<?php
			include("inc/function.php");
			echo paypal();
		?>
    </body>
</html>