<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>E Learning | Course Edit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/font-awesome.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<script src="js/jquery.js"></script>
		<style>
			#footer{margin-top:0px; width:80%; margin-left:20%}
			#footer ul li{height:auto !important; background:none !important; box-shadow: none}
			#footer ul li:hover{transform: none !important}
			#footer ul li p{width:100%}
		</style>
	</head>
    <body>
		<div id='wrapper'>
			<?php
				include("inc/header.php");
				echo course_edit();
			?>
		</div>
        <script>
			$(document).ready(function(){
				$('#c_cat_name').change(function(){
					var cat_id=$(this).val();
					$.ajax({
						url:"get_all_sub_cat.php",
						method:"POST",
						data:{catId:cat_id},
						dataType:"text",
						success:function(data){
							$('#c_sub_cat_name').html(data);	
						}
					});
				});
			});
		</script>
    </body>
</html>