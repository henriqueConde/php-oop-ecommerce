
<div class="add-product-container">
<?php if(isset($edit) && isset($editProduct) && is_object($editProduct)):?>
    <h2>Edit Product - <?= $editProduct->name;?></h2>
    <?php $url_action = base_url."product/save&id=".$editProduct->id; ?>
<?php else : ?>
    <h2>Add Product</h2>
    <?php $url_action = base_url."product/save"; ?>
<?php endif; ?>

    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?=isset($editProduct) && is_object($editProduct) ? $editProduct->name : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description"><?=isset($editProduct) && is_object($editProduct) ? $editProduct->description : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" value="<?=isset($editProduct) && is_object($editProduct) ? $editProduct->price : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" value="<?=isset($editProduct) && is_object($editProduct) ? $editProduct->stock : ''; ?>">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category">
            <?php $categories = Utils::showCategories(); ?>
            <?php while($category = $categories->fetch_object()): ?>
                <option value="<?=$category->id?>" <?=isset($editProduct) && is_object($editProduct) && $category->id == $editProduct->category_id ? 'selected' : ''; ?>>
                    <?=$category->name?>
                </option>
            <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image">
        </div>
        <input type="submit" value="Add Product" class="btn btn-add-product"></input>
    </form>
</div>
