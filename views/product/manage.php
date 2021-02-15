<div class="product-container">
    <h2 style="text-align: center">Manage Products</h2>
    <div class="add-product">
        <button class="btn add-product"><a href="<?=base_url?>product/create">Add Product</a> </button>

        <!-- feedback display when adding product -->
        <?php if(isset($_SESSION['product']) && $_SESSION['product'] == "completed"): ?>
            <p>Product successfully added!</p>
            <?php elseif(isset($_SESSION['product']) && $_SESSION['product'] !== "completed"): ?>
            <p style="color: red;">Product could not be added!</p>
        <?php endif; ?>
        <?php Utils::deleteSession('product'); ?>

        <!-- feedback display when deleting product -->
        <?php if(isset($_SESSION['deleted']) && $_SESSION['deleted'] == "completed"): ?>
            <p>Successfully deleted!</p>
            <?php elseif(isset($_SESSION['deleted']) && $_SESSION['deleted'] !== "completed"): ?>
            <p style="color: red;">Delete failed!</p>
        <?php endif; ?>
        <?php Utils::deleteSession('deleted'); ?>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        
        <?php while($product = $products->fetch_object()): ?>
        <tr>
            <td><?=$product->id;?></td>
            <td><?=$product->name;?></td>
            <td><?=$product->price;?></td>
            <td><?=$product->stock;?></td>
            <td>
                <a href="<?=base_url?>product/delete&id=<?=$product->id;?>"><i class="trash-icon fas fa-trash"></i></a>
                <a href="<?=base_url?>product/edit&id=<?=$product->id;?>"><i class="edit-icon fas fa-edit"></i></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>