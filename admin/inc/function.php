<?php
	function login(){
		include("inc/db.php");
		if(isset($_POST['login'])){
			$a_name=$_POST['a_name'];
			$a_email=$_POST['a_email'];
			$a_pass=$_POST['a_pass'];
			
			$get_admin=$con->prepare("select * from admin where a_name='$a_name' AND a_email='$a_email' AND a_pass='$a_pass'");	
			$get_admin->setFetchMode(PDO:: FETCH_ASSOC);
			$get_admin->execute();
			if($get_admin->rowCount()==1){
				$_SESSION['admin_mail']=$a_email;
				header("Location:index.php");	
			}
			else{
				echo"<script>alert('Username Or Email Or Password Is Incorrect Please Try Again')</script>";	
			}
		}	
	}
	function overview(){
		include("inc/db.php");
		//get cat
		$get_cat=$con->prepare("select * from cat");
		$get_cat->execute();
		$cat_count=$get_cat->rowCount();
		
		echo"<div style='background:#00a2e8' id='part'>
					<h5>$cat_count <br /><span>Total Categories</span></h5>
					<h1><i class='fa fa-th-large'></i></h1><br clear='all' />
					<p><a href='index.php?cat'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
				</div>";
		//get sub cat
		$get_sub_cat=$con->prepare("select * from sub_cat");
		$get_sub_cat->execute();
		$sub_cat_count=$get_sub_cat->rowCount();
		
		echo"<div style='background:#060' id='part'>
					<h5>$sub_cat_count <br /><span>Total Sub Categories</span></h5>
					<h1 style='color:#090'><i class='fa fa-th-list'></i></h1><br clear='all' />
           			<p style='background:#090'><a href='index.php?sub_cat'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>	
				</div>";
		//get all students
		$get_stud=$con->prepare("select * from user");
		$get_stud->execute();
		$stud_count=$get_stud->rowCount();
		
		echo"<div style='background:#ff4000' id='part'>
					<h5>$stud_count <br /><span>Total Students</span></h5>
					<h1 style='color:#b43104'><i class='fa fa-users'></i></h1><br clear='all' />
            		<p style='background:#b43104'><a href='index.php?stud'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
				</div>";
		//get all teachers
		$get_ins=$con->prepare("select * from user where u_type='instructor'");
		$get_ins->execute();
		$ins_count=$get_ins->rowCount();
		
		echo"<div style='background:#004080' id='part'>
					<h5>$ins_count <br /><span>Total Teachers</span></h5>
					<h1 style='color:#008080'><i class='fa fa-users'></i></h1><br clear='all' />
            		<p style='background:#008080'><a href='index.php?ins'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
		//get active courses
		$get_a_course=$con->prepare("select * from course where status='publish'");
		$get_a_course->execute();
		$a_course_count=$get_a_course->rowCount();
		
		echo"<div style='background:#FF8000' id='part'>
					<h5>$a_course_count <br /><span>Active Courses</span></h5>
        			<h1 style='color:#804000'><i class='fa fa-book'></i></span></h1><br clear='all' />
            		<p style='background:#804000'><a href='index.php?a_course'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
		//get padding courses
		$get_p_course=$con->prepare("select * from course where status='pending'");
		$get_p_course->execute();
		$p_course_count=$get_p_course->rowCount();
		
		echo"<div style='background:#2e2e2e' id='part'>
					<h5>$p_course_count <br /><span>Padding Course</span></h5>
        			<h1 style='color:#e6e6e6'><i class='fa fa-book'></i></h1><br clear='all' />
            		<p style='background:#e6e6e6'><a style='color:#000' href='index.php?p_course'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
		//get unpublish courses
		$get_u_course=$con->prepare("select * from course where status='unpublish'");
		$get_u_course->execute();
		$u_course_count=$get_u_course->rowCount();
		
		echo"<div style='background:#800000' id='part'>	
					<h5>$u_course_count <br /><span>Unpublish Courses</span></h5>
					<h1 style='color:#400000'><i class='fa fa-book'></i></h1><br clear='all' />
            		<p style='background:#400000'><a href='index.php?u_course'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
		//pandding orders
		$get_p_order=$con->prepare("select * from payment where ins_status='pending' GROUP BY (ins_id)");
		$get_p_order->execute();
		$p_order_count=$get_p_order->rowCount();
		
		echo"<div style='background:#F0F' id='part'>
					<h5>$p_order_count <br /><span>Pandding Payments</span></h5>
        			<h1 style='color:#FF80FF'><i class='fa fa-usd'></i></h1><br clear='all' />
            		<p style='background:#FF80FF'><a href='index.php?pen_ord'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
		//complete orders
		$get_order=$con->prepare("select * from payment where ins_status='complete' GROUP BY (ins_id)");
		$get_order->execute();
		$order_count=$get_order->rowCount();
		
		echo"<div style='background:#96F' id='part'>
					<h5>$order_count <br /><span>Complete Payments</span></h5>
        			<h1 style='color:#99F'><i class='fa fa-usd'></i></h1><br clear='all' />
            		<p style='background:#99F'><a href='index.php?comp_ord'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
		
		echo"<div style='background:#06f' id='part'>
					<h5><br /><span>Contct<br /> Us</span></h5>
        			<h1 style='color:#09f'><i class='fa fa-phone'></i></h1><br clear='all' />
            		<p style='background:#09f'><a href='index.php?contact'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
				
		echo"<div style='background:#3f5267' id='part'>
					<h5><br /><span>About<br /> Us</span></h5>
        			<h1 style='color:#74889e'><i class='fa fa-info-circle'></i></h1><br clear='all' />
            		<p style='background:#74889e'><a href='index.php?about'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
				
		echo"<div style='background:#400040' id='part'>
					<h5><br /><span>Terms & Conditions</span></h5>
        			<h1 style='color:#800080'><i class='fa fa-check-circle'></i></h1><br clear='all' />
            		<p style='background:#800080'><a href='index.php?terms'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
				
		echo"<div style='background:#2e2e2e' id='part'>
					<h5><span><br />FAQs Management</span></h5>
        			<h1 style='color:#000'><i class='fa fa-question-circle'></i></h1><br clear='all' />
            		<p style='background:#000'><a href='index.php?faqs'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";
				
		echo"<div style='background:#060' id='part'>
					<h5><span><br />Slider Management</span></h5>
        			<h1 style='color:#090'><i class='fa fa-picture-o'></i></h1><br clear='all' />
            		<p style='background:#090'><a href='index.php?slider'>View More <span class='glyphicon glyphicon-circle-arrow-right'></span></a></p>
        		</div>";	
	}
	function img_slider(){
		include("db.php");
		if(isset($_POST['up_slider'])){
			if($_FILES['slide1']['tmp_name']==""){}else{
				$img1_name=$_FILES['slide1']['tmp_name'];
				$i1=$_FILES['slide1']['name'];
				move_uploaded_file($img1_name,"../../imgs/slider/$i1");
				
				$update_img1=$con->prepare("update img_slider set img1='$i1'");
				$update_img1->execute();
			}
			if($_FILES['slide2']['tmp_name']==""){}else{
				$img2_name=$_FILES['slide2']['tmp_name'];
				$i2=$_FILES['slide2']['name'];
				move_uploaded_file($img2_name,"../../imgs/slider/$i2");
				
				$update_img2=$con->prepare("update img_slider set img2='$i2'");
				$update_img2->execute();
			}
			if($_FILES['slide3']['tmp_name']==""){}else{
				$img3_name=$_FILES['slide3']['tmp_name'];
				$i3=$_FILES['slide3']['name'];
				move_uploaded_file($img3_name,"../../imgs/slider/$i3");
				
				$update_img3=$con->prepare("update img_slider set img3='$i3'");
				$update_img3->execute();
			}
			if($_FILES['slide4']['tmp_name']==""){}else{
				$img4_name=$_FILES['slide4']['tmp_name'];
				$i4=$_FILES['slide4']['name'];
				move_uploaded_file($img4_name,"../../imgs/slider/$i4");
				
				$update_img4=$con->prepare("update img_slider set img4='$i4'");
				$update_img4->execute();
			}
			if($_FILES['slide5']['tmp_name']==""){}else{
				$img5_name=$_FILES['slide5']['tmp_name'];
				$i5=$_FILES['slide5']['name'];
				move_uploaded_file($img5_name,"../../imgs/slider/$i5");
				
				$update_img5=$con->prepare("update img_slider set img5='$i5'");
				$update_img5->execute();
			}
			if($_FILES['slide6']['tmp_name']==""){}else{
				$img6_name=$_FILES['slide6']['tmp_name'];
				$i6=$_FILES['slide6']['name'];
				move_uploaded_file($img6_name,"../../imgs/slider/$i6");
				
				$update_img6=$con->prepare("update img_slider set img6='$i6'");
				$update_img6->execute();
			}
		}
	}
	function select_lang(){
		include("inc/db.php");
		$get_lang=$con->prepare("select * from lang order by lang_name");
		$get_lang->setFetchMode(PDO:: FETCH_ASSOC);
		$get_lang->execute();
		
		while($row=$get_lang->fetch()):
			echo"<option value='".$row['lang_id']."'>".$row['lang_name']."</option>";
		endwhile;	
	}
	function select_cat(){
		include("inc/db.php");
		$get_cat=$con->prepare("select * from cat");
		$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cat->execute();
		while($row=$get_cat->fetch()):
			echo"<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
		endwhile;
			
	}
	function all_cat(){
		include("inc/db.php");
		$get_cat=$con->prepare("select * from cat order by 1 desc");
		$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cat->execute();
		$i=1;
		while($row=$get_cat->fetch()):
			echo"<tr>
					<td>".$i++."</td>
					<td>".$row['cat_icon']." ".$row['cat_name']."</td>
					<td>
						<p><a href='index.php?cat&edit_cat=".$row['cat_id']."'><i class='fa fa-edit' area-hidden='true'></i></a></p>
						<p><a style='color:#f06' href='index.php?cat&del_cat=".$row['cat_id']."'><i class='fa fa-trash' area-hidden='true'></i></a></p>
					</td>
				</tr>";
		endwhile;	
	}
	function add_cat(){
		include("inc/db.php");
		if(isset($_POST['add_cat'])){
			$cat_name=$_POST['cat_name'];
			$cat_icon=$_POST['cat_icon'];
			$check=$con->prepare("select * from cat where cat_name='$cat_name'");
			$check->setFetchMode(PDO:: FETCH_ASSOC);
			$check->execute();
			$count=$check->rowCount();

			if($count==1){
				echo"<script>alert('Category Already Added')</script>";
			}else{
				$add_cat=$con->prepare("insert into cat(cat_name,cat_icon)values('$cat_name','$cat_icon')");
				
				if($add_cat->execute()){
					echo"<script>alert('Category Added Successfully');</script>";
					header("Location:index.php?cat");
				}
				else{
					echo"<script>alert('Category Not Added Successfully');</script>";	
				}
			}
		}
	}
	function edit_cat(){
		include("inc/db.php");
		if(isset($_GET['edit_cat'])){
			$cat_id=$_GET['edit_cat'];
			$get_cat=$con->prepare("select * from cat where cat_id='$cat_id'");
			$get_cat->execute();
			
			$row_cat=$get_cat->fetch();
			echo"<form method='post' id='edit_form'>
					<h3>Edit Category</h3>
					<table cellspacing='0'>
						<tr>
							<td>Update Category</td>
							<td><input type='text' name='up_cat_name' value='".$row_cat['cat_name']."' required /></td>
						</tr>
						<tr>
							<td>".$row_cat['cat_icon']." Update Category Icon</td>
							<td><input type='text' name='up_cat_icon' value='".$row_cat['cat_icon']."' required /></td>
						</tr>
					</table>
					<center>
						<button name='up_cat'>Save</button>
						<button><a href='index.php?cat'>Cancel</a></button>
					</center>	
				</form>";
				
		if(isset($_POST['up_cat'])){
			$up_cat_icon=$_POST['up_cat_icon'];
			$cat_name=$_POST['up_cat_name'];
				$up_cat=$con->prepare("update cat set cat_name='$cat_name',cat_icon='$up_cat_icon' where cat_id='$cat_id'");

				if($up_cat->execute()){
					echo"<script>alert('Category Updated Successfully')</script>";	
					echo"<script>window.open('index.php?cat','_self');</script>";
				}
				else{
					echo"<script>alert('Something Wrong Please Try Again !!!')</script>";	
				}
			}
		}	
	}
	function add_sub_cat(){
		include("inc/db.php");
		if(isset($_POST['add_sub_cat'])){
			$sub_cat_name=$_POST['sub_cat_name'];
			$sub_cat_icon=$_POST['sub_cat_icon'];
			$cat_id=$_POST['cat_id'];

			// if(!preg_match("/^[a-zA-Z]+$/", $lang_name)){
            //     echo "<script>alert('Language name should only contain letters.')</script>";
            //     echo "<script>window.open('index.php?lang','_self')</script>";
            //     return;
            // }

			$check=$con->prepare("select * from sub_cat where sub_cat_name='$sub_cat_name'");
			$check->setFetchMode(PDO:: FETCH_ASSOC);
			$check->execute();
			$count=$check->rowCount();

			if($count==1){
				echo"<script>alert('Sub Category Already Added')</script>";
			}else{
				$add_cat=$con->prepare("insert into sub_cat(sub_cat_name,sub_cat_icon,cat_id)values('$sub_cat_name','$sub_cat_icon','$cat_id')");

				if($add_cat->execute()){
					echo"<script>alert('Sub Category Added Successfully');</script>";
					header("Location:index.php?sub_cat");
				}
				else{
					echo"<script>alert('Category Not Added Successfully');</script>";	
				}
			}
		}	
	}
	function del_cat(){
		include("inc/db.php");
		if(isset($_GET['del_cat'])){
			$delete_id=$_GET['del_cat'];
			$delete_cat=$con->prepare("delete from cat where cat_id='$delete_id'");
			if($delete_cat->execute()){
				echo"<script>alert('Category Deleted Successfully');</script>";
				echo"<script>window.open('index.php?cat','_self');</script>";	
			}
		}	
	}
	function all_sub_cat(){
		include("inc/db.php");
		$get_cat=$con->prepare("select * from sub_cat order by 1 desc");
		$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cat->execute();
		$i=1;
		while($row=$get_cat->fetch()):
			$cat_id=$row['cat_id'];
			$get_c=$con->prepare("select * from cat where cat_id='$cat_id'");
			$get_c->setFetchMode(PDO:: FETCH_ASSOC);
			$get_c->execute();
			$row_cat=$get_c->fetch();
			echo"<tr>
					<td>".$i++."</td>
					<td>".$row_cat['cat_name']."</td>
					<td>".$row['sub_cat_icon']." ".$row['sub_cat_name']."</td>
					<td>
						<p><a href='index.php?sub_cat&edit_sub_cat=".$row['sub_cat_id']."'><i class='fa fa-edit' area-hidden='true'></i></a></p>
						<p><a style='color:#f06' href='index.php?sub_cat&del_sub_cat=".$row['sub_cat_id']."'><i class='fa fa-trash' area-hidden='true'></i></a></p>
					</td>
				</tr>";
		endwhile;	
	}
	function edit_sub_cat(){
		include("inc/db.php");
		if(isset($_GET['edit_sub_cat'])){
			$sub_cat_id=$_GET['edit_sub_cat'];
			$get_sub_cat=$con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
			$get_sub_cat->execute();
			
			$row_sub_cat=$get_sub_cat->fetch();
			$get_id=$row_sub_cat['cat_id'];
			$get_cat=$con->prepare("select * from cat where cat_id='$get_id'");
			$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cat->execute();
			$row_cat=$get_cat->fetch();
			
			echo"<form method='post' id='edit_form'>
					<h3>Edit Sub Category</h3>
					<table cellspacing='0'>
						<tr>
							<td>Select Category</td>
							<td>
								<select name='cat_id' required>
									<option value='".$row_cat['cat_id']."'>".$row_cat['cat_name']."</option>";
									echo select_cat();
							echo"</select>
							</td>
						</tr>
						<tr>
							<td>Update Sub Category</td>
							<td><input type='text' name='up_sub_cat_name' value='".$row_sub_cat['sub_cat_name']."' /></td>
						</tr>
						<tr>
							<td>".$row_sub_cat['sub_cat_icon']." Update Sub Category Icon</td>
							<td><input type='text' name='up_sub_cat_icon' value='".$row_sub_cat['sub_cat_icon']."' /></td>
						</tr>
					</table>
					<center>
						<button name='up_sub_cat'>Save</button>
						<button><a href='index.php?sub_cat'>Cancle</a></button>
					</center>	
				</form>";
				
			if(isset($_POST['up_sub_cat'])){
				$up_sub_cat_icon=$_POST['up_sub_cat_icon'];
				$sub_cat_name=$_POST['up_sub_cat_name'];
				$cat_id=$_POST['cat_id'];
				$up_cat=$con->prepare("update sub_cat set sub_cat_name='$sub_cat_name',sub_cat_icon='$up_sub_cat_icon',cat_id='$cat_id' where sub_cat_id='$sub_cat_id'");	

				if($up_cat->execute()){
					echo"<script>alert('Sub Category Updated Successfully')</script>";	
					echo"<script>window.open('index.php?sub_cat','_self');</script>";
				}
				else{
					echo"<script>alert('Something Wrong Please Try Again !!!')</script>";	
				}
			}
		}	
	}
	function del_sub_cat(){
		include("inc/db.php");
		if(isset($_GET['del_sub_cat'])){
			$delete_id=$_GET['del_sub_cat'];
			$delete_cat=$con->prepare("delete from sub_cat where sub_cat_id='$delete_id'");
			if($delete_cat->execute()){
				echo"<script>alert('Sub Category Deleted Successfully');</script>";
				echo"<script>window.open('index.php?sub_cat','_self');</script>";	
			}
		}	
	}
	function course(){
		include("inc/db.php");
		if(isset($_GET['a_course'])){
			$status="Publish";
			echo"<h3>View All Active Courses</h3>";
			$get_course=$con->prepare("select * from course where status='$status'");
			$get_course->setFetchMode(PDO:: FETCH_ASSOC);
			$get_course->execute();
		}elseif(isset($_GET['p_course'])){
			$status="Pending";
			echo"<h3>View All Pending Courses</h3>";
			$get_course=$con->prepare("select * from course where status='$status'");
			$get_course->setFetchMode(PDO:: FETCH_ASSOC);
			$get_course->execute();
		}elseif(isset($_GET['u_course'])){
			$status="Unpublish";
			echo"<h3>View All Unpublish Courses</h3>";
			$get_course=$con->prepare("select * from course where status='$status'");
			$get_course->setFetchMode(PDO:: FETCH_ASSOC);
			$get_course->execute();
		}elseif(isset($_POST['course_search'])){
			$user_query=$_POST['user_query'];
			$course_lvl=$_POST['course_lvl'];
			$cat=$_POST['cat'];
			$sub_cat=$_POST['sub_cat'];
			$course_privacy=$_POST['course_privacy'];
			$course_type=$_POST['course_type'];
			$course_lang=$_POST['course_lang'];
			
			$get_course=$con->prepare("select * from course where title like'%$user_query%' AND lvl like'%$course_lvl%' AND cat_id like'%$cat%' AND sub_cat_id like'%$sub_cat%' AND privacy like'%$course_privacy%' AND type like'%$course_type%' AND lang_id like'%$course_lang%' AND status='publish'");
			$get_course->setFetchMode(PDO:: FETCH_ASSOC);
			$get_course->execute();
			$course_count=$get_course->rowCount();
			if($course_count==0){
				echo"<h3>No Record Found With This Critaria</h3>";
			}else{
				echo"<h3>Total $course_count Courses Found</h3>";	
			}
		}
		echo"<table id='course' cellspacing='0'>
				<tr>
					<th>Sr No.</th>
					<th>Details</th>
					<th>Name</th>
					<th>Check Lectures</th>
					<th>Enroll By</th>
					<th>Earning</th>
					<th>Privacy</th>
					<th>Type</th>";
			if(isset($_GET['p_course'])){
				echo"<th>Action</th>";	
			}
			echo"</tr>";
		$i=1;
		while($row=$get_course->fetch()):
			echo"<tr>
					<td>".$i++."</td>
					<td><a href='../course_details.php?course_id=".$row['course_id']."' target='_blank'><i class='fa fa-info-circle' area-hidden='true'></i></a></td>
					<td>".$row['title']."</td>
					<td><a href='lectures.php?course_name=".$row['course_id']."' target='_blank'><i class='fa fa-info-circle' area-hidden='true'></i></a></td>
					<td>".$row['enroll_by']."</td>
					<td>$".$row['total_earn']."</td>
					<td>".$row['privacy']."</)td>
					<td>".$row['type']."</td>";
			if(isset($_GET['p_course'])){
				echo"<td>
						<p><a href='index.php?p_course&active_c' title='Active'><i class='fa fa-check-circle'></i></a></p>
						<p><a style='color:red' href='index.php?p_course&deactive_c' title='DeActive'><i class='fa fa-times-circle'></i></a></p>
					</td>";	
				if(isset($_GET['active_c'])){
					$c_id=$row['course_id'];
					$up_c=$con->prepare("update course set status='Publish' where course_id='$c_id'");	
					if($up_c->execute()){
						echo"<script>alert('Course Activated Successfully');</script>";
						echo"<script>window.open('index.php?a_course','_self');</script>";
					}else{
						echo"<script>alert('Something Wring Try Again')</script>";	
					}
				}
				if(isset($_GET['deactive_c'])){
					$c_id=$row['course_id'];
					$up_c=$con->prepare("update course set status='Unpublish' where course_id='$c_id'");	
					if($up_c->execute()){
						echo"<script>alert('Course Deactivated Successfully');</script>";
						echo"<script>window.open('index.php?u_course','_self');</script>";
					}else{
						echo"<script>alert('Something Wring Try Again')</script>";	
					}
				}
			}
			echo"</tr>";
		endwhile;
		echo"</table>";	
	}
	function course_lecture(){
		include("inc/db.php");
		if(isset($_GET['course_name'])){
			$course_name=$_GET['course_name'];
			
			$get_course_id=$con->prepare("select * from course where course_id='$course_name'");
			$get_course_id->execute();
			$row_course_id=$get_course_id->fetch();
			
			$course_id=$row_course_id['course_id'];
			$get_lec=$con->prepare("select * from c_cur where c_id='$course_id'");
			$get_lec->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lec->execute();
			$lec_count=$get_lec->rowCount();
			$i=1;
			if($lec_count==0){
				echo"<div id='user_course'>
						<center><h3>This Course Dosen't Have Any Lecture</h3></center>
					</div>";
			}else{
				echo"<div id='user_course'>
					<h3>".$row_course_id['title']."</h3><ul>";
				while($row_cur=$get_lec->fetch()):
					echo"<li>
							<p>Lecture ".$i++.": <i class='fa fa-video-camera' aria-hidden='true'></i> ".$row_cur['v_title']."</p><br />
							<details>
								<summary>Watch Video Lecture</summary>
								<center><video controls='controls' src='../lecture/".$row_cur['video']."'></video></center>
							</details>
						</li>";
				endwhile;
				echo"</ul></div>";
			}
		}	
	}
	function user(){
		include("inc/db.php");
		if(isset($_GET['stud'])){
			echo"<h3>View All Students</h3>";
			$get_user=$con->prepare("select * from user");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
		}elseif(isset($_GET['ins'])){
			echo"<h3>View All Teacher</h3>";
			$type="Instructor";
			$get_user=$con->prepare("select * from user where u_type='$type'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
		}elseif(isset($_POST['user_search'])){
			echo"<h3>Advance User Search</h3>";
			$query=$_POST['u_name'];
			$type=$_POST['u_type'];
			$email=$_POST['u_email'];
			$phone=$_POST['u_phone'];
			
			$get_user=$con->prepare("select * from user where u_name like '%$query%' AND u_email like'%$email%' AND u_phone like'%$phone%' AND u_type like'%$type%'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();	
		}elseif(isset($_POST['between_date'])){
			$first_date=$_POST['first_date'];
			$last_date=$_POST['last_date'];
			echo"<h3>User Register Between $first_date To $last_date</h3>";
			
			$get_user=$con->prepare("select * from user where u_reg_date BETWEEN '$first_date' AND '$last_date'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
			$user_count=$get_user->rowCount();
		}
		
		echo"<table cellspacing='0' id='user'>
				<tr>
					<th>Sr No.</th>
					<th>Name</th>
					<th>Image</th>
					<th>Email</th>
					<th>Phone No.</th>";
					if(isset($_GET['ins'])){
						echo"<th>Total Courses</th>
							<th>Total Earn</th>";
					}else{			
						echo"<th>Courses Enroll</th>";
					}
					echo"<th>Added Date</th>
				</tr>";
				$i=1;
				$net_total=0;
				while($row=$get_user->fetch()):
					$u_id=$row['u_id'];
					
					$total_course=$con->prepare("select * from payment where u_id='$u_id'");
					$total_course->setFetchMode(PDO:: FETCH_ASSOC);
					$total_course->execute();
					$row_total=$total_course->rowCount();				
					
					$get_c=$con->prepare("select SUM(total_earn) AS total from course where u_id='$u_id'");
					$get_c->setFetchMode(PDO:: FETCH_ASSOC);
					$get_c->execute();
					$row_c=$get_c->fetch();
					
					$total_course=$con->prepare("select * from course where u_id='$u_id'");
					$total_course->setFetchMode(PDO:: FETCH_ASSOC);
					$total_course->execute();
					$total_course_count=$total_course->rowCount();
					
					echo"<tr>
							<td>".$i++."</td>
							<td>".$row['u_name']."</td>
							<td>";
								if($row['u_img'] !== ""){
									echo"<img src='../imgs/user/".$row['u_img']."' />";
								}else{
									echo"<img src='../imgs/user/default.png' />";
								}
						echo"</td>
							<td>".$row['u_email']."</td>
							<td>".$row['u_phone']."</td>";
							if(isset($_GET['ins'])){
								echo"<td>".$total_course_count."</td>
									<td>$".$row_c['total']."</td>";
							}else{
								echo"<td>".$row_total."</td>";
							}
							echo"<td>".$row['u_reg_date']."</td>	
						</tr>";
				endwhile;
		echo"</table>";
			
	}
	function order(){
		include("inc/db.php");
		if(isset($_GET['pen_ord'])){
			$status='Pending';
			$get_ord=$con->prepare("select ins_id, count(ins_id) from payment where ins_status='$status' group by ins_id order by 1 desc");
			$get_ord->setFetchMode(PDO:: FETCH_ASSOC);
			$get_ord->execute();
			echo"<h3>Pay To Instructor</h3>
				<table cellspacing='0' id='user'>
				<tr>
					<th>Sr No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone No.</th>
					<th>Payable Amount</th>
					<th>Pay</th>
				</tr>";
			$i=1;
			
			while($row=$get_ord->fetch()):
				$ins_id=$row['ins_id'];
				$get_total=$con->prepare("select *,SUM(amt) AS total from payment where ins_status='$status' and ins_id='$ins_id'");
				$get_total->setFetchMode(PDO:: FETCH_ASSOC);
				$get_total->execute();
				$row_total=$get_total->fetch();
				$total=$row_total['total'];
			
				$get_u=$con->prepare("select * from user where u_id='$ins_id'");
				$get_u->setFetchMode(PDO:: FETCH_ASSOC);
				$get_u->execute();
				$row_u=$get_u->fetch();
				echo"<tr>
						<td>".$i++."</td>
						<td>".$row_u['u_name']."</td>
						<td>".$row_u['u_email']."</td>
						<td>".$row_u['u_phone']."</td>
						<td>$".$total."</td>
						<td><a href='payment.php?ins=$ins_id&amt=$total' style='font-size:12px;'>Pay Now</a></td>
					</tr>";
			endwhile;
			echo"</table>";
		}elseif(isset($_GET['comp_ord'])){
			$status='Complete';
			if(isset($_POST['get_order'])){
				$invoice=$_POST['in_no'];
				$f_date=$_POST['f_date'];
				$l_date=$_POST['l_date'];
				if(empty($invoice) && empty($f_date) && empty($l_date)){
					echo"<script>alert('Please Select Atleast One Input')</script>";
					echo"<script>window.open('index.php?comp_ord','_self')</script>";
				}else{
					if(empty($f_date) && !empty($l_date)){
						echo"<script>alert('Please Select First Date')</script>";
					}elseif(empty($l_date) && !empty($f_date)){
						echo"<script>alert('Please Select Second Date')</script>";
					}else{
						$get_ord=$con->prepare("select * from ins_payment where invoice_id='$invoice' or date BETWEEN '$f_date' AND '$l_date' order by 1 desc");
						$get_ord->setFetchMode(PDO:: FETCH_ASSOC);
						if($get_ord->execute()){}else{echo"<script>alert('No Record Found')</script>";}
					}
				}
			}else{
				$get_ord=$con->prepare("select * from ins_payment order by 1 desc");
				//$get_ord->bindParam(":pending",$status);
				$get_ord->setFetchMode(PDO:: FETCH_ASSOC);
				$get_ord->execute();
			}
			
			echo"<h3>Complete Payment</h3>
				<form method='post' id='order_form'>
					<input type='text' name='in_no' pattern='[0-9]{5,15}' placeholder='Search By Invoice No.' />
					<label>Order Between</label> 
					<input type='date' name='f_date' />
					<label>To</label>
					<input type='date' name='l_date' />
					<button name='get_order'>Get Order</button>
				</form>
				<table cellspacing='0' id='user'>
				<tr>
					<th>Sr No.</th>
					<th>Invoice No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone No.</th>
					<th>Amount</th>
					<th>Payment Date</th>
				</tr>";
			$i=1;	
			while($row=$get_ord->fetch()):
				$u_id=$row['ins_id'];
				$get_u=$con->prepare("select * from user where u_id='$u_id'");
				$get_u->setFetchMode(PDO:: FETCH_ASSOC);
				$get_u->execute();
				$row_u=$get_u->fetch();
				echo"<tr>
						<td>".$i++."</td>
						<td>".$row['invoice_id']."</td>
						<td>".$row_u['u_name']."</td>
						<td>".$row_u['u_email']."</td>
						<td>".$row_u['u_phone']."</td>
						<td>$".$row['amt']."</td>
						<td>".$row['date']."</td>
					</tr>";
			endwhile;
			echo"</table>";
		}
	}
	function pay_process(){
		include("inc/db.php");
		if(isset($_GET['ins'])){
			$ins_id=$_GET['ins'];
			$total_amt=$_GET['amt'];
			
			$get_u=$con->prepare("select * from user where u_id='$ins_id'");
			$get_u->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u->execute();
			$row_u=$get_u->fetch();
			
			echo"<center><form action='https://www.paypal.com/cgi-bin/webscr' method='post'>

				  <!-- Identify your business so that you can collect the payments. -->
				  <input type='hidden' name='business' value='".$row_u['u_email']."'>

				  <!-- Specify a Buy Now button. -->
				  <input type='hidden' name='cmd' value='_xclick'>

				  <!-- Specify details about the item that buyers will purchase. -->
				  <input type='hidden' name='item_name' value='Amount Payable'>
				  <input type='hidden' name='amount' value='$total_amt'>
				  <input type='hidden' name='currency_code' value='USD'>

				  <input type='hidden' name='return' value='http://127.0.0.1/Elearning/admin/payment_success.php?pay_id=$ins_id&pay_amt=$total_amt' />
				  <input type='hidden' name='cencle_return' value='http://127.0.0.1/Elearning/admin/payment_cancel.php' />

				  <!-- Display the payment button. -->
				  <input type='image' name='submit' border='0' src='../imgs/web_imgs/paypal.png' style='height:40px; width:200px; object-fit:contain; margin:20px; border:1px solid #000' alt='Buy Now'>
				  <img alt='' border='0' width='1' height='1' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' >
				</form>
				</center>";
		}
	}
	function paypal(){
		include("inc/db.php");
		if(isset($_GET['pay_id'])){
			$ins_id=$_GET['pay_id'];
			$amt=$_GET['pay_amt'];
			$date=date("Y-m-d");
			$status='Pending';
			$invoice=substr(mt_rand(),0,10);
			$get_ord=$con->prepare("select * from payment where ins_status='$status' AND ins_id='$ins_id'");
			$get_ord->setFetchMode(PDO:: FETCH_ASSOC);
			$get_ord->execute();
			while($row_ord=$get_ord->fetch()):
				$up_ord=$con->prepare("update payment set ins_status='Complete' where ins_id='$ins_id'");
				$up_ord->execute();
			endwhile;
			$add_ord=$con->prepare("insert into ins_payment(ins_id,invoice_id,amt,date)values('$ins_id','$invoice','$amt','$date')");
			$add_ord->execute();
		
				echo"<script>window.open('index.php?comp_ord','_self')</script>";
		
		}
	}
	function all_lang(){
		include("inc/db.php");
		$get_cat=$con->prepare("select * from lang order by 1 desc");
		$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cat->execute();
		$i=1;
		while($row=$get_cat->fetch()):
			echo"<tr>
					<td>".$i++."</td>
					<td>".$row['lang_name']."</td>
					<td><a style='color:#06f; display:block' href='index.php?view_lang&edit_lang=".$row['lang_id']."'><i class='fa fa-edit' area-hidden='true'></i></a></td>
					<td><a style='color:#f06; display:block' href='index.php?view_lang&del_lang=".$row['lang_id']."'><i class='fa fa-trash' area-hidden='true'></i></a></td>
				</tr>";
		endwhile;	
	}
	function add_lang(){
		include("inc/db.php");
		if(isset($_POST['add_lang'])){
			$lang_name=$_POST['lang_name'];

			if(!preg_match("/^[a-zA-Z]+$/", $lang_name)){
                echo "<script>alert('Language name should only contain letters.')</script>";
                echo "<script>window.open('index.php?lang','_self')</script>";
                return;
            }

			$check=$con->prepare("select * from lang where lang_name='$lang_name'");
			$check->setFetchMode(PDO:: FETCH_ASSOC);
			$check->execute();
			$count=$check->rowCount();

			if($count==1){
				echo"<script>alert('Language Already Added')</script>";
			}else{
				$add_cat=$con->prepare("insert into lang(lang_name)values('$lang_name')");
				
				if($add_cat->execute()){
					echo"<script>alert('Language Added Successfully');</script>";
					header("Location:index.php?view_lang");
				}
				else{
					echo"<script>alert('Language Not Added Successfully');</script>";	
				}
			}
		}
	}
	function del_lang(){
		include("inc/db.php");
		if(isset($_GET['del_lang'])){
			$delete_id=$_GET['del_lang'];
			$delete_cat=$con->prepare("delete from lang where lang_id='$delete_id'");
			if($delete_cat->execute()){
				echo"<script>alert('Language Deleted Successfully');</script>";
				echo"<script>window.open('index.php?view_lang','_self');</script>";	
			}
		}	
	}
	function edit_lang(){
		include("inc/db.php");
		if(isset($_GET['edit_lang'])){
			$cat_id=$_GET['edit_lang'];
			$get_cat=$con->prepare("select * from lang where lang_id='$cat_id'");
			$get_cat->execute();
			
			$row_cat=$get_cat->fetch();
			echo"<form method='post' id='edit_form'>
					<h3>Edit Language</h3>
					<table cellspacing='0'>
						<tr>
							<td>Update Category</td>
							<td><input type='text' name='up_lang_name' value='".$row_cat['lang_name']."' required /></td>
						</tr>
					</table>
					<center>
						<button name='up_lang'>Save</button>
						<button><a href='index.php?view_lang'>Cancle</a></button>
					</center>	
				</form>";
				
			if(isset($_POST['up_lang'])){
				$cat_name=$_POST['up_lang_name'];
				$up_cat=$con->prepare("update lang set lang_name='$cat_name' where lang_id='$cat_id'");

				if($up_cat->execute()){
					echo"<script>alert('Language Updated Successfully')</script>";	
					echo"<script>window.open('index.php?view_lang','_self');</script>";
				}
				else{
					echo"<script>alert('Something Wrong Please Try Again !!!')</script>";	
				}
			}
		}	
	}
?>