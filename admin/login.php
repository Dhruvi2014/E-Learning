<?php session_start(); include("inc/function.php"); echo login(); ?>
<html>
	<head>
    	<title>E Learning | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="../css/font-awesome.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <style>
        	@font-face{src:url(../fonts/Ubuntu-L.ttf); font-family:ubuntu;}
			*{margin:0; padding:0; font-family:ubuntu}
			body{background:linear-gradient(90deg, #0CF, #66F 30%, #66f 30%, #F0F); height:100%; width:100%; overflow:hidden}
			
			#login{box-shadow:0px 0px 30px #2e2e2e; width:27%; border-radius:15px; background:#fff; padding:3%; box-sizing:border-box; margin:auto !important; margin-top:10% !important}
			#login h2{box-shadow:0px 0px 30px #2e2e2e; height:130px; width:130px; color:#fff; border-radius:100%; color:#f0f; background:linear-gradient(75deg, #0CF, #66F 40%, #66f 30%, #F0F); text-shadow:1px 1px 1px #000; font-weight:bolder !important; text-align:center; margin:-35% 25% 20% 28%;}
			#login h2 i{line-height:130px; color:#fff; font-size:60px !important;}
			#login h3{text-align:center; font-size:30px; font-weight:bold; color:#333; margin-bottom:20%; margin-top:5%}
			#for_text{color:#666; font-weight:bold; font-size:14px; margin-bottom:10%; margin-top:3%}
			#for_text:hover{cursor:pointer}
			
			#sign_text{text-align:center; margin-top:15%; color:#666; font-weight:bold; font-size:14px; margin-bottom:3%;}
			
			#input_feild{transition:all 0.5s ease-in-out; border-bottom:1px solid #999; height:40px; line-height:35px; width:100%; margin-bottom:5%;}
			#input_feild i{color:#f0f; width:5%;}
			#input_feild input{width:88%; height:40px; outline:none; border-width:0px; padding-left:4%}
			#input_feild:hover{border-color:#f0f}
			
			#btn{width:100%; color:#fff; height:35px; border-radius:20px; outline:none; border-width:0px; 
			background:linear-gradient(75deg, #0CF, #66F 40%, #66f 30%, #F0F); font-weight:bold}
			#btn:hover{cursor:pointer}
        </style>
    </head>
    
    <body>
    	<div id='login'>
        	<h2><i class="fa fa-user-secret" aria-hidden="true"></i></h2>
            <h3 style="display:none;">Login</h3>
            <form method="post">
            	<div id='input_feild'>
                	<i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="a_name" autocomplete="off" maxlength="20" pattern="[a-z A-Z]{1,20}" required placeholder="Enter Your Name" />
                </div>
            	<div id='input_feild'>
                	<i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" name="a_email" autocomplete="off" maxlength="50" pattern="[0-9 a-z A-Z ^@_.]{1,50}" required placeholder="Enter Your Email" />
                </div>
                <div id='input_feild'>
                	<i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" name="a_pass" maxlength="30" pattern="[0-9 a-z A-Z ^_@]{1,30}" required placeholder="Enter Your Password" />
                </div>
                <p id='for_text'>Forget Password ? Contact Developer To reset</p><br clear="all" />
            	<input id='btn' type="submit" name="login" value="Login" />
            </form>        	
        </div>
    </body>
</html>