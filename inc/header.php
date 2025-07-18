<?php
	session_start();
	include("inc/function.php");
	echo login();
	if(!isset($_SESSION['email_u'])){
		$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
	}
	echo signup();
?>
<div id='header'>
	<div id='link'>
        <div id='header_link'>
            <?php echo web_link(); ?>
        </div>
        <div id='date'>
        	<p><?php echo date('l, d F Y') ?></p>
        </div>
        <div id='cart_link'>
        	<p>E-Learning Website</p>
        </div>
	</div>
	<div id='logo'>
		<a href='index.php'><img src="Logo.png"></a>
    </div>
    <div id='nav'>
    	<i class="fa fa-bars" aria-hidden="true"></i>
        <?php echo cat_menu(); ?>
    </div> 
    <div id='search'>
    	<form method="post" action="search.php">
        	<input type="text" name="user_query" required="required" pattern="[a-z A-Z]{0,30}" maxlength="30" placeholder="Search Courses From Here" />
            <button name="search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
    <div id='nav'>
    	<p><a href='cart.php'><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo cart_count(); ?></a></p>
    </div>
    <?php if(!isset($_SESSION['email_u'])){ ?>
    <div id='sign_link'>
    	<p><i class="fa fa-user-plus" aria-hidden="true"></i> <span>SignUp</span></p>
        <form method="post" id='login' class="login">
        	<center>
            	<h2><i class="fa fa-user-plus" aria-hidden="true"></i></h2>
            </center>
        	<h3>SignUp</h3>
            <div id='input_feild'>
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="name" name="u_name" placeholder="Enter Your Name" pattern='[a-z A-Z]{5,30}' maxlength='30' minlength='5' required='required' />
            </div>
        	<div id='input_feild'>
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <input type="email" name="u_email" placeholder="Enter Your Email" pattern='[0-9 a-z A-Z ^@._-]{10,30}' maxlength='30' minlength='10' required='required' />
            </div>
            <div id='input_feild'>
                <i class="fa fa-phone" aria-hidden="true"></i>
                <input type='tel' name='u_phone' placeholder="Enter Your Phone" pattern='[0-9]{10,15}' maxlength='15' minlength='10' required='required' />
            </div>
            <div id='input_feild'>
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" name="u_pass1" placeholder="Enter Your Password" maxlength='20' minlength='8' required='required' />
            </div>
            <div id='input_feild'>
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" name="u_pass2" placeholder="ReEnter Your Password" maxlength='20' minlength='8' required='required' />
            </div>
            <input id='log_btn' type="submit" name="signup" value="Signup" />
        </form>
    </div>
    <div id='sign_link'>
    	<p><i class="fa fa-user" aria-hidden="true"></i> <span>Login</span></p>
        <form method="post" id='login'>
        	<center>
            	<h2><i class="fa fa-user" aria-hidden="true"></i></h2>
            </center>
        	<h3>Login</h3>
        	<div id='input_feild'>
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="email" name="u_log" placeholder="Enter Your Email" />
            </div>
            <div id='input_feild'>
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" name="u_log_pass" placeholder="Enter Your Password" maxlength="20" minlength='8' />
            </div>
            <p id='for_text'>Forget Password ?</p><br clear="all" />
            <input id='log_btn' type="submit" name="login" value="Login" />
        </form>
    </div>
    <?php }else{ ?>
	<div id='sign_link' class="d_hidden">
		<p><i class="fa fa-user-plus" aria-hidden="true"></i></p>
	</div>
    <div id='h_ins'>
    	<?php echo h_link(); ?>
    </div>
    <div id='h_log'>
    	<p><i class="fa fa-user" aria-hidden="true"></i></p>
        <ul>
        	<li><a href='profile.php'><i class="fa fa-user" aria-hidden="true"></i> My Account</a></li>
            <li><a href='profile.php?my_course'><i class="fa fa-graduation-cap" aria-hidden="true"></i> My Courses</a></li>
            <li><a href='profile.php?a_pass'><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a></li>
            <li><a href='logout.php'><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
        </ul>
    </div>
    <?php } ?> 	
</div>