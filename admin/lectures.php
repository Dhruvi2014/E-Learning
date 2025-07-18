<html>
	<head>
    	<title>Firbun Learning</title>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="../css/font-awesome.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
         <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
        
        <script src="js/jquery.js"></script>
        <script src="js/cycle.js"></script>
        <script>
			$(document).ready(function(){
                $('#bodyright form table tr:even').css("background","#ccc");
				$('#bodyright form table tr:odd').css("background","#fff");
            });
        </script>
    </head>
    
    <body>
    	<?php
			include("inc/function.php"); 
			echo course_lecture(); 	
		?>
    </body>
</html>