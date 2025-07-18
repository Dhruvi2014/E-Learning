<?php
	include("inc/db.php");
	$get_info=$con->prepare("select * from contact_us");
	$get_info->setFetchMode(PDO:: FETCH_ASSOC);
	$get_info->execute();
	
	$row=$get_info->fetch();
?>
<div id='bodyright'>
	<h3>Contact Us Page</h3>
	<form method="post">
    	<table cellpadding="0" cellspacing="0">
        	<tr>
            	<td>Update Contact No.</td>
                <td><input maxlength="10" type="tel" pattern="[0-9 ^+]{10}" name="up_phone" title="Please Enter 12Digit Phone No." value="<?php echo $row['phone_no']; ?>" /></td>
            </tr>
            <tr>
            	<td>Update Email</td>
                <td><input maxlength="50" type="email" pattern="[0-9 a-z A-Z ^@.]{1,50}" title="Do Not Use Special Characters Only '@' And '.' Allow" name="up_email" value="<?php echo $row['email']; ?>" /></td>
            </tr>
            <tr>
            	<td>Update Office Address Line 1</td>
                <td><input maxlength="30" type="text" name="up_add1" value="<?php echo $row['add1']; ?>" /></td>
            </tr>
            <tr>
            	<td>Update Office Address Line 2</td>
                <td><input maxlength="30" type="text" name="up_add2" value="<?php echo $row['add2']; ?>" /></td>
            </tr>
            <tr>
            	<td>http://youtube.com/</td>
                <td><input maxlength="50" type="text" name="up_yt" value="<?php echo $row['yt']; ?>" /></td>
            </tr>
            <tr>
            	<td>http://facebook.com/</td>
                <td><input maxlength="50" type="text" name="up_fb" value="<?php echo $row['fb']; ?>" /></td>
            </tr>
            <tr>
            	<td>https://plus.google.com/</td>
                <td><input maxlength="50" type="text" name="up_gp" value="<?php echo $row['gp']; ?>" /></td>
            </tr>
            <tr>
            	<td>https://twitter.com/</td>
                <td><input maxlength="50" type="text" name="up_tw" value="<?php echo $row['tw']; ?>" /></td>
            </tr>
            <tr>
            	<td>http://www.linkedin.com/</td>
                <td><input maxlength="50" type="text" name="up_li" value="<?php echo $row['li']; ?>" /></td>
            </tr>
        </table>
        <input style="float:right; margin-right:5%" id='btn' type="submit" name="up_contact" value="Save" />
    </form>
</div>
<?php
	if(isset($_POST['up_contact'])){
		$phone=$_POST['up_phone'];
		$email=$_POST['up_email'];
		$add1=$_POST['up_add1'];
		$add2=$_POST['up_add2'];
		$yt=$_POST['up_yt'];
		$fb=$_POST['up_fb'];
		$gp=$_POST['up_gp'];
		$tw=$_POST['up_tw'];
		$li=$_POST['up_li'];
		
		$up_info=$con->prepare("update contact_us set phone_no='$phone',email='$email',add1='$add1',add2='$add2',yt='$yt',fb='$fb',gp='$gp',tw='$tw',li='$li'");
		
		if($up_info->execute()){
			echo"<script>window.open('index.php?contact_us','_self');</script>";	
		}
		else{
			echo"<script>alert('Something Wrong Please Try Again !!!');</script>";	
		}	
	}
?>