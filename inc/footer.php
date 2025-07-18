<div id='footer'>
	<?php
		include("inc/db.php");
		$get_about=$con->prepare("select * from about_us");
		$get_about->setFetchMode(PDO:: FETCH_ASSOC);
		$get_about->execute();
		$row_a=$get_about->fetch();
		
		$get_info=$con->prepare("select * from contact_us");
		$get_info->setFetchMode(PDO:: FETCH_ASSOC);
		$get_info->execute();
		$row=$get_info->fetch();
	?>
	<ul>
    	<li>
        	<h2><span>Abo</span>ut Us</h2>
            <p><?php echo $row_a['about']; ?></p>
        </li>
        <li>
            <h2><span>Con</span>tact Us</h2>
            <table>
            	<tr>
                	<td><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                    <td><p><?php echo $row['add1']; ?> <?php echo $row['add2']; ?></p></td>
                </tr>
                <tr>
                	<td><i class="fa fa-phone" aria-hidden="true"></i></td>
                    <td><p><?php echo $row['phone_no']; ?></p></td>
                </tr>
                <tr>
                	<td><i class="fa fa-envelope" aria-hidden="true"></i></td>
                    <td><p><?php echo $row['email']; ?></p></td>
                </tr>
            </table>
            <div id='ins_share'>
                <div style="box-shadow:none; width:40px" id='f'><a href='http://www.facebook.com/<?php echo $row['fb']; ?>' title='Facebook Share' target='_blank'><i class='fa fa-facebook' style='color: #fff;' aria-hidden='true'></i></a></div>
				<div style="box-shadow:none; width:40px" id='g'><a href='http://plus.google.com/<?php echo $row['gp']; ?>' target='_blank' title='Google Plus Share'><i class='fa fa-google-plus' style='color: #fff;' aria-hidden='true'></i></a></div>
				<div style="box-shadow:none; width:40px" id='t'><a href='https://twitter.com/<?php echo $row['tw']; ?>' target='_blank' title='Twitter Tweet'><i class='fa fa-twitter' style='color: #fff;' aria-hidden='true'></i></a></div>
			</div>
        </li>
        <li>
        	<h2><span>Get</span> in Touch</h2>
            <form method="post">
            	<div id='input_field'>
                	<i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="u_name" placeholder="Enter Your Name" />
                </div>
                <div id='input_field'>
                	<i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" name="u_email" placeholder="Enter Your Email" />
                </div>
                <textarea name='u_msg' placeholder="Enter Your Message"></textarea>
                <button id='t' name='send'>Send</button>
            </form>
        </li><br clear="all" />
    </ul>
    <h3>All Rights Reserve To E-Learning</h3>
</div>