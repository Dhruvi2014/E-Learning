<?php
	$con=new pdo("mysql:host=Localhost;dbname=e_learning_user;charset=utf8","root","");
	//$con=new pdo("mysql:host=Localhost;dbname=error_code_learning;charset=utf8","four_zero_four_1","fTa0!ZlZKiRu");
	$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	//$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>