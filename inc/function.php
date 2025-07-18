<?php
	function getIp(){
		$ip = $_SERVER['REMOTE_ADDR'];
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $ip;
	}
	function search(){
		include("inc/db.php");
		if(isset($_POST['search'])){
			$u_query=$_POST['user_query'];
			$status="publish";
			$privacy="public";
			$search=$con->prepare("select * from course where title like '%$u_query%' AND status='$status' AND privacy='$privacy'");
			$search->setFetchMode(PDO:: FETCH_ASSOC);
			$search->execute();
			$search_count=$search->rowCount();

			echo"<p>Total $search_count Course Found Related <span style='background:#0c9; color:#fff'>$u_query</span> Keyword</p><br /><ul>";
			while($row=$search->fetch()):
				$id=$row['u_id'];
				$get_user=$con->prepare("select * from user where u_id='$id'");
				$get_user->setFetchMode(PDO:: FETCH_ASSOC);
				$get_user->execute();
				$row_user=$get_user->fetch();
				echo"<li>
						<a href='course_details.php?course_id=".$row['course_id']."'>
							<div id='discount'>".$row['dis']." Off</div>";
							if($row['img']==""){
								echo"<img src='imgs/courses/default.jpg' />";
							}else{
								echo"<img src='imgs/courses/".$row['img']."' />";
							}
							echo"<p>".$row['title']."</p>
							<h4>Price : $".$row['dis_price']."</h4>
							<h5>Teacher : ".$row_user['u_name']."</h5>
						</a>
					</li>";
			endwhile;
			echo"</ul>";
		}
	}
	function cat_menu(){
		include("inc/db.php");
		$get_cat=$con->prepare("select * from cat");
		$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cat->execute();
		
		echo"<ul>";
		while($row=$get_cat->fetch()):
			$cat_id=$row['cat_id'];
			$status="publish";
			$privacy="public";
			$check_course=$con->prepare("select * from course where cat_id='$cat_id' AND privacy='$privacy' AND status='$status'");
			$check_course->execute();
			$cat_course_count=$check_course->rowCount();
			if($cat_course_count>0){
				echo"<li><a href='category.php?cat=".$row['cat_id']."'>".$row['cat_icon']." ".$row['cat_name']."</a>
						<ul id='sub_nav'>";
							$sub_cat=$con->prepare("select * from sub_cat where cat_id='$cat_id'");
							$sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
							$sub_cat->execute();
							while($row_sub=$sub_cat->fetch()):
								$sub_cat_id=$row_sub['sub_cat_id'];
								$check_sub_course=$con->prepare("select * from course where sub_cat_id='$sub_cat_id' AND privacy='$privacy' AND status='$status'");	
								$check_sub_course->execute();
								$sub_cat_course_count=$check_sub_course->rowCount();
								if($sub_cat_course_count>0){
									echo"<li><a href='category.php?sub_cat=$sub_cat_id'>".$row_sub['sub_cat_icon']." ".$row_sub['sub_cat_name']."</a></li>";
								}else{}
							endwhile;
						echo"</ul>
					</li>";
			}else{}
        endwhile;
		echo"</ul>";	
	}
	function home_cat_part(){
		include("inc/db.php");
		$get_cat=$con->prepare("select * from cat");
		$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cat->execute();
		$status="publish";
		$privacy="public";
		echo"<ul>";
		while($row=$get_cat->fetch()):
			$cat_id=$row['cat_id'];
			$get_c=$con->prepare("select * from course where cat_id='$cat_id' AND privacy='$privacy' AND status='$status'");
			$get_c->execute();
			$row_c=$get_c->rowCount();
			echo"<li>
					<a href='category.php?cat=$cat_id'>
						<center>
							<h2>".$row['cat_icon']."</h2>
							<b>".$row['cat_name']."</b>
							<p>".$row_c."</p>
						</center>
					</a>
				</li>";
		endwhile;
		echo"</ul>";	
	}
	function home_page_course(){
		include("inc/db.php");
		$status="publish";
		$privacy="public";
		$fetch_course=$con->prepare("select * from course where status='$status' AND privacy='$privacy'");
		$fetch_course->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_course->execute();
		
		while($row=$fetch_course->fetch()):
			$id=$row['u_id'];
			$get_user=$con->prepare("select * from user where u_id='$id'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
			$row_user=$get_user->fetch();
			echo"<li>
					<a href='course_details.php?course_id=".$row['course_id']."'>";
						if($row['dis'] == ''){}elseif($row['dis'] !== ''){
							echo"<div id='discount'>".$row['dis']." Off</div>";
						}elseif($row['type'] == 'Free'){
							echo"<div id='discount'>Free</div>";
						}
						
						if($row['img']==""){
							echo"<img src='imgs/courses/default.jpg' />";
						}else{
							echo"<img src='imgs/courses/".$row['img']."' />";
						}
						echo"<p>".$row['title']."</p>";
						if($row['mrp_price'] == ''){
							echo"<h4>Free</h4>";
						}else{
							echo"<h4>Price : $".$row['dis_price']."</h4>";
						}
					echo"<h5>Teacher : ".$row_user['u_name']."</h5>";
				echo"</a>
				</li>";
		endwhile;	
	}
	function web_link(){
		include("inc/db.php");
		$get=$con->prepare("select * from contact_us");
		$get->setFetchMode(PDO:: FETCH_ASSOC);
		$get->execute();
		$row=$get->fetch();
		echo"<span><a href='https://www.facebook.com/".$row['fb']."'><i class='fa fa-facebook' aria-hidden='true'></i></a></span>
            <span><a href='https://www.twitter.com/".$row['tw']."'><i class='fa fa-twitter' aria-hidden='true'></i></a></span>
            <span><a href='https://www.plus.google.com/".$row['gp']."'><i class='fa fa-google-plus' aria-hidden='true'></i></a></span>
            <span><a href='https://www.youtube.com/".$row['yt']."'><i class='fa fa-youtube' aria-hidden='true'></i></a></span>
			<span><a href='https://www.linkedin.com/".$row['li']."'><i class='fa fa-linkedin' aria-hidden='true'></i></a></span>";
	}
	function h_link(){
		include("inc/db.php");
		if(isset($_SESSION['email_u'])){
			$email=$_SESSION['email_u'];
			$type="Instructor";
			$get_user=$con->prepare("select u_type from user where u_email='$email'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
			$row=$get_user->fetch();
			$ins=$row['u_type'];
			if($type==$ins){
				echo"<a href='teacher.php'><i class='fa fa-state' aria-hidden='true'></i> DashBoard</a>";
			}else{
				echo"<a href='teacher_rules.php'><i class='fa fa-user-plus' aria-hidden='true'></i> <span>Become</span> Teacher</a>";
			}
		}
	}
	function rules(){
		include("inc/db.php");
		echo"<div id='about'>
				<h3>Rules And Ragulations For Instructors</h3>";
				$get_about=$con->prepare("select * from terms where term_type='instructor'");
				$get_about->setFetchMode(PDO:: FETCH_ASSOC);
				$get_about->execute();
				$i=1;
				while($row=$get_about->fetch()):
					echo "<p>".$i++." ".$row['term']."</p>";
				endwhile;
				if(!isset($_SESSION['email_u'])){}else{
					$email=$_SESSION['email_u'];
					$get=$con->prepare("select * from user where u_email='$email'");					
					$get->setFetchMode(PDO:: FETCH_ASSOC);
					$get->execute();
					$row_check=$get->fetch();
					$type=$row_check['u_type'];
					if($type=="Instructor"){}else{
						echo"<h3>Want To Become Instructor ?</h3>
							<form method='post'>
								<input type='checkbox' name='agree' value='Instructor' required /> 
								<span>I Accept All The Terms And Conditions</span><br /><br />
								<button name='terms'>I Accept</button>
							</form>";
					}
				}
				echo"<h3>Rules And Ragulations For Students</h3>";
				$get_stud=$con->prepare("select * from terms where term_type='student'");
				$get_stud->setFetchMode(PDO:: FETCH_ASSOC);
				$get_stud->execute();
				$j=1;
				while($row_stud=$get_stud->fetch()):
					echo "<p>".$j++." ".$row_stud['term']."</p>";
				endwhile;
		echo"</div><br clear='all' />";	
	}
	function become_ins(){
		include("inc/db.php");
		
		if(isset($_POST['terms'])){
			$ins=$_POST['agree'];
			$u_email=$_SESSION['email_u'];
			$become_ins=$con->prepare("update user set u_type='$ins' where u_email='$u_email'");
			if($become_ins->execute()){
				//start get u_id
				$get_user=$con->prepare("select * from user where u_email='$u_email'");
				$get_user->setFetchMode(PDO:: FETCH_ASSOC);
				$get_user->execute();
				$row_user=$get_user->fetch();
				$u_id=$row_user['u_id'];
				//end get u_id
				$web="";
				$add_links=$con->prepare("insert into ins_links(u_id,fb_ins,gp_ins,li_ins,yt_ins,twitt_ins,web)values('$u_id','$web','$web','$web','$web','$web','$web')");
				
				$add_links->execute();
				echo"<script>alert('Congo You Are Now Instructor')</script>";
				echo"<script>window.open('teacher.php','_self');</script>";	
			}
			else{
				echo"<script>alert('Something Wrong Try Again‌')</script>";
				exit();
			}	
		}	
	}
	function signup(){
		include("inc/db.php");
		if(isset($_POST['signup'])){
			$name=$_POST['u_name'];
			$email=$_POST['u_email'];
			$phone=$_POST['u_phone'];
			$pass1=$_POST['u_pass1'];
			$pass2=$_POST['u_pass2'];
			$other="";
			$ip=getIp();
			$type="Student";
			$get_email=$con->prepare("select u_email from user where u_email='$email'");
			$get_email->setFetchMode(PDO:: FETCH_ASSOC);
			$get_email->execute();
			$row_email=$get_email->rowCount();
			if($pass1 !== $pass2){
				echo"<script>alert('Password Not Metched')</script>";
			}elseif(strlen($pass1<8)){
				echo"<script>alert('Enter Above 8 Digit Password')</script>";	
			}elseif($row_email == 1){
				echo"<script>alert('Email Is Already Registered Try Different Email!!!')</script>";
			}else{
				$add_user=$con->prepare("insert into user(u_name,u_email,u_phone,u_pass,u_img,u_desig,u_bio,u_head,u_ip,u_reg_date,u_type)values('$name','$email','$phone','$pass2','$other','$other','$other','$other','$ip',NOW(),'$type')");
				 if($add_user->execute()){
					echo"<script>alert('Registration Success')</script>";
					echo"<script>window.open('index.php','_self')</script>";	
				}
				else{
					echo"<script>alert('Please Try Again')</script>";
				}
			}	
		}	
	}
	function login(){
		include("inc/db.php");
		if(isset($_POST['login'])){
			$email=$_POST['u_log'];
			$pass=$_POST['u_log_pass'];
		
			$login=$con->prepare("select * from user where u_email='$email' AND u_pass='$pass'");
			$login->setFetchMode(PDO:: FETCH_ASSOC);
			$login->execute();
			$rows=$login->fetch();
			$u_id=$rows['u_id'];
			$count=$login->rowCount();

			if($count==1){
				$ip=getIp();
				$_SESSION['email_u']=$email;
				$cart_to_user=$con->prepare("select * from cart where ip_add='$ip'");
				$cart_to_user->setFetchMode(PDO:: FETCH_ASSOC);
				$cart_to_user->execute();
				while($row_cart=$cart_to_user->fetch()):
					$course_id=$row_cart['course_id'];
					$check_u_cart=$con->prepare("select * from user_cart where course_id='$course_id' AND ip_add='$ip' AND u_id='$u_id'");
					$check_u_cart->setFetchMode(PDO:: FETCH_ASSOC);
					$check_u_cart->execute();

					if($check_u_cart->rowCount()==1){
						$delete_cart=$con->prepare("delete from cart where ip_add='$ip'");
						$delete_cart->execute();	
					}
					else{
						$fetch_user_cart=$con->prepare("select * from user_cart where ip_add='$ip' AND u_id='$u_id'");
						$fetch_user_cart->setFetchMode(PDO:: FETCH_ASSOC);
						$fetch_user_cart->execute();
						$check_user_cart=$fetch_user_cart->rowCount();
						if($check_user_cart==3){}
						else{
							$check_user=$con->prepare("select * from course where course_id='$course_id'");
							$check_user->setFetchMode(PDO:: FETCH_ASSOC);
							$check_user->execute();
							$row_get_u_id=$check_user->fetch();
							$user_id=$row_get_u_id['u_id'];
							if($user_id!=$u_id){
								$check_pay=$con->prepare("select * from payment where course_id='$course_id' AND u_id='$u_id'");
								$check_pay->setFetchMode(PDO:: FETCH_ASSOC);
								$check_pay->execute();
								$row_pay=$check_pay->rowCount();

								if($row_pay==1){
									$delete_course=$con->prepare("delete from user_cart where course_id='$course_id' AND u_id='$user_id'");	
									$delete_course->execute();
								}else{
									$insert_to_user_cart=$con->prepare("insert into user_cart(u_id,course_id,ip_add)values('$u_id','$course_id','$ip')");
									$insert_to_user_cart->execute();
								}
							}
							else{
								$delete_course=$con->prepare("delete from user_cart where course_id='$course_id' AND u_id='$user_id'");	
								$delete_course->execute();
							}
						}		
						$delete_cart=$con->prepare("delete from cart where ip_add='$ip'");
						$delete_cart->execute();
					}
					endwhile;
				//end of cart process
				header("Location:".$_SESSION['redirectURL']."");
				exit();
			}else{
				echo"<script>alert('Email Or Password Is Not Correct')</script>";
			}
		}	
	}
	function cart_count(){
		include("inc/db.php");
		$ip=getIp();
		if(!isset($_SESSION['email_u'])){
			$get_cart=$con->prepare("select * from cart where ip_add='$ip'");
			$get_cart->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cart->execute();
			$count=$get_cart->rowCount();	
			echo $count;
		}
		else{
			$u_email=$_SESSION['email_u'];
			$get_user=$con->prepare("select * from user where u_email='$u_email'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
			$row_user=$get_user->fetch();
			$u_id=$row_user['u_id'];
		
			$get_user_cart=$con->prepare("select * from user_cart where ip_add='$ip' AND u_id='$u_id'");
			$get_user_cart->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user_cart->execute();
			$user_count=$get_user_cart->rowCount();
			
			echo $user_count;	
		}
	}	
	function course_details(){
		if(isset($_GET['course_id'])){
			include("inc/db.php");
			$c_id=$_GET['course_id'];
			
			$get_c_details=$con->prepare("select * from course where course_id='$c_id'");
			$get_c_details->setFetchMode(PDO:: FETCH_ASSOC);
			$get_c_details->execute();
			$row=$get_c_details->fetch();
			
			$cat_id=$row['cat_id'];
			$sub_cat_id=$row['sub_cat_id'];
			$u_id=$row['u_id'];
			$lang_id=$row['lang_id'];
			$c_name=$row['title'];
			$mrp_price=$row['mrp_price'];
			$sell_price=$row['dis_price'];
			$dis=$row['dis'];
			
			if($sell_price == ''){
				$total_save = '';
			}else{
				$total_save=$mrp_price-$sell_price;
			}
			
			$get_user=$con->prepare("select * from user where u_id='$u_id'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
			$row_email=$get_user->fetch();
			$u_email=$row_email['u_email'];
			
			$get_u_links=$con->prepare("select * from ins_links where u_id='$u_id'");
			$get_u_links->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u_links->execute();
			$row_links=$get_u_links->fetch();
			
			$get_lang=$con->prepare("select * from lang where lang_id='$lang_id'");
			$get_lang->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lang->execute();
			$row_lang=$get_lang->fetch();
			
			$get_cat_name=$con->prepare("select * from cat where cat_id='$cat_id'");
			$get_cat_name->setFetchmode(PDO:: FETCH_ASSOC);
			$get_cat_name->execute();
			$row_cat_name=$get_cat_name->fetch();
			
			$get_sub_cat_name=$con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
			$get_sub_cat_name->setFetchmode(PDO:: FETCH_ASSOC);
			$get_sub_cat_name->execute();
			$row_sub_cat_name=$get_sub_cat_name->fetch();
			
			$get_lec=$con->prepare("select * from c_cur where c_id='$c_id'");
			$get_lec->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lec->execute();
			$row_lec=$get_lec->rowCount();
			
			echo"<div id='crumb'>
					<p>
						<a href='index.php'>Home</a> <span>></span> 
						<a href='category.php?cat=".$row_cat_name['cat_id']."'>".$row_cat_name['cat_name']."</a> <span>></span>
						<a href='category.php?sub_cat=".$row_sub_cat_name['sub_cat_id']."'>".$row_sub_cat_name['sub_cat_name']."</a> <span>></span>
						".$c_name."
					</p>
				</div>
				<div id='course_left'>
					<img src='imgs/courses/".$row['img']."' />
					<h1>".$c_name."</h1>
					<div id='share'>
						<div id='f'>
							<a href='http://www.facebook.com/sharer.php?u=http://127.0.0.1/product?product=1' title='Facebook Share' target='_blank'><i class='fa fa-facebook' aria-hidden='true'></i> Share</a>
						</div>
						<div id='g'>
							<a href='http://plus.google.com/share?url=' target='_blank' title='Google Plus Share'><i class='fa fa-google-plus' aria-hidden='true'></i> Share</a>
						</div>
						<div id='t'>
							<a href='https://twitter.com/intent/tweet?text=Check Out This At' target='_blank' title='Twitter Tweet'><i class='fa fa-twitter' aria-hidden='true'></i> Tweet</a>
						</div>
						<div id='wp'>
							<a href='whatsapp://send?text=pro_name Pro_id' target='_blank'><i class='fa fa-whatsapp' aria-hidden='true'></i> Share</a>
						</div>
					</div>
				</div>
				<div id='course_right'>
					<h1>".$c_name."</h1>
					<table>
						<tr><td>Instructor</td> <td>".$row_email['u_name']."</td></tr>
						<tr><td>Enroll By</td> <td>".$row['enroll_by']." Students</td></tr>
						<tr><td>Lavel</td> <td>".$row['lvl']."</td></tr>
						<tr><td>Language</td> <td>".$row_lang['lang_name']."</td></tr>
						<tr><td>Lectures</td> <td>".$row_lec."</td></tr>
					</table>
					<div id='price'>";
						if($sell_price == ''){
							echo"<p><b>Free</b></p><br clear='all' />";
						}else{
							if($dis == ''){
								echo"<p><b>Price : $".$row['dis_price']."</b></p><br clear='all' />";
							}else{
								echo"<p><b>Price : $".$row['dis_price']." <span>$".$row['mrp_price']."</span></b></p>
								<label>".$row['dis']." </label>
								<p><b>Saving $".$total_save."</p><br clear='all' />";
							}
						}
				echo"</div>";
					if(isset($_SESSION['email_u'])){
						if($_SESSION['email_u'] == $u_email){}
						else{
							echo"<form method='post'>";
								if($row['mrp_price'] == '' && $row['type'] == 'Free'){}else{
								echo"<button name='cart'><i class='fa fa-shopping-cart' area-hidden='true'></i> Add To Cart</button>";
								}
								echo"<button name='buy'><i class='fa fa-bolt' area-hidden='true'></i> Buy Now</button>
								</form>";
						}
					}else{
						echo"<form method='post'>";
								if($row['mrp_price'] == '' && $row['type'] == 'Free'){}else{
								echo"<button name='cart'><i class='fa fa-shopping-cart' area-hidden='true'></i> Add To Cart</button>";
								}
							echo"<button name='buy'><i class='fa fa-bolt' area-hidden='true'></i> Buy Now</button>
							</form>";	
					}
					//start add to cart
					if(isset($_POST['cart'])){
						$ip=getIp();
						if(!isset($_SESSION['email_u'])){
							$check_item=$con->prepare("select * from cart where ip_add='$ip' AND course_id='$c_id'");
							$check_item->setFetchMode(PDO:: FETCH_ASSOC);
							$check_item->execute();
							$check_cart_item=$check_item->rowCount();
								
							if($check_cart_item==1){
								echo"<script>alert('Course Is Already Added In Your Cart')</script>";	
							}
							else{
								$fetch_cart=$con->prepare("select * from cart where ip_add='$ip'");
								$fetch_cart->setFetchMode(PDO:: FETCH_ASSOC);
								$fetch_cart->execute();
								$check_cart=$fetch_cart->rowCount();
								if($check_cart==3){
									echo"<script>alert('You Cannot Add More Than 3 Courses In Your Cart');</script>";	
								}
								else{
									$insert=$con->prepare("insert into cart(course_id,ip_add)values('$c_id','$ip')");	
									if($insert->execute()){
										echo"<script>window.open('index.php','_self');</script>";
									}
									else{
										echo"<script>alert('Something Wrong Try Again‌')</script>";	
									}
								}
							}
						}
						else{
							$email=$_SESSION['email_u'];
							$get_user=$con->prepare("select * from user where u_email='$email'");
							$get_user->setFetchMode(PDO:: FETCH_ASSOC);
							$get_user->execute();
							$row_user=$get_user->fetch();
							$user_id=$row_user['u_id'];
							
							$check_user_item=$con->prepare("select * from user_cart where ip_add='$ip' AND course_id='$c_id'");
							$check_user_item->setFetchMode(PDO:: FETCH_ASSOC);
							$check_user_item->execute();
							$check_user_cart_item=$check_user_item->rowCount();
								
							if($check_user_cart_item==1){
								echo"<script>alert('Course Is Already Added In Your Cart')</script>";	
							}
							else{								
								$fetch_user_cart=$con->prepare("select * from user_cart where ip_add='$ip' AND u_id='$user_id'");
								$fetch_user_cart->setFetchMode(PDO:: FETCH_ASSOC);
								$fetch_user_cart->execute();
								$check_user_cart=$fetch_user_cart->rowCount();
								if($check_user_cart==10){
									echo"<script>alert('You Cannot Add More Than 10 Courses In Your Cart');</script>";	
								}
								else{
									$check_course=$con->prepare("select * from payment where course_id='$c_id' AND u_id='$user_id'");
									$check_course->setFetchMode(PDO:: FETCH_ASSOC);
									$check_course->execute();
									$row_check_course=$check_course->rowCount();
									
									if($row_check_course==1){
										echo"<script>alert('You Already Buy This Course');</script>";	
									}
									else{
										$insert_user_cart=$con->prepare("insert into user_cart(course_id,ip_add,u_id)values('$c_id','$ip','$user_id')");
										if($insert_user_cart->execute()){
											echo"<script>window.open('index.php','_self');</script>";	
										}
										else{
											echo"<script>alert('Something Wrong Try Again')</script>";	
										}
									}
								}
							}	
						}
					}
					//end add to cart
					if(isset($_POST['buy'])){
						if(!isset($_SESSION['email_u'])){
							echo"<script>alert('Please Login Or Signup')</script>";	
						}else{
							$email=$_SESSION['email_u'];
							$get_user=$con->prepare("select * from user where u_email='$email'");
							$get_user->setFetchMode(PDO:: FETCH_ASSOC);
							$get_user->execute();
							$row_user=$get_user->fetch();
							$user_id=$row_user['u_id'];

							$check_buy=$con->prepare("select * from payment where course_id='$c_id' AND u_id='$user_id'");
							$check_buy->execute();

							$row_course_buy=$check_buy->rowCount();
							if($row_course_buy==1){
								echo"<script>alert('You Already Buy This Course')</script>";
							}else{
								if($row['mrp_price'] == '' && $row['type']=='Free'){
									$amt=$row['dis_price'];
									$course_id=$row['course_id'];
									$user_id=$row_user['u_id'];
									$trx_id="UNI".mt_rand()."NQU";
									$currency_code = "Free";
									$complete="Complete";
									$type="Free";
									$ip=getIp();
									$earn=$row['total_earn'];
									$course_price=$row['dis_price'];
									if($row['mrp_price']==''){}else{
										$total_earn=$earn+$course_price;
									}
									$today=date("Y-m-d");
									$ins_id=$row['u_id'];
									
									$sqls="insert into payment(amt,course_id,u_id,trx_id,ins_id,currency,payment_date,ins_status,user_status,payment_type,ip_add)
									values(:amt,:course_id,:u_id,:trx_id,:ins_id,:currency,:today,:pending,:complete,:type,:ip)";
									$add_to_payment=$con->prepare($sqls, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
									$add_to_payment->bindParam(":amt",$amt);
									$add_to_payment->bindParam(":course_id",$course_id);
									$add_to_payment->bindParam(":u_id",$user_id);
									$add_to_payment->bindParam(":trx_id",$trx_id);
									$add_to_payment->bindParam(":ins_id",$ins_id);
									$add_to_payment->bindParam(":currency",$currency_code);
									$add_to_payment->bindParam(":today",$today);
									$add_to_payment->bindParam(":pending",$complete);
									$add_to_payment->bindParam(":complete",$complete);
									$add_to_payment->bindParam(":type",$type);
									$add_to_payment->bindParam(":ip",$ip);
									$add_to_payment->execute();

									$sqli="update course set enroll_by=enroll_by+1 where course_id=:course_id";
									$enroll_up=$con->prepare($sqli, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
									$enroll_up->bindParam(":course_id",$course_id);
									$enroll_up->execute();
									if($row['mrp_price']==''){}else{
										$plsql="update course set total_earn=:total_earn where course_id=:course_id";
										$up_total_earn=$con->prepare($plsql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
										$up_total_earn->bindParam(":course_id",$course_id);
										$up_total_earn->bindParam(":total_earn",$total_earn);
										$up_total_earn->execute();
									}
									echo"<script>window.open('profile.php?my_course','_self')</script>";
								}else{
									echo"<script>window.open('checkout.php?sin_buy=$c_id','_self')</script>";
								}
							}
						}	
					}	
			echo"</div><br clear='all' />
				<div id='detail_left'>
					<h2>Course Details</h2>
					<p>".$row['c_desc']."</p>
					<h2>What Will I Learn ?</h2>
					<p>".$row['at_end']."</p>
					<h2>Before Starting</h2>
					<p>".$row['skill']."</p>
					<h2>Instructor</h2>
					<img src='imgs/user/".$row_email['u_img']."' />
					<p id='ins_det'>".$row_email['u_bio']."</p>
					<div id='ins_share'>
						<div id='f'>
							<a href='https://www.facebook.com/".$row_links['fb_ins']."' title='Facebook Share' target='_blank'><i class='fa fa-facebook' aria-hidden='true'></i></a>
						</div>
						<div id='g'>
							<a href='https://plus.google.com/".$row_links['gp_ins']."' target='_blank' title='Google Plus Share'><i class='fa fa-google-plus' aria-hidden='true'></i></a>
						</div>
						<div id='t'>
							<a href='https://twitter.com/".$row_links['twitt_ins']."' target='_blank' title='Twitter Tweet'><i class='fa fa-twitter' aria-hidden='true'></i></a>
						</div>
						<div id='y'>
							<a href='https://www.youtube.com/".$row_links['yt_ins']."' target='_blank'><i class='fa fa-youtube' aria-hidden='true'></i></a>
						</div>
						<div id='web'>
							<a href='".$row_links['web']."' target='_blank'><i class='fa fa-globe' aria-hidden='true'></i></a>
						</div>
					</div><br clear='all' />
					<h2>Curriculum</h2>
					<ul>";
						$i=1;
						while($row_l=$get_lec->fetch()):
							echo"<li><i class='fa fa-video-camera' area-hidden='true'></i> ".$i++.". ".$row_l['v_title']."</li>";
						endwhile;
					echo"</ul>
					<div id='course_start'>
						<br /><h1>Comments</h1><br />
						<table>";
							$get_cmt=$con->prepare("select * from comments where course_id='$c_id' ORDER BY 1 DESC");
							$get_cmt->setFetchMode(PDO:: FETCH_ASSOC);
							$get_cmt->execute();
							while($row_cmt=$get_cmt->fetch()):
								$cmt_img=$row_cmt['u_id'];

								$get_cmt_user=$con->prepare("select * from user where u_id='$cmt_img'");
								$get_cmt_user->setFetchMode(PDO:: FETCH_ASSOC);
								$get_cmt_user->execute();

								while($row_finle_img=$get_cmt_user->fetch()):
								echo"<tr>
										<td>";
										if($row_finle_img['u_img']==""){
											echo"<img style='object-fit: cover; object-position:top center; box-shadow:none' src='imgs/user/default.png' />";
										}else{
											echo"<img style='object-fit: cover; object-position:top center; box-shadow:none' src='imgs/user/".$row_finle_img['u_img']."' />";
										}
									echo"</td>
										<td><b>".$row_finle_img['u_name']."</b><p>".$row_cmt['comment']."</p></td>
									</tr>";
								endwhile;
							endwhile;
					echo"</table>
					</div>
				</div>
				<div id='detail_right'>
					<h2>Related Courses</h2>
					<ul>";
						$type="paid";
						$status="publish";
						$privacy="public";
						$get_c=$con->prepare("select * from course where cat_id='$cat_id' AND course_id!='$c_id' AND type='$type' AND privacy='$privacy' AND status='$status'");
						$get_c->setFetchMode(PDO:: FETCH_ASSOC);
						$get_c->execute();
						while($row_rel=$get_c->fetch()):
							echo"<li>
								<a href='course_details.php?course_id=".$row_rel['course_id']."'>
									<img src='imgs/courses/".$row_rel['img']."' />
									<p>".$row_rel['title']."</p>
								</a>
							</li>";
						endwhile;
					echo"</ul>
				</div><br clear='all' />";
		}
	}
	function cart(){
		include("inc/db.php");
		$ip=getIp();
		if(!isset($_GET['mul_buy'])){
		echo"<div id='crumb'>
				<p>
					<a href='index.php'>Home</a> <span>></span> 
					My Cart
				</p>
			</div>";
		}else{
		echo"<div id='crumb'>
				<p>
					<a href='index.php'>Home</a> <span>></span> 
					<a href='cart.php'>My Cart</a> <span>></span>
					Checkout
				</p>
			</div>";	
		}
		if(!isset($_SESSION['email_u'])){
			$select_cart=$con->prepare("select * from cart where ip_add='$ip'");
			$select_cart->setFetchMode(PDO:: FETCH_ASSOC);
			$select_cart->execute();
			$net_total=0;
			$count_cart_item=$select_cart->rowCount();
		}else{
			$u_email=$_SESSION['email_u'];
			$get_user=$con->prepare("select * from user where u_email='$u_email'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
			$row_get_user=$get_user->fetch();
			$user_id=$row_get_user['u_id'];
			
			$select_cart=$con->prepare("select * from user_cart where ip_add='$ip' AND u_id='$user_id'");
			$select_cart->setFetchMode(PDO:: FETCH_ASSOC);
			$select_cart->execute();
			$net_total=0;
			$count_cart_item=$select_cart->rowCount();
		}
		if($count_cart_item==0){
			echo"<div id='cart'><center><h2>No Course Found In Your Cart Please Add Some Courses In Your Cart</h2></center></div>";
		}else{
			echo"<div id='cart'>
					<table cellspacing='0'>
						<tr>
							<th id='cart_title'>Name</th>
							<th id='hidden'>Instructor</th>
							<th id='hidden'>Lectures</th>
							<th id='hidden'>Language</th>
							<th>Price</th>
						</tr>";
					while($row=$select_cart->fetch()):
						$course_id=$row['course_id'];
						$get_user_course=$con->prepare("select * from course where course_id='$course_id'");	
						$get_user_course->setFetchMode(PDO:: FETCH_ASSOC);
						$get_user_course->execute();
						$row_course=$get_user_course->fetch();
						$uu_id=$row_course['u_id'];
						$language_id=$row_course['lang_id'];
						
						$get_language=$con->prepare("select * from lang where lang_id='$language_id'");
						$get_language->execute();
						$row_language=$get_language->fetch();
						$language_name=$row_language['lang_name'];
						
						$get_user_name=$con->prepare("select * from user where u_id='$uu_id'");
						$get_user_name->setFetchMode(PDO:: FETCH_ASSOC);
						$get_user_name->execute();
						$row_user_name=$get_user_name->fetch();
						
						$get_lecture=$con->prepare("select * from c_cur where c_id='$course_id'");
						$get_lecture->setFetchMode(PDO:: FETCH_ASSOC);
						$get_lecture->execute();
						$row_lecture=$get_lecture->rowCount();
						$net_total=$net_total+$row_course['dis_price'];
						echo"<tr>
								<td id='cart_title'>
									<img src='imgs/courses/".$row_course['img']."' />
									<p><a href='course_details.php?course_id=$course_id'>".$row_course['title']."</a></p>
									<span><a href='delete.php?del_cart=$course_id'><i class='fa fa-trash' area-hidden='true'></i> Remove</a></span>
								</td>
								<td id='hidden'>".$row_user_name['u_name']."</td>
								<td id='hidden'>".$row_lecture."</td>
								<td id='hidden'>".$language_name."</td>
								<td>$".$row_course['dis_price']."</td>
							</tr>";
					endwhile;
					echo"<tr>
							<td id='cart_title'>
								<button><a href='index.php'>Keep Shopping</a></button>";
								if(!isset($_SESSION['email_u'])){}else{
									if(!isset($_GET['mul_buy'])){
										echo"<button><a href='checkout.php?mul_buy'>CheckOut</a></button>";
									}
								}
						echo"</td>
							<td id='hidden'></td>
							<td id='hidden'></td>
							<td id='hidden' style='text-align:center'>Amount Payable : </td>
							<td>$$net_total</td>
						</tr>
					</table>";
					if(!isset($_SESSION['email_u'])){
						echo"<br /><center><h2 style='color:#f00'>Please Login or Signup For Buying Courses</h2></center>";
					}	
					if(isset($_GET['mul_buy'])){
						echo"<h1>Payment Through</h1>
							<center>
								<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
									  <input type='hidden' name='cmd' value='_xclick'>
									  <input type='hidden' name='business' value='azazpatel399@gmail.com'>	
									  <input type='hidden' name='item_name' value='Amount Payable'>
									  <input type='hidden' name='amount' value='".$net_total."'>
									  <input type='hidden' name='currency_code' value='USD'>				
									  <input type='hidden' name='return' value='http://127.0.0.1/Elearning_user/payment_cart_success.php' />
									  <input type='hidden' name='cencle_return' value='http://127.0.0.1/Elearning_user/payment_cancle.php' />
									  <input type='image' name='submit' border='0' src='imgs/web_imgs/paypal.png' alt='Buy Now'>
									  <img alt='' border='0' width='1' height='1' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' >
								</form>
							</center>";	
					}
				echo"</div>";
		}
	}
	function paypal_cart(){		
		$u_email=$_SESSION['email_u'];
		include("inc/db.php");
		
		$get_user=$con->prepare("select * from user where u_email='$u_email'");
		$get_user->setFetchMode(PDO:: FETCH_ASSOC);
		$get_user->execute();
		$row_user=$get_user->fetch();
		$u_id=$row_user['u_id'];
		
		$ip=getIp();
		$get_user_cart=$con->prepare("select * from user_cart where ip_add='$ip' AND u_id='$u_id'");
		$get_user_cart->setFetchMode(PDO:: FETCH_ASSOC);
		$get_user_cart->execute();
		while($row_cart=$get_user_cart->fetch()):
			$course_id=$row_cart['course_id'];
			$trx_id='UNI'.mt_rand().'QUE';
			$check_data=$con->prepare("select * from payment where u_id='$u_id' AND course_id='$course_id'");
			$check_data->execute();
			$row_check=$check_data->rowCount();
			
			if($row_check==1){
				echo"<script>alert('You Aleardy Buy');</script>";
				header("Location:index.php");	
			}
			else{
				$get_amt=$con->prepare("select * from course where course_id='$course_id'");
				$get_amt->setFetchMode(PDO:: FETCH_ASSOC);
				$get_amt->execute();
				$row_amt=$get_amt->fetch();
				$amt=$row_amt['dis_price'];
				$currency='USD';
				$total_earn=$row_amt['dis_price']/2;
				$pending="Pending";
				$complete="Complete";
				$type="Paypal";
				$ins_id=$row_amt['u_id'];
				$add_to_payment=$con->prepare("insert into payment(amt,course_id,u_id,ins_id,trx_id,currency,payment_date,ins_status,user_status,payment_type,ip_add)values('$amt','$course_id','$u_id','$ins_id','$trx_id','$currency',NOW(),'$pending','$complete','$type','$ip')");
				$add_to_payment->execute();
				
				$update_enroll=$con->prepare("update course set enroll_by=enroll_by+1 where course_id='$course_id'");
				$update_enroll->execute();
				
				$up_total_earn=$con->prepare("update course set total_earn=total_earn+'$total_earn' where course_id='$course_id'");
				$up_total_earn->execute();
				
				$delete_cart=$con->prepare("delete from user_cart where course_id='$course_id' AND u_id='$u_id'");
				$delete_cart->execute();
				
				header("Location:profile.php?my_course");
			}
		endwhile;	
	}
	function delete_cart_item(){
		include("inc/db.php");
		if(isset($_GET['del_cart'])){
			$id=$_GET['del_cart'];
			$get_u=$con->prepare("select * from course where course_id='$id'");
			$get_u->setFetchmode(PDO:: FETCH_ASSOC);
			$get_u->execute();
			$row_u=$get_u->fetch();
			$cart_id=$row_u['course_id'];
			
			if(isset($_SESSION['email_u'])){
				$u_email=$_SESSION['email_u'];
				$get_user=$con->prepare("select * from user where u_email='$u_email'");
				$get_user->setFetchMode(PDO:: FETCH_ASSOC);
				$get_user->execute();
				$row_get_user=$get_user->fetch();
				$user_id=$row_get_user['u_id'];
				
				$delete_item=$con->prepare("delete from user_cart where course_id='$cart_id' AND u_id='$user_id'");	
				if($delete_item->execute()){
					echo"<script>window.open('cart.php','_self');</script>";	
				}
				else{
					echo"<script>alert('Something Wrong Try Again');</script>";	
				}
			}
			else{
				$ip=getIp();
				$delete_item_cart=$con->prepare("delete from cart where course_id='$cart_id' AND ip_add='$ip'");			
				if($delete_item_cart->execute()){
					echo"<script>window.open('cart.php','_self');</script>";	
				}
				else{
					echo"<script>alert('Something Wrong Try Again');</script>";	
				}	
			}
		}
	}
	function cat_page(){
		include("inc/db.php");
		//start category left
		if(isset($_GET['cat'])){
			$id=$_GET['cat'];
			
			$get_c=$con->prepare("select * from cat where cat_id='$id'");
			$get_c->setFetchMode(PDO:: FETCH_ASSOC);
			$get_c->execute();
			$row_c=$get_c->fetch();
			
			$get_cat=$con->prepare("select * from cat");
			$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cat->execute();
			
			$privacy="Public";
			$status="Publish";
			echo"<div id='cat_left'>
					<div id='filter'>
						<h3>".$row_c['cat_name']." 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>
					<h3>Category</h3><ul>";
			while($row_cat=$get_cat->fetch()):
				$get_cat_id=$row_cat['cat_id'];
				$get_cat_course=$con->prepare("select * from course where cat_id='$get_cat_id' AND privacy='$privacy' AND status='$status'");
				$get_cat_course->execute();
				$count_cat=$get_cat_course->rowCount();
				if($count_cat>0){
					echo"<li><a href='category.php?cat=".$row_cat['cat_id']."'>".$row_cat['cat_icon']." ".$row_cat['cat_name']." ($count_cat)</a></li>";
				}else{}
			endwhile;
			echo"</ul><h3>Sub Category</h3><ul>";
				$get_u=$con->prepare("select * from cat where cat_id='$id'");
				$get_u->setFetchMode(PDO:: FETCH_ASSOC);
				$get_u->execute();
				$row_u=$get_u->fetch();
				$cat_id=$row_u['cat_id'];
				
				$get_sub_cat=$con->prepare("select * from sub_cat where cat_id='$cat_id'");
				$get_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
				$get_sub_cat->execute();
				while($row_sub_cat=$get_sub_cat->fetch()):
					$get_sub_cat_id=$row_sub_cat['sub_cat_id'];
					$get_sub_cat_course=$con->prepare("select * from course where sub_cat_id='$get_sub_cat_id' AND privacy='$privacy' AND status='$status'");
					$get_sub_cat_course->execute();
					$count_sub_cat=$get_sub_cat_course->rowCount();
					if($count_sub_cat>0){
						echo "<li><a href='category.php?sub_cat=".$row_sub_cat['sub_cat_id']."'>".$row_sub_cat['sub_cat_icon']." ".$row_sub_cat['sub_cat_name']." ($count_sub_cat)</a></li>";
					}else{}
				endwhile;
			echo"</ul></div>";
			echo"<div id='cat_right'>
				<div class='crumb'>
					<p>
						<a href='index.php'>Home</a> <span>></span> 
						".$row_c['cat_name']."
					</p>
				</div>";
			$get_sub=$con->prepare("select * from sub_cat where cat_id='$cat_id'");
			$get_sub->setFetchMode(PDO:: FETCH_ASSOC);
			$get_sub->execute();
			while($row_sub=$get_sub->fetch()):
				$sub_cat_id=$row_sub['sub_cat_id'];
				$get_c=$con->prepare("select * from course where sub_cat_id='$sub_cat_id'");
				$get_c->setFetchMode(PDO:: FETCH_ASSOC);
				$get_c->execute();
				$count=$get_c->rowCount();
				if($count==0){}else{
				echo"<h3>
						".$row_sub['sub_cat_name']." 
						<button>
							<a href='category.php?sub_cat=".$row_sub['sub_cat_id']."'>
								<i class='fa fa-arrow-right' aria-hidden='true'></i>
							</a>
						</button>
					</h3><ul>";
					$get_course=$con->prepare("select * from course where sub_cat_id='$sub_cat_id' AND status='Publish' AND privacy='Public' AND dis>0");
					$get_course->setFetchMode(PDO:: FETCH_ASSOC);
					$get_course->execute();
					while($row_course=$get_course->fetch()):
						$id=$row_course['u_id'];
						$get_user=$con->prepare("select * from user where u_id='$id'");
						$get_user->setFetchMode(PDO:: FETCH_ASSOC);
						$get_user->execute();
						$row_user=$get_user->fetch();
						echo"<li>
								<a href='course_details.php?course_id=".$row_course['course_id']."'>
									<div id='discount'>".$row_course['dis']." Off</div>
									<img src='imgs/courses/".$row_course['img']."' />
									<p>".$row_course['title']."</p>
									<h4>Price : $".$row_course['dis_price']."</h4>
									<h5>Teacher : ".$row_user['u_name']."</h5>
								</a>
							</li>";
					endwhile;
					echo"</ul><br clear='all' />";
				}
			endwhile;
			echo"</div><br clear='all' />";
			include("inc/footer.php");
		}
	}
	function sub_cat_course(){
		include("inc/db.php");
		if(isset($_GET['sub_cat'])){
			$u=$_GET['sub_cat'];
			
			$get_cat=$con->prepare("select * from cat");
			$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cat->execute();
			
			$get_u=$con->prepare("select * from sub_cat where sub_cat_id='$u'");
			$get_u->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u->execute();
			$row_u=$get_u->fetch();
			$id=$row_u['sub_cat_id'];
			$c_id=$row_u['cat_id'];
			
			$get_cate=$con->prepare("select * from cat where cat_id='$c_id'");
			$get_cate->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cate->execute();
			$row_cate=$get_cate->fetch();
			
			echo "<div id='cat_left'>
					<div id='filter'>
						<h3>".$row_u['sub_cat_name']." 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>
					<h3>Category</h3>
					<ul class='cat_left'>";
			while($row_cat=$get_cat->fetch()):
				$cat_id=$row_cat['cat_id'];
				$count_cat_course=$con->prepare("select * from course where cat_id='$cat_id' AND status='Publish' AND privacy='Public'");
				$count_cat_course->setFetchMode(PDO:: FETCH_ASSOC);
				$count_cat_course->execute();
				$row_count_cat=$count_cat_course->rowCount();
				if($row_count_cat>0){
					echo"<li><a href='category.php?cat=".$row_cat['cat_id']."'>".$row_cat['cat_icon']." ".$row_cat['cat_name']." (".$row_count_cat.")</a></li>";
				}else{}
			endwhile;
			$get_free=$con->prepare("select * from course where sub_cat_id='$id' AND type='Free' AND status='Publish' AND privacy='Public'");
			$get_free->setFetchMode(PDO:: FETCH_ASSOC);
			$get_free->execute();
			$free_count=$get_free->rowCount();
			
			$get_paid=$con->prepare("select * from course where sub_cat_id='$id' AND type='Paid' AND status='Publish' AND privacy='Public'");
			$get_paid->setFetchMode(PDO:: FETCH_ASSOC);
			$get_paid->execute();
			$paid_count=$get_paid->rowCount();
			
			echo"<h3>Course By Type</h3>
				<li><a href='category.php?free_c=$u'><i class='fa fa-bolt' aria-hidden='true'></i> Free ($free_count)</a></li>
				<li><a href='category.php?paid_c=$u'><i class='fa fa-usd' aria-hidden='true'></i> Paid ($paid_count)</a></li>";

			echo"<h3>Course By Language</h3>";
					$get_lang=$con->prepare("select * from lang");
					$get_lang->setFetchMode(PDO:: FETCH_ASSOC);
					$get_lang->execute();
					while($row_lang=$get_lang->fetch()):
						$lang_id=$row_lang['lang_id'];
						$lang_name=$row_lang['lang_name'];
						$status="Publish";
						$privacy="Public";
						$get_lang_c=$con->prepare("select * from course where lang_id='$lang_id' AND sub_cat_id='$id' AND status='$status' AND privacy='$privacy'");
						$get_lang_c->execute();
						$lang_c_count=$get_lang_c->rowCount();
						echo"<li><a href='category.php?leng_c=$u&lang_id=".$row_lang['lang_id']."'>".$row_lang['lang_name']." ($lang_c_count)</a></li>";
					endwhile;		
			$blvl="Biginner Level";
			$get_lvl1=$con->prepare("select * from course where lvl='$blvl' AND sub_cat_id='$id' AND status='publish' AND privacy='public'");
			$get_lvl1->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lvl1->execute();
			$lvl1_count=$get_lvl1->rowCount();
			
			$get_lvl2=$con->prepare("select * from course where lvl='Intermidiate Level' AND sub_cat_id='$id' AND status='publish' AND privacy='public'");
			$get_lvl2->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lvl2->execute();
			$lvl2_count=$get_lvl2->rowCount();
			
			$get_lvl3=$con->prepare("select * from course where lvl='Expert Level' AND sub_cat_id='$id' AND status='publish' AND privacy='public'");
			$get_lvl3->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lvl3->execute();
			$lvl3_count=$get_lvl3->rowCount();
			
			$all_lvl=$con->prepare("select * from course where lvl='All Level' AND sub_cat_id='$id' AND status='publish' AND privacy='public'");
			$all_lvl->setFetchMode(PDO:: FETCH_ASSOC);
			$all_lvl->execute();
			$alllvl_count=$all_lvl->rowCount();
		echo"<h3>Course By Level</h3>
			<li><a href='category.php?all_lvl_c=$u'>All Level ($alllvl_count)</a></li>
			<li><a href='category.php?big_lvl_c=$u'>Begginer Level ($lvl1_count)</a></li>
			<li><a href='category.php?in_lvl_c=$u'>Intermidiate Level ($lvl2_count)</a></li>
			<li><a href='category.php?ex_lvl_c=$u'>Expert Level ($lvl3_count)</a></li>
			</ul>	
		</div>";
			if(isset($_GET['sub_cat'])){
			echo"<div id='cat_right'>
					<div class='crumb'>
						<p>
							<a href='index.php'>Home</a> <span>></span> 
							<a href='category.php?cat=".$row_cate['cat_id']."'>".$row_cate['cat_name']."</a> <span>></span>
							".$row_u['sub_cat_name']."
						</p>
					</div>
					<h3>".$row_u['sub_cat_name']. "</h3><ul>";
					$get_sub_c_course=$con->prepare("select * from course where sub_cat_id='$id' AND status='publish' AND privacy='public'");
					$get_sub_c_course->setFetchMode(PDO:: FETCH_ASSOC);
					$get_sub_c_course->execute();
					while($row_sub_c=$get_sub_c_course->fetch()):
						$id=$row_sub_c['u_id'];
						$get_user=$con->prepare("select * from user where u_id='$id'");
						$get_user->setFetchMode(PDO:: FETCH_ASSOC);
						$get_user->execute();
						$row_user=$get_user->fetch();
						echo"<li>
								<a href='course_details.php?course_id=".$row_sub_c['course_id']."'>
									<div id='discount'>".$row_sub_c['dis']." Off</div>
									<img src='imgs/courses/".$row_sub_c['img']."' />
									<p>".$row_sub_c['title']."</p>
									<h4>Price : $".$row_sub_c['dis_price']."</h4>
									<h5>Teacher : ".$row_user['u_name']."</h5>
								</a>
							</li>";
					endwhile;
				echo"</ul></div><br clear='all' />";
				include("inc/footer.php");
			}
		}
	}
	function lang_course(){
		include("inc/db.php");
		if(isset($_GET['leng_c'])){
			$u=$_GET['leng_c'];
			$lang_id=$_GET['lang_id'];
			
			$get_lang=$con->prepare("select * from lang where lang_id='$lang_id'");
			$get_lang->setfetchMode(PDO:: FETCH_ASSOC);
			$get_lang->execute();
			$row_lang=$get_lang->fetch();
			
			$get_u=$con->prepare("select * from sub_cat where sub_cat_id='$u'");
			$get_u->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u->execute();
			$row_u=$get_u->fetch();
			$id=$row_u['sub_cat_id'];
			$cat_id=$row_u['cat_id'];
			
			$get_cat=$con->prepare("select * from cat where cat_id='$cat_id'");
			$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cat->execute();
			$row_cat=$get_cat->fetch();
				
			echo"<div id='cat_left'>
					<div id='filter'>
						<h3>".$row_lang['lang_name']." 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>
					<h3>Categories</h3><ul>";
					$dis_cat=$con->prepare("select * from cat");
					$dis_cat->setFetchMode(PDO:: FETCH_ASSOC);
					$dis_cat->execute();
					while($row_dis_cat=$dis_cat->fetch()):
						$cet_id=$row_dis_cat['cat_id'];
						$count_cet=$con->prepare("select * from course where cat_id='$cet_id' AND status='Publish' AND privacy='Public'");
						$count_cet->setFetchMode(PDO:: FETCH_ASSOC);
						$count_cet->execute();
						$c_cat=$count_cet->rowCount();
						if($c_cat>0){
							echo"<li><a href='category.php?cat=".$row_dis_cat['cat_id']."'>".$row_dis_cat['cat_icon']." ".$row_dis_cat['cat_name']." ($c_cat)</a></li>";
						}else{}
					endwhile;
				echo"</ul></div>";	
				echo"<div id='cat_right'>
						<div class='crumb'>
							<p>
								<a href='index.php'>Home</a> <span>></span> 
								<a href='category.php?cat=".$row_cat['cat_id']."'>".$row_cat['cat_name']."</a> <span>></span>
								<a href='category.php?sub_cat=".$row_u['sub_cat_id']."'>".$row_u['sub_cat_name']."</a> <span>></span>
								".$row_lang['lang_name']."
							</p>
						</div>
						<h3>Courses In ".$row_lang['lang_name']."</h3><ul>";
						$get_c=$con->prepare("select * from course where sub_cat_id='$u' AND lang_id='$lang_id' AND status='Publish' AND privacy='Public'");
						$get_c->setFetchMode(PDO:: FETCH_ASSOC);
						$get_c->execute();
						while($row_c=$get_c->fetch()):
							$id=$row_c['u_id'];
							$get_user=$con->prepare("select * from user where u_id='$id'");
							$get_user->setFetchMode(PDO:: FETCH_ASSOC);
							$get_user->execute();
							$row_user=$get_user->fetch();
							echo"<li>
								<a href='course_details.php?course_id=".$row_c['course_id']."'>
									<div id='discount'>".$row_c['dis']." Off</div>
									<img src='imgs/courses/".$row_c['img']."' />
									<p>".$row_c['title']."</p>
									<h4>Price : $".$row_c['dis_price']."</h4>
									<h5>Teacher : ".$row_user['u_name']."</h5>
								</a>
							</li>";
						endwhile;
					echo"</ul><br clear='all' />
					</div><br clear='all' />";
					include("inc/footer.php");
		}	
	}
	function course_lvl(){
		include("inc/db.php");
			echo"<div id='cat_left'>";
			if(isset($_GET['all_lvl_c'])){
				$u=$_GET['all_lvl_c'];
				echo"<div id='filter'>
						<h3>All Level Courses 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>";
			}elseif(isset($_GET['big_lvl_c'])){
				$u=$_GET['big_lvl_c'];
				echo"<div id='filter'>
						<h3>Begginer Level Courses 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>";
			}elseif(isset($_GET['in_lvl_c'])){
				$u=$_GET['in_lvl_c'];
				echo"<div id='filter'>
						<h3>Intermidiate Level Courses 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>";
			}elseif(isset($_GET['ex_lvl_c'])){
				$u=$_GET['ex_lvl_c'];
				echo"<div id='filter'>
						<h3>Expert Level Courses 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>";
			}elseif(isset($_GET['paid_c'])){
				$u=$_GET['paid_c'];
				echo"<div id='filter'>
						<h3>Paid Courses 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>";
			}elseif(isset($_GET['free_c'])){
				$u=$_GET['free_c'];
				echo"<div id='filter'>
						<h3>Free Courses 
							<i id='open' class='fa fa-filter' aria-hidden='true'></i>
							<i id='close' class='fa fa-close' aria-hidden='true'></i>
						</h3>
					</div>";	
			}

			$get_u=$con->prepare("select * from sub_cat where sub_cat_id='$u'");
			$get_u->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u->execute();
			$row_u=$get_u->fetch();
			$id=$row_u['sub_cat_id'];
			$cat_id=$row_u['cat_id'];
			
			$get_cat=$con->prepare("select * from cat where cat_id='$cat_id'");
			$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cat->execute();
			$row_cat=$get_cat->fetch();
			
			if(!isset($_GET['cat']) && !isset($_GET['sub_cat']) && !isset($_GET['leng_c']) ){	
			
				echo"<h3>Categories</h3><ul>";
					$dis_cat=$con->prepare("select * from cat");
					$dis_cat->setFetchMode(PDO:: FETCH_ASSOC);
					$dis_cat->execute();
					while($row_dis_cat=$dis_cat->fetch()):
						$cet_id=$row_dis_cat['cat_id'];
						$count_cet=$con->prepare("select * from course where cat_id='$cet_id' AND status='Publish' AND privacy='Public'");
						$count_cet->setFetchMode(PDO:: FETCH_ASSOC);
						$count_cet->execute();
						$c_cat=$count_cet->rowCount();
						if($c_cat>0){
							echo"<li><a href='category.php?cat=".$row_dis_cat['cat_id']."'>".$row_dis_cat['cat_icon']." ".$row_dis_cat['cat_name']." ($c_cat)</a></li>";
						}else{}
					endwhile;
				echo"</ul></div>";	
				echo"<div id='cat_right'>
						<div class='crumb'>
							<p>
								<a href='index.php'>Home</a> <span>></span> 
								<a href='category.php?cat=".$row_cat['cat_id']."'>".$row_cat['cat_name']."</a> <span>></span>
								<a href='category.php?sub_cat=".$row_u['sub_cat_id']."'>".$row_u['sub_cat_name']."</a> <span>></span>";
								if(isset($_GET['all_lvl_c'])){
									echo "All Level Courses";
								}elseif(isset($_GET['big_lvl_c'])){
									echo "Begginer Level Courses";
								}elseif(isset($_GET['in_lvl_c'])){
									echo "InterMidiate Level Courses";
								}elseif(isset($_GET['ex_lvl_c'])){
									echo "Expert Level Courses";
								}elseif(isset($_GET['paid_c'])){
									echo "Paid Courses";
								}elseif(isset($_GET['free_c'])){
									echo "Free Courses";	
								}		
						echo"</p>
						</div>";
						if(isset($_GET['all_lvl_c'])){
							echo "<h3>All Level Courses</h3>";
						}elseif(isset($_GET['big_lvl_c'])){
							echo "<h3>Begginer Level Courses</h3>";
						}elseif(isset($_GET['in_lvl_c'])){
							echo "<h3>InterMidiate Level Courses</h3>";
						}elseif(isset($_GET['ex_lvl_c'])){
							echo "<h3>Expert Level Courses</h3>";
						}elseif(isset($_GET['paid_c'])){
							echo "<h3>Paid Courses</h3>";
						}elseif(isset($_GET['free_c'])){
							echo "<h3>Free Courses</h3>";	
						}
						echo"<ul>";
						if(isset($_GET['all_lvl_c'])){
							$get_c=$con->prepare("select * from course where sub_cat_id='$id' AND lvl='All Level' AND status='Publish' AND privacy='Public'");
							$get_c->setFetchMode(PDO:: FETCH_ASSOC);
							$get_c->execute();
						}elseif(isset($_GET['big_lvl_c'])){
							$get_c=$con->prepare("select * from course where sub_cat_id='$id' AND lvl='Biginner Level' AND status='Publish' AND privacy='Public'");
							$get_c->setFetchMode(PDO:: FETCH_ASSOC);
							$get_c->execute();
						}elseif(isset($_GET['in_lvl_c'])){
							$get_c=$con->prepare("select * from course where sub_cat_id='$id' AND lvl='Intermidiate Level' AND status='Publish' AND privacy='Public'");
							$get_c->setFetchMode(PDO:: FETCH_ASSOC);
							$get_c->execute();
						}elseif(isset($_GET['ex_lvl_c'])){
							$get_c=$con->prepare("select * from course where sub_cat_id='$id' AND lvl='Expert Level' AND status='Publish' AND privacy='Public'");
							$get_c->setFetchMode(PDO:: FETCH_ASSOC);
							$get_c->execute();
						}elseif(isset($_GET['paid_c'])){
							$get_c=$con->prepare("select * from course where sub_cat_id='$id' AND type='Paid' AND status='Publish' AND privacy='Public'");
							$get_c->setFetchMode(PDO:: FETCH_ASSOC);
							$get_c->execute();	
						}elseif(isset($_GET['free_c'])){
							$get_c=$con->prepare("select * from course where sub_cat_id='$id' AND type='Free' AND status='Publish' AND privacy='Public'");
							$get_c->setFetchMode(PDO:: FETCH_ASSOC);
							$get_c->execute();
						}
						while($row_c=$get_c->fetch()):
							$user=$row_c['u_id'];
							$get_user=$con->prepare("select * from user where u_id='$user'");
							$get_user->setFetchMode(PDO:: FETCH_ASSOC);
							$get_user->execute();
							$row_user=$get_user->fetch();
							echo"<li>
									<a href='course_details.php?course_id=".$row_c['course_id']."'>
										<div id='discount'>".$row_c['dis']." Off</div>
										<img src='imgs/courses/".$row_c['img']."' />
										<p>".$row_c['title']."</p>
										<h4>Price : $".$row_c['dis_price']."</h4>
										<h5>Teacher : ".$row_user['u_name']."</h5>
									</a>
								</li>";
						endwhile;
				echo"</ul><br clear='all' /></div><br clear='all' />";
				include("inc/footer.php");
			}
	}
	function dashboard(){
		include("inc/db.php");
		if(!isset($_SESSION['email_u'])){
			echo"<script>window.open('index.php','_self')</script>";
		}
		
		$email=$_SESSION['email_u'];
		$get_u=$con->prepare("select u_id from user where u_email='$email'");
		$get_u->setFetchMode(PDO:: FETCH_ASSOC);
		$get_u->execute();
		$row=$get_u->fetch();
		$u_id=$row['u_id'];
		
		$get_c=$con->prepare("select * from course where u_id='$u_id' order by 1 desc");
		$get_c->setFetchMode(PDO:: FETCH_ASSOC);
		$get_c->execute();
		
		echo"<div id='crumb'>
				<p>
					<a href='index.php'>Home</a> <span>></span> 
					Dashboard
				</p>
			</div>
			<div id='teacher'>
				<h1>
					<span>Instructor Dashboard</span>
					<form method='post' enctype='multipart/form-data'>
						<input type='text' name='course_name' required='required' maxlength='100' minlength='10' placeholder='Enter Course Name Here' />
						<button name='course_create'>Create Course</button>
					</form><br clear='all' />
				</h1>
				<table cellspacing='0'>
					<tr>
						<th id='dash_title'>Name</th>
						<th>Course Type</th>
						<th>Course Price</th>
						<th>Course Status</th>
						<th>Enroll By</th>
						<th>Total Earn</th>
					</tr>";
					while($row_c=$get_c->fetch()):
						echo"<tr>
							<td id='dash_title'>
								<a href='course_edit.php?course_edit=".$row_c['course_id']."'>";
									if($row_c['img']==""){
										echo"<img src='imgs/courses/default.jpg' />";
									}else{
										echo"<img src='imgs/courses/".$row_c['img']."' />";
									}
									echo"<p>".$row_c['title']."</p>
									<label><i class='fa fa-edit' area-hidden='true'></i> Edit</label>
								</a>
							</td>
							<td><span>".$row_c['type']."</span></td>
							<td><span>$".$row_c['dis_price']."</span></td>
							<td><span>".$row_c['status']."</span></td>
							<td><span>".$row_c['enroll_by']."</span></td>
							<td><span>$".$row_c['total_earn']."</span></td>
						</tr>";
					endwhile;
				echo"</table>
			</div>";
		if(isset($_POST['course_create'])){
			$title=$_POST['course_name'];
			$date=date("Y-m-d");
			$int=0;
			$status="Unpublish";
			$privacy="Private";
			$type="Free";
			$add_c=$con->prepare("insert into course(cat_id,sub_cat_id,lang_id,u_id,title,img,mrp_price,dis,dis_price,c_desc,lvl,status,privacy,type,skill,at_end,created_date,enroll_by,total_earn)values('$int','$int','$int','$u_id','$title','','$int','','$int','','','$status','$privacy','$type','','','$date','$int','$int')");
			if($add_c->execute()){
				echo"<script>window.open('teacher.php','_self')</script>";
			}else{
				echo"<script>alert('Something Wrong Try Again')</script>";
			}
		}
	}
	function course_edit(){
		if(isset($_GET['course_edit'])){
			include("inc/db.php");
			if(!isset($_SESSION['email_u'])){
				echo"<script>window.open('index.php','_self')</script>";
			}
			$u=$_GET['course_edit'];
			$email=$_SESSION['email_u'];
			$get_u=$con->prepare("select u_id from user where u_email='$email'");
			$get_u->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u->execute();
			$row_u=$get_u->fetch();
			$u_id=$row_u['u_id'];
			$get_c=$con->prepare("select * from course where course_id='$u' AND u_id='$u_id'");
			$get_c->setFetchMode(PDO::FETCH_ASSOC);
			$get_c->execute();
			$row=$get_c->fetch();

			$c_id=$row['course_id'];
			$cat_id=$row['cat_id'];
			$get_cat=$con->prepare("select * from cat where cat_id='$cat_id'");
			$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cat->execute();
			$row_cat=$get_cat->fetch();

			$sub_cat_id=$row['sub_cat_id'];
			$get_sub_cat=$con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
			$get_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$get_sub_cat->execute();
			$row_sub_cat=$get_sub_cat->fetch();
			
			$c_id=$row['course_id'];
			$cat_id=$row['cat_id'];
			$sub_cat_id=$row['sub_cat_id'];
			$lang_id=$row['lang_id'];
			$user_id=$row['u_id'];
			$title=$row['title'];
			$img=$row['img'];
			$ski=$row['skill'];
			$goal=$row['at_end'];
			$desc=$row['c_desc'];
			$level=$row['lvl'];
			$dis_price=$row['dis_price'];
			$stat=$row['status'];

			$get_cur=$con->prepare("select * from c_cur where u_id='$user_id' AND c_id='$c_id'");
			$get_cur->setFetchMode(PDO:: FETCH_ASSOC);
			$get_cur->execute();
			$count_lec=$get_cur->rowCount();

			if(isset($_POST['c_submit'])){
				if($img == ''){
					echo"<script>alert('Please Fillup All The Field In Course Title Section')</script>";
					echo"<script>window.open('course_edit.php?course_edit=$u','_self')</script>";
				}elseif($ski == '' || $goal == ''){
					echo"<script>alert('Please Fillup All The Field In Course Goal Section')</script>";
					echo"<script>window.open('course_goal&course_edit=$u','_self')</script>";
				}elseif($desc == '' || $lang_id == 0 || $level == '' || $cat_id == 0 || $sub_cat_id == 0){
					echo"<script>alert('Please Fillup All The Field In Course Details Section')</script>";
					echo"<script>window.open('course_det&course_edit=$u','_self')</script>";
				}elseif($count_lec < 5){
					echo"<script>alert('Please Upload More Then 5 Lectrures In Curriculum Section')</script>";
					echo"<script>window.open('course_lec&course_edit=$u','_self')</script>";
				}else{
					$up_course=$con->prepare("update course set status='Pending' where u_id='$user_id' AND course_id='$u'");
					if($up_course->execute()){
						echo"<script>alert('Your Course Is In Review')</script>";
						echo"<script>window.open('course_edit.php?course_edit=$u','_self')</script>";
					}
				}		
			}

			echo"<div id='c_edit_left'>
					<h1>Course Management</h1>
					<ul>
						<li><a href='course_edit.php?course_edit=$u'><i class='fa fa-edit' area-hidden='true'></i> Title And Image</a></li>
						<li><a href='course_edit.php?course_goal&course_edit=$u'><i class='fa fa-shield' area-hidden='true'></i> Course Goal</a></li>
						<li><a href='course_edit.php?course_det&course_edit=$u'><i class='fa fa-info-circle' area-hidden='true'></i> Course Details</a></li>
						<li><a href='course_edit.php?course_price&course_edit=$u'><i class='fa fa-briefcase' area-hidden='true'></i> Course Price</a></li>
						<li><a href='course_edit.php?course_lec&course_edit=$u'><i class='fa fa-money' area-hidden='true'></i> Curriculum</a></li>
					</ul>";
				if($stat == 'Pending'){
					echo"<form method='post'><button style='cursor:auto; background:#f90;' type='button' disabled>Course In Review</button></form>";
				}elseif($stat == 'Publish'){
					echo"<form method='post'><button style='cursor:auto; background:#0c9; color:#fff' type='button' disabled>Course Is Activated</button></form>";
				}else{
					echo"<form method='post'>
							<button name='c_submit'>Submit For Review</button>
						</form>";
				}
			echo"</div>
				<div id='c_edit_right'>
					<div class='crumb'>
						<p>
							<a href='index.php'>Home</a> <span>></span> 
							<a href='teacher.php'>Dashboard</a> <span>></span>
							".$row['title']."
						</p>
					</div>";
				if(!isset($_GET['course_goal']) && !isset($_GET['course_det']) && !isset($_GET['course_price']) && !isset($_GET['course_lec'])){
					echo"<h2>Course Title</h2>
						<form method='post' enctype='multipart/form-data'>
							<div id='c_input'>
								<input type='text' name='c_name' value='".$row['title']."' required='required' maxlength='100' minlength='10' />
								<p>53</p>
							</div>
							<h2>Course Image</h2>";
							if($row['img']==""){
								echo"<img src='imgs/courses/default.jpg' />";
							}else{
								echo"<img src='imgs/courses/".$row['img']."' />";
							}
							echo"<p>E Commerce Website Development In PHP With PDO E Commerce Website Development In PHP With PDO E Commerce Website Development In PHP With PDO</p>
							<div id='c_input_img'>
								<input type='file' name='c_img' accept='image/*' />
							</div>
							<button name='c_len'>Save</button>
						</form>";
				}
			
				if(isset($_GET['course_goal'])){
					echo"<h2>Course Goal</h2>
						<p id='course_head'>The first step to creating a great course is deciding who you are creating your course for and what those students are looking to accomplish. This is important information that will help students decide if your course is the right fit for their needs and will appear on your course landing page.</p><br clear='all' />
						<h2>What will students need to know or do before starting this course ?</h2>
						<form method='post'>
							<div id='c_input'>
								<input type='text' name='c_skill' value='".$row['skill']."' required='required' maxlength='100' minlength='10' placeholder='Before Start Must Be Knowledge About....' />
								<p>53</p>
							</div>
							<h2>At the end of my course, students will be able to...</h2>
							<div id='c_input'>
								<input type='text' name='c_end' value='".$row['at_end']."' required='required' maxlength='100' minlength='10' placeholder='At The End Of This Course Your Students Can...' />
								<p>53</p>
							</div>
							<button name='c_goal'>Save</button>
						</form>";
					if(isset($_POST['c_goal'])){
						$skill=$_POST['c_skill'];
						$end=$_POST['c_end'];
						$up_skill=$con->prepare("update course set skill='$skill',at_end='$end' where u_id='$u_id' AND course_id='$u'");
						if($up_skill->execute()){
							echo"<script>window.open('course_edit.php?course_goal&course_edit=$u','_self')</script>";	
						}	
					}	
				}

				if(isset($_GET['course_det'])){
					echo"<h2>Course Description</h2>
						<form method='post'>
							<textarea name='c_desc' placeholder='Enter Course Description Here...'>".$row['c_desc']."</textarea>
							<h2>Course Basic Information</h2>
							<select name='c_lang' required>";
								$lang_id=$row['lang_id'];
								$get_lang=$con->prepare("select * from lang where lang_id='$lang_id'");
								$get_lang->setFetchmode(PDO:: FETCH_ASSOC);
								$get_lang->execute();
								$row_lang=$get_lang->fetch();
								if($row['lang_id']==0){
									echo "<option value=''>--Select Language--</option>";	
								}else{
									echo"<option value='".$row['lang_id']."'>".$row_lang['lang_name']."</option>";	
								}
								echo lang();
						echo"</select>
							<select name='c_lvl' required>";
								$lvl=$row['lvl'];
								if($lvl==''){
									echo"<option value=''>--Select Level--</option>";	
								}else{
									echo"<option value='".$row['lvl']."'>".$row['lvl']."</option>";
								}
								echo"<option value='All Level'>All Level</option>
								<option value='Biginner Level'>Biginner Level</option>
								<option value='Intermidiate Level'>Intermidiate Level</option>
								<option value='Expert Level'>Expert Level</option>
							</select>
							<select name='cat_id' id='c_cat_name' required='required'>";
								if($row['cat_id']==0){
									echo"<option value=''>--Select Category--</option>";	
								}else{
									echo"<option value='".$row['cat_id']."'>".$row_cat['cat_name']."</option>";
								}
								echo get_all_cat();
						echo"</select>
							<select name='sub_cat_id' id='c_sub_cat_name' required='required'>";
							if($row['sub_cat_id']==0){
								echo"<option value=''>--Select Sub Category--</option>";	
							}else{
								echo"<option value='".$row['sub_cat_id']."'>".$row_sub_cat['sub_cat_name']."</option>";
							}
						echo"</select>
							<button name='course_detail'>Save</button>
						</form>";
						if(isset($_POST['course_detail'])){
							$course_des=$_POST['c_desc'];
							$course_lang=$_POST['c_lang'];
							$course_lvl=$_POST['c_lvl'];
							$c_cat_name=$_POST['cat_id'];
							$c_sub_cat_name=$_POST['sub_cat_id'];
							$update_course=$con->prepare("update course set c_desc='$course_des',lang_id='$course_lang',cat_id='$c_cat_name',sub_cat_id='$c_sub_cat_name',lvl='$course_lvl' where u_id='$u_id' AND course_id='$u'");
							if($update_course->execute()){
								echo"<script>window.open('course_edit.php?course_det&course_edit=$u','_self');</script>";	
							}
						}							
				}

				if(isset($_GET['course_price'])){
					echo"<h2>Course Price</h2>
						<p id='course_head'>Select price of your course below and click 'Save'. Once completed, you will be able to create instructor coupons based on your selected price. To create a Free course, select a price of 'Free'.</p><br clear='all' />	
						<form method='post'>
						<h2>Price And Privacy</h2><br />";
						if($row['type']=='Free'){
							echo"<select name='course_type' required>
									<option value='Free'>Free</option>
									<option value='Paid'>Paid</option>
								</select>";	
						}else{
							echo"<select name='course_mrp' required>";
								$price=$row['dis_price'];
								if($price==0){
									echo"<option value=''>Course Price</option>";	
								}else{
									echo"<option value='".$row['mrp_price']."'>$".$row['mrp_price']."</option>";	
								}
								echo"<option disabled='disabled'>Select Course Price</option>
									<option value='1'>$1</option>
									<option value='4'>$4</option>
									<option value='8'>$8</option>
									<option value='10'>$10</option>
									<option value='20'>$20</option>
									<option value='24'>$24</option>
									<option value='30'>$30</option>
									<option value='40'>$40</option>
									<option value='50'>$50</option>
									<option value='60'>$60</option>
									<option value='70'>$70</option>
									<option value='80'>$80</option>
									<option value='90'>$90</option>
									<option value='100'>$100</option>
									<option value='110'>$110</option>
									<option value='120'>$120</option>
									<option value='130'>$130</option>
									<option value='140'>$140</option>
									<option value='150'>$150</option>
									<option value='160'>$160</option>
									<option value='170'>$170</option>
									<option value='180'>$180</option>
									<option value='190'>$190</option>
									<option value='200'>$200</option>
							</select>
							<select name='course_discount'>";
								$dis=$row['dis'];
								if($dis==0){
									echo"<option value=''>Course Discount</option>";	
								}else{
									echo"<option value='".$row['dis']."'>".$row['dis']."</option>";
								}
								echo"<option value='0%'>No Discount</option>
									<option value='10%'>10%</option>
									<option value='20%'>20%</option>
									<option value='30%'>30%</option>
									<option value='40%'>40%</option>
									<option value='50%'>50%</option>
									<option value='60%'>60%</option>
									<option value='70%'>70%</option>
									<option value='80%'>80%</option>
									<option value='90%'>90%</option>
									<option value='95%'>95%</option>
							</select>";
						}
						echo"<select name='course_privacy' style='margin-left:1%' required>
								<option value='".$row['privacy']."'>".$row['privacy']."</option>
								<option disabled='disabled'>Select Course Privacy</option>
								<option value='Public'>Public</option>
								<option value='Private'>Private</option>
							</select><br />
							<button style='float:left; margin-left:1%' name='course_price'>Save</button>
						</form>";
						if(isset($_POST['course_price'])){
							$course_mrp=$_POST['course_mrp'];
							$course_dis=$_POST['course_discount'];
							$course_privacy=$_POST['course_privacy'];
							if($course_dis == ''){
								$course_sell_price=$course_mrp;
							}else{
								$course_sell_price=$course_mrp-($course_mrp*$course_dis/100);
							}
							$course_type=@$_POST['course_type'];

							$update_course_type=$con->prepare("update course set type='$course_type' where u_id='$u_id' AND course_id='$u'");
							$update_course_type->execute();

							if($course_type=='Free'){
								$update_course=$con->prepare("update course set mrp_price='$course_mrp',dis='$course_dis',privacy='$course_privacy',dis_price='$course_sell_price',type='Free' where u_id='$u_id' AND course_id='$u'");
								if($update_course->execute()){
									echo"<script>window.open('course_edit.php?course_price&course_edit=$u','_self');</script>";	
								}
							}else{	
								$update_course=$con->prepare("update course set mrp_price='$course_mrp',dis='$course_dis',privacy='$course_privacy',dis_price='$course_sell_price',type='Paid' where u_id='$u_id' AND course_id='$u'");
								if($update_course->execute()){
									echo"<script>window.open('course_edit.php?course_price&course_edit=$u','_self');</script>";	
								}
							}							
						}

				}

				if(isset($_GET['course_lec'])){
					echo"<h2>Curriculum</h2>";
						if(!isset($_POST['add_lec_btn'])){
							echo"<form method='post'>
									<button name='add_lec_btn'>Add Lecture</button>
								</form><br clear='all' />";
						}
						if(isset($_POST['add_lec_btn'])){
							echo"<form method='post' enctype='multipart/form-data'>
									<h2>Enter Lecture Name</h2>
									<div id='c_input'>
										<input required='required' maxlength='100' title='Maximum 100 Characters Allow' type='text' name='lec_title' placeholder='Enter Lecture Title Here' />
										<p>54</p>
									</div>
									<h2>Choose Lecture Video</h2>
									<div id='c_input'>
										<input type='file' name='video' accept='video/*' title='Upload Lecture Video' />
									</div>
									<button name='add_lecture'>Add Lecture</button>
								</form><br clear='all' />";
						}
						if(isset($_POST['add_lecture'])){
							$v_name=$_POST['lec_title'];
							$other="";
							$video=$_FILES['video']['name'];
							$video_tmp=$_FILES['video']['tmp_name'];
							$add_lec=$con->prepare("insert into c_cur(c_id,u_id,v_title,video,date)values('$c_id','$u_id','$v_name','$video',NOW())");
							if($add_lec->execute()){
								move_uploaded_file($video_tmp,"lecture/$video");
								echo"<script>window.open('course_edit.php?course_lec&course_edit=$u','_self');</script>";	
							}
							else{
								echo"<script>alert('Somthing Wrong Try Again‌');</script>";
							}
						
						}
					
					$get_lec=$con->prepare("select * from c_cur where c_id='$c_id' AND u_id='$u_id'");
					$get_lec->setFetchMode(PDO:: FETCH_ASSOC);
					$get_lec->execute();
					echo"<form method='post' enctype='multipart/form-data'>
							<ul>";
							$i=1;
							while($row_lec=$get_lec->fetch()):
							echo"<li>
									<input type='hidden' name='v' value='".$row_lec['v_id']."' />
									<details>
										<summary><span>Lecture ".$i++.": <i class='fa fa-video-camera' aria-hidden='true'></i> ".$row_lec['v_title']."</span> <p>Edit Content <i class='fa fa-arrow-down' aria-hidden='true'></i></p></summary><br clear='all' />
										<div>
											<h3>Update Lecture Name</h3>
											<div id='c_input'>
												<input id='input' maxlength='100' title='Special Characters Not Allow, Maximum 100 Characters Allow' type='text' name='up_v_title' value='".$row_lec['v_title']."' />
												<p>55</p>
											</div>
											<h3>Update Lecture Video</h3>
											<div id='c_input'>
												<input type='file' name='up_video' accept='video/*' title='Upload Lecture Video' />
											</div>											
											<button name='up_content'>Update</button><br clear='all' />													
											<h3>Lecture Video</h3>
											<center><video controls='controls' src='lecture/".$row_lec['video']."'></video></center>
										</div>
									</details>
								</li>";
							endwhile;
							echo"</ul>
						</form>";
						if(isset($_POST['up_content'])){
							$v_id=$_POST['v'];
							$up_title=$_POST['up_v_title'];
							$up_v=$_FILES['up_video']['name'];
							$up_v_tmp=$_FILES['up_video']['tmp_name'];

							$get_link=$con->prepare("select * from c_cur where v_id='$v_id'");
							$get_link->setFetchMode(PDO:: FETCH_ASSOC);
							$get_link->execute();
							$row_link=$get_link->fetch();
							$link=$row_link['video'];

							if($up_v_tmp==""){	
								$update_cur=$con->prepare("update c_cur set v_title='$up_title' where u_id='$u_id' AND c_id='$c_id' AND v_id='$v_id'");
								if($update_cur->execute()){
									echo"<script>window.open('course_edit.php?course_lec&course_edit=$u','_self')</script>";	
								}
							}else{	
								$update_cur=$con->prepare("update c_cur set video='$up_v',v_title='$up_title' where u_id='$u_id' AND c_id='$c_id' AND v_id='$v_id'");
								if($update_cur->execute()){
									move_uploaded_file($up_v_tmp,"lecture/$up_v");
									echo"<script>window.open('course_edit.php?course_lec&course_edit=$u','_self')</script>";
								}
							}
						}
					}	
				//End CV	
				echo"</div><br clear='all' />";
				include("inc/footer.php");
				if(isset($_POST['c_len'])){
					$name=$_POST['c_name'];
					$img=$_FILES['c_img']['name'];
					$img_tmp=$_FILES['c_img']['tmp_name'];

					$up_title=$con->prepare("update course set title='$name' where course_id='$u' AND u_id='$u_id'");
					$up_title->execute();
					if($img_tmp==""){}else{
						move_uploaded_file($img_tmp,"imgs/courses/$img");

						$up_img=$con->prepare("update course set img='$img' where course_id='$u' AND u_id='$u_id'");
						if($up_img->execute()){}else{
							echo"<script>alert('Somthing Wrong Try Again')</script>";	
						}
					}
					echo"<script>window.open('course_edit.php?course_edit=$u','_self')</script>";
				}
		}
	}
	function get_all_cat(){
		include("inc/db.php");
		$get_cat=$con->prepare("select * from cat order by cat_name");
		$get_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cat->execute();
		
		while($row=$get_cat->fetch()):
			echo"<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
		endwhile;	
	}
	function get_all_sub_cat(){
		include("inc/db.php");
		$cat_id=$_POST['catId'];
		$get_sub_cat=$con->prepare("select * from sub_cat where cat_id='$cat_id'");
		$get_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$get_sub_cat->execute();
		
		while($row=$get_sub_cat->fetch()):
			echo"<option value='".$row['sub_cat_id']."'>".$row['sub_cat_name']."</option>";
		endwhile;	
	}
	function lang(){
		include("inc/db.php");
		$get_lang=$con->prepare("select * from lang");
		$get_lang->setFetchMode(PDO:: FETCH_ASSOC);
		$get_lang->execute();
		while($row=$get_lang->fetch()):
			echo"<option value='".$row['lang_id']."'>".$row['lang_name']."</option>";
		endwhile;	
	}
	function course_start(){
		include("inc/db.php");
		if(isset($_GET['u_course'])){
			if(!isset($_SESSION['email_u'])){
				header("Location:index.php");
			}
			$u_email=$_SESSION['email_u'];
			$get_user=$con->prepare("select * from user where u_email='$u_email'");
			$get_user->setFetchMode(PDO:: FETCH_ASSOC);
			$get_user->execute();
			$row_user=$get_user->fetch();
			$u_id=$row_user['u_id'];

			$course_name=$_GET['u_course'];
			$get_course=$con->prepare("select * from course where course_id='$course_name'");
			$get_course->setFetchMode(PDO:: FETCH_ASSOC);
			$get_course->execute();
			$row_course=$get_course->fetch();
			$course_id=$row_course['course_id'];
			$ins_id=$row_course['u_id'];
			$lang_id=$row_course['lang_id'];
			$cat_id=$row_course['cat_id'];
			$sub_cat_id=$row_course['sub_cat_id'];

			$check_payment=$con->prepare("select * from payment where u_id='$u_id' AND course_id='$course_id'");
			$check_payment->execute();
			$row_payment=$check_payment->rowCount();

			$get_ins=$con->prepare("select * from user where u_id='$ins_id'");
			$get_ins->setFetchMode(PDO:: FETCH_ASSOC);
			$get_ins->execute();
			$row_ins=$get_ins->fetch();
			
			$get_link=$con->prepare("select * from ins_links where u_id='$ins_id'");
			$get_link->setFetchMode(PDO:: FETCH_ASSOC);
			$get_link->execute();
			$row_links=$get_link->fetch();
			
			$get_lang=$con->prepare("select * from lang where lang_id='$lang_id'");
			$get_lang->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lang->execute();
			$row_lang=$get_lang->fetch();
			
			$get_cat_name=$con->prepare("select * from cat where cat_id='$cat_id'");
			$get_cat_name->setFetchmode(PDO:: FETCH_ASSOC);
			$get_cat_name->execute();
			$row_cat_name=$get_cat_name->fetch();
			
			$get_sub_cat_name=$con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
			$get_sub_cat_name->setFetchmode(PDO:: FETCH_ASSOC);
			$get_sub_cat_name->execute();
			$row_sub_cat_name=$get_sub_cat_name->fetch();
			
			$get_lec=$con->prepare("select * from c_cur where c_id='$course_id'");
			$get_lec->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lec->execute();
			$row_lec=$get_lec->rowCount();
			$i=1;
		if($row_payment==1){
		echo"<div id='crumb'>
				<p>
					<a href='index.php'>Home</a> <span>></span> 
					<a href='profile.php?my_course'>My Courses</a> <span>></span>
					".$row_course['title']."
				</p>
			</div>
			<div id='course_left'>
				<h1 id='cs_title'>".$row_course['title']."</h1>
				<img src='imgs/courses/".$row_course['img']."' />
				<div id='share'>
					<div id='f'>
						<a href='http://www.facebook.com/sharer.php?u=http://127.0.0.1/product?product=1' title='Facebook Share' target='_blank'><i class='fa fa-facebook' aria-hidden='true'></i> Share</a>
					</div>
					<div id='g'>
						<a href='http://plus.google.com/share?url=' target='_blank' title='Google Plus Share'><i class='fa fa-google-plus' aria-hidden='true'></i> Share</a>
					</div>
					<div id='t'>
						<a href='https://twitter.com/intent/tweet?text=Check Out This At' target='_blank' title='Twitter Tweet'><i class='fa fa-twitter' aria-hidden='true'></i> Tweet</a>
					</div>
					<div id='wp'>
						<a href='whatsapp://send?text=pro_name Pro_id' target='_blank'><i class='fa fa-whatsapp' aria-hidden='true'></i> Share</a>
					</div>
				</div>
			</div>
			<div id='course_right'>
				<h1>".$row_course['title']."</h1>
				<table>
					<tr><td>Instructor</td> <td>".$row_ins['u_name']."</td></tr>
					<tr><td>Enroll By</td> <td>".$row_course['enroll_by']."</td></tr>
					<tr><td>Lavel</td> <td>".$row_course['lvl']."</td></tr>
					<tr><td>Language</td> <td>".$row_lang['lang_name']."</td></tr>
					<tr><td>Lectures</td> <td>".$row_lec."</td></tr>
					<tr><td>Course Type</td> <td>".$row_course['type']."</td></tr>
					<tr><td>Course Category</td> <td>".$row_cat_name['cat_name']."</td></tr>
					<tr><td>Course Sub Category</td> <td>".$row_sub_cat_name['sub_cat_name']."</td></tr>
				</table>
			</div><br clear='all' />
			<div id='course_start'>
				<h1>Carriculmn</h1>
					<ul>";
					$i=1;
					while($row_l=$get_lec->fetch()):
						echo"<li>
								<p><i class='fa fa-video-camera' area-hidden='true'></i> ".$i++.". ".$row_l['v_title']."</p>
								<details>
									<summary><span>See Lecture</span></summary>
									<video src='lecture/".$row_l['video']."' controls='controls'></video>
								</details><br clear='all' />
							</li>";
					endwhile;
					echo"</ul><br clear='all' />
				<h1>Instructor</h1>";
				if($row_ins['u_img']==""){
					echo"<img src='imgs/user/default.png' />";
				}else{
					echo"<img src='imgs/user/".$row_ins['u_img']."' />";
				}
			echo"<p class='ins_det'>".$row_ins['u_bio']."</p>
				<div id='ins_share'>
					<div id='f'>
						<a href='https://www.facebook.com/".$row_links['fb_ins']."' title='Facebook Share' target='_blank'><i class='fa fa-facebook' aria-hidden='true'></i></a>
					</div>
					<div id='g'>
						<a href='https://plus.google.com/".$row_links['gp_ins']."' target='_blank' title='Google Plus Share'><i class='fa fa-google-plus' aria-hidden='true'></i></a>
					</div>
					<div id='t'>
						<a href='https://twitter.com/".$row_links['twitt_ins']."' target='_blank' title='Twitter Tweet'><i class='fa fa-twitter' aria-hidden='true'></i></a>
					</div>
					<div id='y'>
						<a href='https://www.youtube.com/".$row_links['yt_ins']."' target='_blank'><i class='fa fa-youtube' aria-hidden='true'></i></a>
					</div>
					<div id='web'>
						<a href='".$row_links['web']."' target='_blank'><i class='fa fa-globe' aria-hidden='true'></i></a>
					</div>
				</div><br clear='all' />
				<h1>Add Your Comment</h1>
				<form method='post'>
					<textarea placeholder='Add Your Comment' name='text_cmt'></textarea>
					<button name='add_cmt'>Comment</button>
				</form><br clear='all' />";
				if(isset($_POST['add_cmt'])){
					$cmt=$_POST['text_cmt'];
					$insert_cmt=$con->prepare("insert into comments(u_id,course_id,comment,comment_time)values('$u_id','$course_id','$cmt',NOW())");	
					if($insert_cmt->execute()){
						echo"<script>window.open('user_course.php?u_course=$course_id','_self');</script>";	
					}
				}	
			echo"<h1>Comments</h1>
				<table>";
					$get_cmt=$con->prepare("select * from comments where course_id='$course_id' ORDER BY 1 DESC");
					$get_cmt->setFetchMode(PDO:: FETCH_ASSOC);
					$get_cmt->execute();
					while($row_cmt=$get_cmt->fetch()):
						$cmt_img=$row_cmt['u_id'];
						
						$get_cmt_user=$con->prepare("select * from user where u_id='$cmt_img'");
						$get_cmt_user->setFetchMode(PDO:: FETCH_ASSOC);
						$get_cmt_user->execute();
						
						while($row_finle_img=$get_cmt_user->fetch()):
						echo"<tr>
								<td>";
								if($row_finle_img['u_img']==""){
									echo"<img src='imgs/user/default.png' />";
								}else{
									echo"<img src='imgs/user/".$row_finle_img['u_img']."' />";
								}
							echo"</td>
								<td><b>".$row_finle_img['u_name']."</b><p>".$row_cmt['comment']."</p></td>
							</tr>";
						endwhile;
					endwhile;
			echo"</table>
			</div>";
		}
		else{
			header("Location:index.php");	
		}
		}
	}
	function checkout(){
		include("inc/db.php");
		if(isset($_GET['sin_buy'])){
			$get_c_id=$_GET['sin_buy'];
			if(!isset($_SESSION['email_u'])){ 
				header("Location:index.php"); 
			}
			$get_u_course=$con->prepare("select * from course where course_id='$get_c_id'");
			$get_u_course->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u_course->execute();
			$row=$get_u_course->fetch();
			$c_id=$row['course_id'];
			$lang_id=$row['lang_id'];
			$ins_id=$row['u_id'];
			echo"<div id='crumb'>
					<p>
						<a href='index.php'>Home</a> <span>></span> 
						<a href='cart.php'>My Cart</a> <span>></span>
						".$row['title']."
					</p>
				</div>";
			$u_email=$_SESSION['email_u'];
			$ip=getIp();
			
			$get_u_name=$con->prepare("select * from user where u_email='$u_email'");
			$get_u_name->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u_name->execute();
			$row_user=$get_u_name->fetch();
			$u_id=$row_user['u_id'];

			$get_ins=$con->prepare("select * from user where u_id='$ins_id'");
			$get_ins->setFetchMode(PDO:: FETCH_ASSOC);
			$get_ins->execute();
			$row_ins=$get_ins->fetch();
			$ins=$row_ins['u_name'];
			
			$get_lang=$con->prepare("select * from lang where lang_id='$lang_id'");
			$get_lang->execute();
			$row_lang=$get_lang->fetch();
			$lang_name=$row_lang['lang_name'];
			
			$get_lec=$con->prepare("select * from c_cur where c_id='$c_id'");
			$get_lec->setFetchMode(PDO:: FETCH_ASSOC);
			$get_lec->execute();
			$row_lec=$get_lec->rowCount();
			
			$user_cart=$con->prepare("select * from user_cart where course_id='$c_id' AND u_id='$u_id'");
			$user_cart->setFetchMode(PDO:: FETCH_ASSOC);
			$user_cart->execute();
									
			if($user_cart->rowCount()==1){}else{
				$add_cart=$con->prepare("insert into user_cart(u_id,course_id,ip_add)values('$u_id','$c_id','$ip')");
				$add_cart->execute();	
			}
			echo"<div id='cart'>
				<table cellspacing='0'>
					<tr>
						<th id='cart_title'>Name</th>
						<th id='hidden'>Instructor</th>
						<th id='hidden'>Lectures</th>
						<th id='hidden'>Language</th>
						<th>Price</th>
					</tr>
					<tr>
						<td id='cart_title'>
							<img src='imgs/courses/".$row['img']."' />
							<p><a href='course_details.php?course_id=$get_c_id'>".$row['title']."</a></p>
							<span><a href='delete.php?del_cart=$get_c_id'><i class='fa fa-trash' area-hidden='true'></i> Remove</a></span>
						</td>
						<td id='hidden'>".$ins."</td>
						<td id='hidden'>".$row_lec."</td>
						<td id='hidden'>".$lang_name."</td>
						<td>$".$row['dis_price']."</td>
					</tr>					
					<tr>
						<td id='cart_title'><button><a href='index.php'>Keep Shopping</a></button></td>
						<td id='hidden'></td>
						<td id='hidden'></td>
						<td id='hidden' style='text-align:center;'>Amount Payable :</td>
						<td>$".$row['dis_price']."</td>
					</tr>
				</table>
				<h1>Payment Through</h1>
				<center>
					<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>	
					  <input type='hidden' name='business' value='azazpatel399@gmail.com'>	
					  <input type='hidden' name='cmd' value='_xclick'>
					  <input type='hidden' name='item_name' value='".$row['title']."'>
					  <input type='hidden' name='amount' value='".$row['dis_price']."'>
					  <input type='hidden' name='currency_code' value='USD'>					
					  <input type='hidden' name='return' value='http://127.0.0.1/Elearning_user/payment_success.php?sin_pay=".$row['course_id']."' />
					  <input type='hidden' name='cencle_return' value='http://127.0.0.1/Elearning_user/payment_cancle.php' />
					  <input type='image' name='submit' border='0' src='imgs/web_imgs/paypal.png' alt='Buy Now'>
					  <img alt='' border='0' width='1' height='1' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' >
					</form>
				</center>
			</div>";
		}else{
			echo cart();	
		}
	}
	function paypal_single(){
		$ip=getIp();
		include("inc/db.php");
		if(!isset($_SESSION['email_u'])){
			echo"<script>window.open('index.php','_self');</script>";	
		}
		$u_email=$_SESSION['email_u'];
		
		$get_user=$con->prepare("select * from user where u_email='$u_email'");
		$get_user->setFetchMode(PDO:: FETCH_ASSOC);
		$get_user->execute();
		$row_user=$get_user->fetch();
		$u_id=$row_user['u_id'];

		$u=$_GET['sin_pay'];			

		$get_price = $con->prepare("SELECT * FROM course WHERE course_id='$u'");
		$get_price->setFetchMode(PDO:: FETCH_ASSOC);
		$get_price->execute();
		$row_amt=$get_price->fetch();
		$item_number=$row_amt['course_id'];
		$amt=$row_amt['dis_price'];
		$currency_code = "USD";
		$trx_id="UNI".mt_rand()."NQU";
		$earn=$row_amt['total_earn'];
		$course_id=$row_amt['course_id'];
		$course_price=$row_amt['dis_price'];
		$dis_price=$course_price/2;
		$total_earn=$earn+$dis_price;
		$ins_id=$row_amt['u_id'];
		
		$check_data=$con->prepare("select * from payment where u_id='$u_id' AND course_id='$course_id'");
		$check_data->execute();
		$row_check=$check_data->rowCount();
		if($row_check==1){
			echo"<script>alert('You Aleardy Buy');</script>";
			header("Location:index.php");	
		}
		else{
			if($amt==$course_price || $u_email==$row_user['u_email']){
				$pandding="Pending";
				$complete="Complete";
				$type="Paypal";
				$add_to_payment=$con->prepare("insert into payment(amt,course_id,u_id,ins_id,trx_id,currency,payment_date,ins_status,user_status,payment_type,ip_add)
				values('$amt','$course_id','$u_id','$ins_id','$trx_id','$currency_code',NOW(),'$pandding','$complete','$type','$ip')");
				$add_to_payment->execute();
				
				$delete_cart=$con->prepare("delete from user_cart where course_id='$course_id' AND u_id='$u_id'");
				$delete_cart->execute();
				
				$enroll_up=$con->prepare("update course set enroll_by=enroll_by+1 where course_id='$course_id'");
				$enroll_up->execute();
				
				$up_total_earn=$con->prepare("update course set total_earn='$total_earn' where course_id='$course_id'");
				$up_total_earn->execute();
				
				echo"<script>window.open('profile.php?my_course','_self');</script>";
			}
			else{
				echo"<script>alert('Something Wrong Try Again');</script>";
				echo"<script>window.open('index.php','_self');</script>";	
			}
		}	
	}
	function u_pro_pic(){
		include("inc/db.php");
		if(isset($_SESSION['email_u'])){
			$u_email=$_SESSION['email_u'];
			$get_u_pic=$con->prepare("select * from user where u_email='$u_email'");
			$get_u_pic->setFetchMode(PDO:: FETCH_ASSOC);
			$get_u_pic->execute();
			$row=$get_u_pic->fetch();
			$u_img=$row['u_img'];
			if($u_img==''){
				echo "<img src='imgs/user/default.png' />";
			}
			else{
				echo "<img src='imgs/user/$u_img' />";
			}
		}	
	}
	function profile(){
		include("inc/db.php");
		if(!isset($_SESSION['email_u'])){
			header("Location:index.php");
		}
		$email=$_SESSION['email_u'];
		$get_u=$con->prepare("select * from user where u_email='$email'");
		$get_u->setFetchMode(PDO:: FETCH_ASSOC);
		$get_u->execute();
		$row=$get_u->fetch();
		$u_id=$row['u_id'];
		echo"<div id='profile_left'>
				<center>"; echo u_pro_pic(); echo"</center>
				<h1>Profile</h1>
				<ul>
					<li><a href='profile.php'><i class='fa fa-user' area-hidden='true'></i> My Account</a></li>
					<li><a href='profile.php?a_pass'><i class='fa fa-lock' area-hidden='true'></i> Change Password</a></li>
					<li><a href='profile.php?my_course'><i class='fa fa-book' area-hidden='true'></i> My Courses</a></li>
				</ul>";
				if($row['u_type']=="Instructor"){
				echo"<h1>Instructor</h1>
					<ul>
						<li><a href='profile.php?a_social'><i class='fa fa-globe' area-hidden='true'></i> Social Connect</a></li>
						<li><a href='profile.php?about_me'><i class='fa fa-info-circle' area-hidden='true'></i> About Me</a></li>
						<li><a href='profile.php?q_std'><i class='fa fa-graduation-cap' area-hidden='true'></i> Qualification</a></li>
					</ul>";
				}
		echo"</div>
			<div id='profile_right'>";
			if(!isset($_GET['a_pass']) && !isset($_GET['a_social']) && !isset($_GET['about_me']) && !isset($_GET['q_std']) && !isset($_GET['my_course'])){
			echo"<div class='crumb'>
					<p>
						<a href='index.php'>Home</a> <span>></span> 
						Profile
					</p>
				</div>
				<div id='my_ac'>
					<h3>My Account</h3>
					<form method='post' enctype='multipart/form-data'>
						<p><i class='fa fa-user' area-hidden='true'></i> Update Your Name</p>
						<div id='in_feild'>
							<i class='fa fa-user' area-hidden='true'></i>
							<input type='text' name='u_name' value='".$row['u_name']."' required='required' />
						</div>
						
						<p><i class='fa fa-phone' area-hidden='true'></i> Update Your Phone No.</p>
						<div id='in_feild'>
							<i class='fa fa-phone' area-hidden='true'></i>
							<input type='tel' name='u_phone' value='".$row['u_phone']."' required='required' />
						</div>
						
						<p><i class='fa fa-picture-o' area-hidden='true'></i> Update Your Picture</p>
						<div id='in_feild'>
							<i class='fa fa-picture-o' area-hidden='true'></i>
							<input type='text' name='u_img' placeholder='Click Here For Update Your Picture' class='form-control' onFocus='(this.type=\"file\")' />
						</div>
						<button name='up_ac'>Update</button>
					</form><br clear='all' />
				</div>";
				if(isset($_POST['up_ac'])){
					$name=$_POST['u_name'];
					$phone=$_POST['u_phone'];
					$img=$_FILES['u_img']['name'];
					$img_tmp=$_FILES['u_img']['tmp_name'];

					$up_img=$con->prepare("update user set u_name='$name',u_phone='$phone' where u_id='$u_id'");
					if($up_img->execute()){
						echo"<script>window.open('profile.php','_self');</script>";	
					}else{
						echo"<script>alert('Somthing Wrong Try Again')</script>";	
					}
					if($img_tmp==""){}else{
						$up_img=$con->prepare("update user set u_img='$img' where u_id='$u_id'");
						if($up_img->execute()){
							move_uploaded_file($img_tmp,"imgs/user/$img");
							echo"<script>window.open('profile.php','_self');</script>";	
						}else{
							echo"<script>alert('Somthing Wrong Try Again')</script>";	
						}
					}
				}
			}
			if(isset($_GET['a_pass'])){
			echo"<div class='crumb'>
					<p>
						<a href='index.php'>Home</a> <span>></span> 
						<a href='profile.php'>Profile</a> <span>></span>
						Change Password
					</p>
				</div>
				<div id='my_ac'>
					<h3>Change Password</h3>
					<form method='post'>
						<p><i class='fa fa-lock' area-hidden='true'></i> Enter Current Password</p>
						<div id='in_feild'>
							<i class='fa fa-lock' area-hidden='true'></i>
							<input type='password' required name='old_pass' placeholder='Enter Your Current Password' />
						</div>
						
						<p><i class='fa fa-lock' area-hidden='true'></i> Enter New Password</p>
						<div id='in_feild'>
							<i class='fa fa-lock' area-hidden='true'></i>
							<input type='password' required name='new_pass' placeholder='Enter Your New Password' />
						</div>
						
						<p><i class='fa fa-lock' area-hidden='true'></i> Confirm New Password</p>
						<div id='in_feild'>
							<i class='fa fa-lock' area-hidden='true'></i>
							<input type='password' required name='con_pass' placeholder='Confirm New Password' />
						</div>
						<button name='up_pass'>Update</button>
					</form>
				</div>";
				if(isset($_POST['up_pass'])){
					$old_pass=$_POST['old_pass'];
					$new_pass=$_POST['new_pass'];
					$con_pass=$_POST['con_pass'];
					$check_pass=$con->prepare("select * from user where u_email='$email' AND u_pass='$old_pass'");	
					$check_pass->setFetchMode(PDO:: FETCH_ASSOC);
					$check_pass->execute();
					$row_check=$check_pass->rowCount();

					if($row_check==1){
						if($new_pass==$con_pass){
							$up_pass=$con->prepare("update user set u_pass='$con_pass' where u_email='$email'");	
							if($up_pass->execute()){
								echo"<script>alert('Password updated Successfully‌');</script>";	
								echo"<script>window.open('profile.php?a_pass','_self')</script>";
							}	
						}
						else{
							echo"<script>alert('Password Does Not Matched‌');</script>";
							echo"<script>window.open('profile.php?a_pass','_self')</script>";
						}
					}
				}
			}

			if(isset($_GET['my_course'])){
				echo"<div class='crumb'>
						<p>
							<a href='index.php'>Home</a> <span>></span> 
							<a href='profile.php'>Profile</a> <span>></span>
							My Courses
						</p>
					</div>
					<div id='my_ac'>
						<h3>My Courses</h3><ul>";
						$get_course=$con->prepare("select * from payment where u_id='$u_id'");
						$get_course->setFetchMode(PDO:: FETCH_ASSOC);
						$get_course->execute();
						while($row_course=$get_course->fetch()):
							$course_id=$row_course['course_id'];
							$get_course_detail=$con->prepare("select * from course where course_id='$course_id'");
							$get_course_detail->setFetchMode(PDO:: FETCH_ASSOC);
							$get_course_detail->execute();
							while($row_course_detail=$get_course_detail->fetch()):
								$t_id=$row_course_detail['u_id'];
								$get_ins=$con->prepare("select * from user where u_id='$t_id'");
								$get_ins->setFetchMode(PDO:: FETCH_ASSOC);
								$get_ins->execute();
								$row_ins=$get_ins->fetch();
								echo"<li>
										<a href='user_course.php?u_course=".$row_course_detail['course_id']."'>";
											if($row_course_detail['img']==""){
												echo"<img src='imgs/courses/default.jpg' />";
											}else{
												echo"<img src='imgs/courses/".$row_course_detail['img']."' />";
											}
											echo"<p>".$row_course_detail['title']."</p>
											<h5>Teacher Name : ".$row_ins['u_name']."</h5>
											<p>Start watching ></p>
										</a>
									</li>";
							endwhile;
						endwhile;
					echo"</ul><br clear='all' />
					</div>";
			}
			//end of my course
			//start social section
			if(isset($_GET['a_social'])){
				$get_links=$con->prepare("select * from ins_links where u_id='$u_id'");
				$get_links->setfetchMode(PDO:: FETCH_ASSOC);
				$get_links->execute();
				$row_links=$get_links->fetch();
					
				$fb='http://www.facebook.com/';
				$twit='http://twitter.com/';
				$gp='https://plus.google.com/';
				$li='http://www.linkedin.com/';
				$yt='http://www.youtube.com/';
				
				echo"<div class='crumb'>
						<p>
							<a href='index.php'>Home</a> <span>></span> 
							<a href='profile.php'>Profile</a> <span>></span>
							Social Links
						</p>
					</div>
					<div id='my_ac'>
						<h3>Social Links</h3>
						<form method='post'>
							<p><i class='fa fa-globe' area-hidden='true'></i> Your Website Link</p>
							<div id='in_feild'>
								<i class='fa fa-globe' area-hidden='true'></i>
								<input value='".$row_links['web']."' type='url' required name='web_url' placeholder='Enter Your Website URL Here' />
							</div>
							
							<p><i class='fa fa-facebook' area-hidden='true'></i> https://facebook.com/</p>
							<div id='in_feild'>
								<i class='fa fa-facebook' area-hidden='true'></i>
								<input value='".$row_links['fb_ins']."' type='text' required name='fb' placeholder='Enter Your Facebook Page Or Username' />
							</div>
							
							<p><i class='fa fa-twitter' area-hidden='true'></i> https://twitter.com/</p>
							<div id='in_feild'>
								<i class='fa fa-twitter' area-hidden='true'></i>
								<input value='".$row_links['twitt_ins']."' type='text' required name='tw' placeholder='Enter Your Twitter Page Or Username' />
							</div>
							
							<p><i class='fa fa-google' area-hidden='true'></i> https://plus.google.com/</p>
							<div id='in_feild'>
								<i class='fa fa-google' area-hidden='true'></i>
								<input value='".$row_links['gp_ins']."' type='text' required name='gp' placeholder='Enter Your Google Plus Username' />
							</div>
							
							<p><i class='fa fa-linkedin' area-hidden='true'></i> https://linkedin.com/</p>
							<div id='in_feild'>
								<i class='fa fa-linkedin' area-hidden='true'></i>
								<input value='".$row_links['li_ins']."' type='text' required name='li' placeholder='Enter Your Linkedin Username' />
							</div>
							
							<p><i class='fa fa-youtube' area-hidden='true'></i> https://youtube.com/</p>
							<div id='in_feild'>
								<i class='fa fa-youtube' area-hidden='true'></i>
								<input value='".$row_links['yt_ins']."' type='text' required name='yt' placeholder='Enter Your Youtube Channel Username' />
							</div>
							<button name='up_social'>Update</button>
						</form>
					</div>";
				if(isset($_POST['up_social'])){
					$fb_up=$_POST['fb'];
					$twit_up=$_POST['tw'];
					$gp_up=$_POST['gp'];
					$li_up=$_POST['li'];
					$yt_up=$_POST['yt'];
					$web_up=$_POST['web_url'];
					$ins_links=$con->prepare("update ins_links set fb_ins='$fb_up',twitt_ins='$twit_up',gp_ins='$gp_up',li_ins='$li_up',yt_ins='$yt_up',web='$web_up' where u_id='$u_id'");
					if($ins_links->execute()){
						echo"<script>window.open('profile.php?a_social','_self');</script>";	
					}
				}				
			}
			if(isset($_GET['about_me'])){
				echo"<div class='crumb'>
					<p>
						<a href='index.php'>Home</a> <span>></span> 
						<a href='profile.php'>Profile</a> <span>></span>
						About Me
					</p>
				</div>
				<div id='my_ac'>
					<h3>About Me</h3>
					<form method='post'>
						<div id='bio'>
							<textarea name='ins_bio' placeholder='Write Somthing About You From Here' required='required'>".$row['u_bio']."</textarea>
						</div>
						<button name='ins_bio_update'>Update</button>
					</form>
				</div>";
				if(isset($_POST['ins_bio_update'])){
					$ins_bio=$_POST['ins_bio'];
					$ac_type="Instructor";
					$ins_bio_up=$con->prepare("update user set u_bio='$ins_bio' where u_email='$email' AND u_type='$ac_type'");	
					if($ins_bio_up->execute()){
						echo"<script>window.open('profile.php?about_me','_self');</script>";	
					}
					else{
						echo"<script>alert('Try Again')</script>";	
					}				
				}
			}
			if(isset($_GET['q_std'])){
				echo"<div class='crumb'>
						<p>
							<a href='index.php'>Home</a> <span>></span> 
							<a href='profile.php'>Profile</a> <span>></span>
							Qualification
						</p>
					</div>
					<div id='my_ac'>
						<h3>Qualification</h3>
						<form method='post'>
							<p><i class='fa fa-graduation-cap' aria-hidden='true'></i> Your Designation</p>
							<div id='in_feild'>
								<i class='fa fa-graduation-cap' area-hidden='true'></i>
								<input type='text' name='desig' placeholder='Enter Your Qualification' value='".$row['u_desig']."' required='required' />
							</div>
							
							<p><i class='fa fa-user' aria-hidden='true'></i> Your Full Name</p>
							<div id='in_feild'>
								<i class='fa fa-user' area-hidden='true'></i>
								<input type='text' name='ins_name' placeholder='Enter Your Full Name' value='".$row['u_name']."' required='required' />
							</div>
							
							<p><i class='fa fa-bullhorn' area-hidden='true'></i> Your Headline</p>
							<div id='in_feild'>
								<i class='fa fa-bullhorn' area-hidden='true'></i>
								<input type='text' name='head' placeholder='Headline Like Instructor At E Learning' value='".$row['u_head']."' required='required' />
							</div>
							<button name='up_ins_basic'>Update</button>
						</form>
					</div>";
				if(isset($_POST['up_ins_basic'])){
					$desig=$_POST['desig'];
					$ins_name=$_POST['ins_name'];
					$head=$_POST['head'];
					$ins="Instructor";
					$ins_basic=$con->prepare("update user set u_desig='$desig',u_name='$ins_name',u_head='$head' where u_email='$email' AND u_type='$ins'");	
					if($ins_basic->execute()){
						echo"<script>window.open('profile.php?q_std','_self');</script>";	
					}
				}	
			}
		echo"</div><br clear='all' />";
		include("inc/footer.php");
	}
?>