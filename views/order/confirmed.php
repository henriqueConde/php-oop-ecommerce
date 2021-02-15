<?php if(isset($_SESSION['order']) && $_SESSION['order' ]== "completed"): ?>
    <div class="confirmed-container">
        <h1 class="text-align-center">Order Confirmed</h1>
        <h4 class="table-align">Your order has been successful! Here are the info:</h4>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Delivery Address</th>
                <th>Date</th>
                <th>Time</th>
                <th>Total Price</th>
            </tr>
            <tr>
                <?php $lastOrder = $lastOrder->fetch_object(); ?>
                <td><?=$lastOrder->id;?></td>
                <td><?=$lastOrder->address;?></td>
                <td><?=$lastOrder->date;?></td>
                <td><?=$lastOrder->time;?></td>
                <td><?=$lastOrder->total_price;?></td>
            </tr>
        </table>
        <div class="table-align">
            <button class="btn">
                <a href="<?=base_url?>order/toDownload">
                    Download Confirmation
                </a>
            </button>
        </div>
    </div>
<?php elseif(isset($_SESSION['order']) && $_SESSION['order' ] != "completed"):?>
    <h3 class="table-align">Sorry, your order could not be processed.</h3>
<?php endif; ?>