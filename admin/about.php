<?php
	include("inc/db.php");
	$get_info=$con->prepare("select * from about_us");
	$get_info->setFetchMode(PDO:: FETCH_ASSOC);
	$get_info->execute();
	
	$row=$get_info->fetch();
?>
<div id='bodyright'>
	<h3>About Us</h3>
	<form method="post">
    	<center><textarea name='about_us'><?php echo $row['about']; ?></textarea></center>
    	<input name="about_save" style="float:right; margin-right:2.5%" type="submit" id='btn' value="Save" />
    </form>
</div>
<?php
	if(isset($_POST['about_save'])){
		include("inc/db.php");
		$about=$_POST['about_us'];
		
		$up_about=$con->prepare("update about_us set about='$about'");
		
		if($up_about->execute()){
			echo"<script>window.open('index.php?about_us','_self')</script>";	
		}
		else{
			echo"<script>alert('Something Wrong Please Try Again !!!');</script>";	
		}	
	}
?>