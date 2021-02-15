    <!-- Hero Area  -->
    <section class="hero">
        <div class="hero-img">
            <h2>What would a <span class="green">Vegan</span> eat?</h2>
        </div>
    </section>

    <!-- Products Area  -->
    <section class="products">
        <div class="products-title">
            <h2>Products</h2>
        </div>
        <div class="products-display">
            <?php while ($product = $products->fetch_object()):?>
            <div class="product">
                <div class="product-img" style="background-image: url('<?=base_url?>uploads/images/<?=$product->image?>');">
                    <!-- <img src="write base url here!!! assets/img/product1.png" alt="product image"> -->
                </div>
                <div class="product-title">
                    <h4><?=$product->name?></h4>
                </div>
                <div class="product-title">
                    <p>$<?=$product->price?></p>
                </div>
                <div class="product-description">
                    <p>
                        <?=$product->description?>
                    </p>
                </div>
                <button class="btn btn-see-more"><a href="<?=base_url?>product/singleProduct&id=<?=$product->id?>">See more</a> </button>
            </div>
            <?php endwhile; ?>         
        </div>
    </section>