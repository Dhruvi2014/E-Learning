<div id='bodyright'>
	<?php if(isset($_GET['course_search'])){ ?>
		<h3>Advance Course Search</h3>
        <form style='margin-top:200px' id='course_search' method="post" action="course_search.php" enctype="multipart/form-data">
            <center><input maxlength="100" pattern='[a-z A-Z]{3,100}' type="text" name="user_query" title="Enter Atleast 3 Characters, Maximim 100 Characters Allowed, Special Characters Not Allowed" placeholder="Search Course" /><br />
            <select name='course_lvl'>
            	<option value=''>Select Level</option>
                <option value='All Level'>All Level</option>
                <option value='Biginner Level'>Begginer Level</option>
                <option value='Intermidiate Level'>Intermidiate Level</option>
                <option value='Expert Level'>Expert Level</option>
            </select>
            <select name="cat" id='c_cat_name'>
                <option value="">Select Category</option>
                <?php echo select_cat(); ?>
            </select>
            <select name="sub_cat" id='c_sub_cat_name'>
                <option value="">Select Sub Category</option>
            </select>
            <select name='course_privacy'>
                <option value="">Select Privacy</option>
                <option>Public</option>
                <option>Private</option>
            </select>
            <select name='course_type'>
                <option value="">Select Type</option>
                <option>Free</option>
                <option>Paid</option>
            </select>
            <select name="course_lang">
                <option value="">Select Language</option>
                <?php echo select_lang(); ?>
            </select>
            <input type="submit" name="course_search" value="Search" /></center>
        </form>
        <script>
			$(document).ready(function(){
				$('#c_cat_name').change(function(){
					var cat_id=$(this).val();
					$.ajax({
						url:"../get_all_sub_cat.php",
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
	<?php 
		}else{ 
			echo course();
		}
	?>
</div>