<div id='bodyright'>
	<h3>FAQs</h3>
	<?php
        include("inc/db.php");
        $get_info=$con->prepare("select * from faqs");
        $get_info->setFetchMode(PDO:: FETCH_ASSOC);
        $get_info->execute();
        echo "<form method='post' enctype='multipart/form-data'>";
    	if(!isset($_POST['add_faq'])){
			echo"<button style='margin-left:1%;' id='btn' name='add_faq'>Add New Q&A</button>";
		}
		if(isset($_POST['add_faq'])){
			echo"<center>
					<input id='faq_que' type='text' name='add_que' placeholder='Enter Your Question Here...' />
					<textarea name='add_ans' placeholder='Enter Your Answer Here...'></textarea>
					<button style='margin-left:1%;' id='btn' name='add_faq_qna'>Add New Q&A</button>
				</center>";
		}
		echo"</form>";
		if(isset($_POST['add_faq_qna'])){
			$question=$_POST['add_que'];
			$answer=$_POST['add_ans'];
			
			$add_faq=$con->prepare("insert into faqs(question,answer)values('$question','$answer')");
			if($add_faq->execute()){
				echo"<script>window.open('index.php?faqs','_self')</script>";	
			}	
		}
	while($row=$get_info->fetch()):
    ?>
	<form method='post' enctype='multipart/form-data'>
    	<center>
        	<details>	
            	<summary><h4><?php echo $row['question']; ?></h4></summary>
            	<center>
                	<input id='faq_que' type="text" name="que" value="<?php echo $row['question']; ?>" />
                	<textarea name='ans'><?php echo $row['answer']; ?></textarea>
                </center>
                <input type="hidden" name="q_id" value="<?php echo $row['q_id']; ?>" />
            	<input name="faq_save" style="float:right; margin-right:2.5%" type="submit" id='btn' value="Save" />
            </details>
        </center><br clear="all" />
    </form>
    <?php endwhile; ?>
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