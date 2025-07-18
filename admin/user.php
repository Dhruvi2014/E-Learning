<div id='bodyright'>
	<?php if(isset($_GET['user_search'])){ ?>
    <h3>Advance User Search</h3>
    <form style='margin-top:100px' id='course_search' method="post" enctype="multipart/form-data" action="user_search.php">
        <center>
            <input maxlength="100" pattern='[a-z A-Z]{3,100}' type="text" name="u_name" title="Enter Atleast 3 Characters, Maximim 100 Characters Allowed, Special Characters Not Allowed" placeholder="Search Any User By Name, User Email Or User Phone No." />
            <input type="email" name="u_email" placeholder="Search By Email" />
            <input type="tel" name="u_phone" placeholder="Search By Phone" />
            <select name='u_type'>
                <option value="">Select Account Type</option>
                <option value="Student">Student</option>
                <option value="Instructor">Instructor</option>
            </select>
            <input type="submit" name="user_search" value="Search" />
    	</center>
    </form>
    <form style='margin-top:50px' id='course_search' method="post" enctype="multipart/form-data" action="user_search.php">
        <center>
            <h4>Users Register Between</h4>
            <input type="date" name="first_date" /> <span style="font-size:12px">To</span>
            <input type="date" name="last_date" />
            <input id='user_reg_date' type="submit" name="between_date" value="Search" />
        </center>
    </form>
    <?php }else{ echo user(); } ?>
</div>