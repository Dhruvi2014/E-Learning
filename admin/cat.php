<?php echo add_cat(); echo del_cat(); ?>
<div id='bodyright'>
	<h3>View All Categories</h3>
    <?php if(!isset($_GET['edit_cat'])){ ?>
    <br /><details>
    	<summary>Add New Category</summary><br />
        <form id='form' method="post" enctype="multipart/form-data">
        	<input type="text" name="cat_name" required placeholder="Enter Category Name" />
        	<input type="text" name="cat_icon" required placeholder="Enter Category Icon Code" />
        	<button name='add_cat'>Add category</button>
        </form>
    </details>
    <?php }else{ echo edit_cat(); } ?>
    <table id='cat' cellspacing="0">
    	<tr>
        	<th>Sr No.</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        <?php echo all_cat(); ?>
    </table>
    </div>
</div>