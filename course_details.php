<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>E Learning | Course</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/font-awesome.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <script src="js/jquery.js"></script>
        <script src="js/cycle.js"></script>
        <script>
			$(document).ready(function(){
                $('#course_right table tr td:even').css("width","20%");
				$('#course_right table tr td:even').css("color","#3f5267");
				$('#course_right table tr td:even').css("font-weight","bold");
            });
        </script>
        
	</head>
    <body>
		<div id='wrapper'>
			<?php
				include("inc/header.php");
				echo course_details();
				echo "<br clear='all' />";
				include("inc/footer.php");
			?>
		</div>
    </body>
</html>