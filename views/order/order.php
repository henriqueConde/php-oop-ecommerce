<?php if(!isset($_SESSION['identity'])): ?>
    <h3 class="table-align">Please, login to complete your purchase!</h3>
<?php else: ?>
    <div class="table-align">
        <button class="btn"><a href="<?=base_url?>/cart/index">Go Back To Cart</a></button>
    </div>
    <h1 class="text-align-center">Order Form</h1>
    <div class="order-form table-align">
        <form action="<?=base_url?>order/add" method="POST">
        <div class="form-group">
                <label for="city">Address:</label>
                <input type="text" name="address" id="address">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" name="city" id="city">
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" name="state" id="state">
            </div>
            <input type="submit" class="btn" value="Buy Now">
        </form>
    </div>
<?php endif; ?>