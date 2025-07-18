<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>E Learning Admin | Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="../css/font-awesome.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <script src="../js/jquery.js"></script>
        <script>
        	$(document).ready(function(){
                $('#edit_form table tr td:even').css("width","40%");
				$('#course tr:even').css("background","#ccc");
            });
        </script>
	</head>
    <body>
    	<?php
        	include("inc/header.php");
			include("inc/bodyleft.php");
		?>
		<div id='bodyright'>
			<h3>Pay To Instructor</h3>
			<?php echo pay_process(); ?>
		</div>
    </body>
</html>