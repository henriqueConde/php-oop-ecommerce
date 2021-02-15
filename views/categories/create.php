<div class="create-category-container">
<?php if(isset($edit) && isset($editCategory) && is_object($editCategory)):?>
    <h2>Edit Category - <?= $editCategory->name;?></h2>
    <?php $url_action = base_url."category/save&id=".$editCategory->id; ?>
<?php else : ?>
    <h2>Add Category</h2>
    <?php $url_action = base_url."category/save"; ?>
<?php endif; ?>

    <form action="<?=$url_action?>" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>            
            <input type="text" name="name" required value="<?=isset($editCategory) && is_object($editCategory) ? $editCategory->name : ''; ?>">
        </div>
        <input type="submit" class="btn" value="<?=isset($editCategory) && is_object($editCategory) ? 'Edit Category' : 'Create Category'; ?>">   
    </form>
</div>
