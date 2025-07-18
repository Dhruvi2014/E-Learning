<div id='bodyleft'>
	<h3><i class="fa fa-cog" aria-hidden="true"></i> Categories Managment</h3>
    <ul>
    	<li><a href="index.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> Dashboard</a></li>
    	<li><a href="index.php?cat"><i class="fa fa-th-large" aria-hidden="true"></i> View Course Categories</a></li>
        <li><a href="index.php?sub_cat"><i class="fa fa-th-list" aria-hidden="true"></i> View Course Sub Categories</a></li>
    </ul>
    <h3><i class="fa fa-cog" aria-hidden="true"></i> Course Management</h3>
    <ul>
    	<li><a href="index.php?a_course"><i class="fa fa-book" aria-hidden="true"></i> View All Active Courses</a></li>
        <li><a href="index.php?p_course"><i class="fa fa-clock-o" aria-hidden="true"></i> View All Pendding Courses</a></li>
    	<li><a href="index.php?u_course"><i class="fa fa-pause" aria-hidden="true"></i> View All Unpublish Courses</a></li>
        <li><a href="index.php?course_search"><i class="fa fa-search" aria-hidden="true"></i> Advaced Course Search</a></li>
    </ul>
    <h3><i class="fa fa-cog" aria-hidden="true"></i> User Management</h3>
    <ul>
    	<li><a href='index.php?stud'><i class="fa fa-users" aria-hidden="true"></i> View All Students</a></li>
        <li><a href='index.php?ins'><i class="fa fa-graduation-cap" aria-hidden="true"></i> View All Teachers</a></li>
        <li><a href='index.php?user_search'><i class="fa fa-search" aria-hidden="true"></i> Advaced User Search</a></li>
    </ul>
    <h3><i class="fa fa-money" aria-hidden="true"></i> Payment Management</h3>
    <ul>
    	<li><a href='index.php?pen_ord'><i class="fa fa-users" aria-hidden="true"></i> Pay To Instructor</a></li>
        <li><a href='index.php?comp_ord'><i class="fa fa-user-md" aria-hidden="true"></i> View All Complete Orders</a></li>
    </ul>
    <h3><i class="fa fa-cog" aria-hidden="true"></i> Page Management</h3>
    <ul>
		<li><a href='index.php?view_lang'><i class="fa fa-picture-o" aria-hidden="true"></i> View All Languages</a></li>
    	<li><a href='index.php?terms'><i class="fa fa-paper-plane" aria-hidden="true"></i> Terms & Conditions Page</a></li>
        <li><a href='index.php?contact'><i class="fa fa-phone" aria-hidden="true"></i> Contact Us Page</a></li>
    	<li><a href='index.php?about'><i class="fa fa-comments" aria-hidden="true"></i> About Us Page</a></li>
        <li><a href='index.php?faqs'><i class="fa fa-comments" aria-hidden="true"></i> FAQs Page</a></li>
        <li><a href='index.php?slider'><i class="fa fa-picture-o" aria-hidden="true"></i> Edit Slider</a></li>
    </ul>
</div>
<?php 
	if(isset($_GET['cat'])){
		include("cat.php");	
	}
	elseif(isset($_GET['view_lang'])){
		include("lang.php");
	}elseif(isset($_GET['sub_cat'])){
		include("sub_cat.php");
	}elseif(isset($_GET['a_course']) || isset($_GET['p_course']) || isset($_GET['u_course']) || isset($_GET['course_search']) ){
		include("course.php");
	}elseif(isset($_GET['stud']) || isset($_GET['ins']) || isset($_GET['user_search']) ){
		include("user.php");
	}elseif(isset($_GET['pen_ord']) || isset($_GET['comp_ord']) ){
		include("order.php");	
	}elseif(isset($_GET['terms'])){
		include("terms.php");
	}elseif(isset($_GET['contact'])){
		include("contact.php");
	}elseif(isset($_GET['about'])){
		include("about.php");
	}elseif(isset($_GET['faqs'])){
		include("faqs.php");	
	}elseif(isset($_GET['slider'])){
		include("img_slider.php");	
	} 
	
?>