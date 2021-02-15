<?php $lastOrder = $toFetch->fetch_object(); ?>
<style>
    span{
        font-weight: bold;
    }

    .product-group img, .product-group p{
        display: inline;
    }

    h4{
        margin-bottom: 0px;
    }
</style>

<h1 style="text-align: center;">Your Order</h1>
<hr>
<p><span>Order ID:</span> <?=$lastOrder->id?></p>
<p><span>Address:</span> <?=$lastOrder->address?>, <?=$lastOrder->city?>, <?=$lastOrder->state?></p>
<p><span>Order Date:</span> <?=$lastOrder->date?></p>
<p><span>Orer Time:</span> <?=$lastOrder->time?></p>


<div style="margin-top: 20px;">
        <?php if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }  
        ?> 
        <h2>Purchased Items</h2>       
         <?php if(isset($_SESSION['cart'])): 
          foreach($cart as $index => $product): 
            $item = $product['product'];        
            ?>

            
        
            <h4><span>Item <?=$index+1?>:</span>
                <a href="<?=base_url?>product/singleProduct&id=<?=$item->id?>"><?= $item->name; ?></a>
            </h4>
            <ul>
                <li>
                    <span>
                    Price:
                    </span>
                    <?= $item->price?>
                </li>
                <li>
                    <span>
                    Unities:
                    </span>
                    <?= $product['unities']?>
                </li>
            </ul>
        
            <?php endforeach;
        endif;
        ?>
    </div>

    <h3><span>Total price:</span> $<?=$lastOrder->total_price?></h3>
