<div class="cart-container">
    <h1 style="text-align: center">Cart</h1>
    <div class="table-align">

        <button class="btn">
            <a href="<?=base_url?>cart/delete">Empty Cart</a> 
        </button>
    </div>
    <table style="margin-bottom: 20px;">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Unities</th>
            <th>Remove</th>
        </tr>
        <?php if(isset($cart)):
        
        foreach($cart as $index => $product): 
            $item = $product['product'];        
            ?>
            <tr>
                <td>
                    <img width="115px;" src="<?=base_url?>/uploads/images/<?=$item->image?>" alt="product image"> 
                </td>
                <td>
                    <a href="<?=base_url?>product/singleProduct&id=<?=$item->id?>"><?= $item->name; ?></a>
                </td>
                <td>
                    <?= $item->price?>
                </td>
                <td>
                    <fieldset class="cart-unities-control">
                        <button class="decreaseButton minus" type="button"><a href="<?=base_url?>cart/minus&index=<?=$index?>">-</a></button>
                        <input type="text" name="quantity" value="<?= $_SESSION['cart'][$index]['unities']?>" />
                        <button class="increaseButton plus" type="button"><a href="<?=base_url?>cart/plus&index=<?=$index?>">+</a></button>
                    </fieldset>                    
                </td>
                <td>
                    <a href="<?=base_url?>cart/remove&index=<?=$index?>">
                        <i class="trash-icon fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach;
        endif;
        ?>
    </table>
    <?php  if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) :?>
        <div class="table-align total">
            <h3>Total:</h3>
            <?php $vals = Utils::valsCart();?>
            <p>$<?=number_format((float)$vals['total'], 2, '.', '');?></p>
        </div>
    <div class="table-align">
        <button class="btn">
            <a href="<?=base_url?>order/order">Checkout</a> 
        </button>
    </div>
    <?php endif; ?>
</div>