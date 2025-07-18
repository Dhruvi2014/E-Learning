<html>
    <head>
    	<title>Untitled Document</title>
        <link rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/cycle.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('tr:even').css("background-color","#ccc");
			});
		</script>
	</head>
	<body>
           <div id="bodyright">
        		<h3>Edit Image Slider</h3>
                <form method="post" enctype="multipart/form-data" action="index.php?img_slider">
                	<table cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td>Select Slide 1 : </td>
                            <td><input type="file" name="slide1" /></td>
                        </tr>
                        <tr>
                        	<td>Select Slide 2 : </td>
                            <td><input type="file" name="slide2" /></td>
                        </tr>
                        <tr>
                        	<td>Select Slide 3 : </td>
                            <td><input type="file" name="slide3" /></td>
                        </tr>
                        <tr>
                        	<td>Select Slide 4 : </td>
                            <td><input type="file" name="slide4" /></td>
                        </tr>
                        <tr>
                        	<td>Select Slide 5 : </td>
                            <td><input type="file" name="slide5" /></td>
                        </tr>
                        <tr>
                        	<td>Select Slide 6 : </td>
                            <td><input type="file" name="slide6" /></td>
                        </tr>
                    </table>
                    <center><input id='btn' type="submit" name="up_slider" value="Update" /></center>
                </form>
           </div><br clear="all" />
   </body>
</html>
<?php include("inc/function.php"); echo img_slider(); ?>