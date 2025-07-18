<div id='bodyright'>
	<h3>Terms And Conditions</h3>
	<?php
        include("inc/db.php");
        $get_info=$con->prepare("select * from terms");
        $get_info->setFetchMode(PDO:: FETCH_ASSOC);
        $get_info->execute();
        echo "<form method='post' enctype='multipart/form-data'>";
    	if(!isset($_POST['add_term'])){
			echo"<button style='margin-left:1%;' id='btn' name='add_term'>Add New T&C</button>";
		}
		if(isset($_POST['add_term'])){
			echo"<center>
					<input maxlength='200' id='faq_que' type='text' name='add_term' placeholder='Enter Your Question Here...' />
					<select required id='faq_que' name='term_type'>
						<option value=''>Select Term For</option>
						<option value='instructor'>Instructors</option>
						<option value='student'>Students</option>
					</select>
					<button style='margin-left:1%;' id='btn' name='add_term_now'>Add T&C</button>
				</center>";
		}
		echo"</form>";
		if(isset($_POST['add_term_now'])){
			$term=$_POST['add_term'];
			$term_type=$_POST['term_type'];
			
			$add_term=$con->prepare("insert into terms(term,term_type)values('$term','$term_type')");
			if($add_term->execute()){
				echo"<script>window.open('index.php?terms','_self')</script>";	
			}	
		}
		echo"<form method='post' enctype='multipart/form-data'>";
		$i=1;
		echo"<table cellspacing='0'>
				<tr>
					<th>Sr No.</th>
					<th>Terms</th>
					<th>Terms For</th>
				</tr>";
		while($row=$get_info->fetch()):
    ?>
    	<tr>
        	<td><?php echo $i++ ?></td>
            <td><?php echo $row['term']; ?></td>
            <td><?php echo $row['term_type']; ?></td>
        </tr>
    <?php endwhile; ?>
    </table>
     </form>
</div>
<?php
	if(isset($_POST['faq_save'])){
		include("inc/db.php");
		$q_id=$_POST['q_id'];
		$ans=$_POST['ans'];
		$que=$_POST['que'];
		
		$up_about=$con->prepare("update faqs set question='$que',answer='$ans' where q_id='$q_id'");
		
		if($up_about->execute()){
			echo"<script>window.open('index.php?faqs','_self')</script>";	
		}
		else{
			echo"<script>alert('Something Wrong Please Try Again !!!');</script>";	
		}	
	}
?>