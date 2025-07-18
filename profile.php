<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>E Learning | Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/font-awesome.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <script src="js/jquery.js"></script>
        <script src="js/cycle.js"></script>
		<style>
			@media screen and (min-device-width:799px){
				#footer{width:100% !important; bottom: 0px !important}
				#footer ul li{height:auto !important; background:none !important; box-shadow: none}
				#footer ul li:hover{transform: none !important}
				#footer ul li p{width:100%}
			}
			@media screen and (min-device-width:800px){
				#footer{width:80% !important; margin-left:20% !important}
				#footer ul li{height:auto !important; background:none !important; box-shadow: none}
				#footer ul li:hover{transform: none !important}
				#footer ul li p{width:100%}
			}
		</style>
	</head>
    <body>
		<div id='wrapper'>
			<?php
				include("inc/header.php");
				echo profile();
			?>
		</div>
    </body>
</html>