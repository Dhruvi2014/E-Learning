<?php echo add_lang(); echo del_lang(); ?>
<div id='bodyright'>
	<h3>View All Categories</h3>
    <?php if(!isset($_GET['edit_lang'])){ ?>
    <br /><details>
    	<summary>Add New Language</summary><br />
        <form id='form' method="post" enctype="multipart/form-data">
        	<input type="text" name="lang_name" required placeholder="Enter Language Name" />
        	<button name='add_lang'>Add Language</button>
        </form>
    </details>
    <?php }else{ echo edit_lang(); } ?>
    <table id='cat' cellspacing="0">
    	<tr>
        	<th>Sr No.</th>
            <th>Language</th>
            <th>Edit</th>
			<th>Delete</th>
        </tr>
        <?php echo all_lang(); ?>
    </table>
    </div>
</div>