<?php if(isset($singleProduct)): ?>
    <h1 style="text-align: center;"><?=ucfirst($singleProduct->name);?></h1>
    <div class="single-product-display">
    </div>       
<?php else: ?>
    <h1>No product found...</h1>
<?php endif; ?>



<div class="single-product-container">
    <div class="single-feature-img" style="background-image: url('<?=base_url?>uploads/images/<?=$singleProduct->image;?>');">

    </div>
    <div class="single-details">
        <div class="description">
            <p><?=$singleProduct->description;?></p>
        </div>
        <div class="sinlge-price">
            <p>$<?=$singleProduct->price;?></p>
        </div>
        <button class="btn btn-add-cart"><a href="<?=base_url?>cart/add&id=<?=$singleProduct->id;?>">Add To Cart</a> </button>
    </div>
</div>