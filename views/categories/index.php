<div class="category-container">
    <h2 style="text-align: center">Manage Categories</h2>
    <div class="add-category">
        <button class="btn add-category"><a href="<?=base_url?>category/create">Add Category</a> </button>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        
        <?php while($category = $categories->fetch_object()): ?>
        <tr>
            <td><?=$category->id;?></td>
            <td><?=$category->name;?></td>
            <td>
                <a href="<?=base_url?>category/delete&id=<?=$category->id;?>"><i class="trash-icon fas fa-trash"></i></a>
                <a href="<?=base_url?>category/edit&id=<?=$category->id;?>"><i class="edit-icon fas fa-edit"></i></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>


