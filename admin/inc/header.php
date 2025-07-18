<?php 
	session_start(); 
	if(!isset($_SESSION['admin_mail'])){ 
		header("Location:login.php");
	}
	include("inc/function.php"); 
?>
<div id='header'>
	<div id='name'><a href='index'><img src="Logo.png"></a></div>
    <div id='title'>Admin Panel </div>
    <div id='link'>
    	<p><a href='logout.php'><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></p>
    </div>
</div>