<?php echo add_sub_cat(); echo del_sub_cat(); ?>
<div id='bodyright'>
	<h3>View All Sub Categories</h3>
    <?php if(!isset($_GET['edit_sub_cat'])){ ?>
    <br /><details>
    	<summary>Add New Sub Category</summary><br />
        <form id='form' method="post" enctype="multipart/form-data">
        	<select name='cat_id' required>
            	<option value="">Select Category</option>
				<?php echo select_Cat(); ?>
            </select>
        	<input type="text" name="sub_cat_name" required placeholder="Enter Sub Category Name" />
        	<input type="text" name="sub_cat_icon" required placeholder="Enter Sub Category Icon Code" />
        	<button name='add_sub_cat'>Add Sub category</button>
        </form>
    </details>
    <?php }else{ echo edit_sub_cat(); } ?>
    <table id='cat' cellspacing="0">
    	<tr>
        	<th>Sr No.</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Action</th>
        </tr>
        <?php echo all_sub_cat(); ?>
    </table>
    </div>
</div>