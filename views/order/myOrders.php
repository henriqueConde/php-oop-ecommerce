<?php if(isset($admin)) :?>
    <h1 class="text-align-center">Manage Orders</h1>
    <table style="margin-bottom: 20px;">
        <tr>
            <th>User ID</th>
            <th>Order ID</th>
            <th>Price</th>
            <th>Date</th>
            <th>State</th>
        </tr>

        
      <?php while($item = $res->fetch_object()):  ?>
            <tr>
                <td>
                <?= $item->user_id; ?>
                </td>
                <td>
                   <a style="color: blue;" title="click to see order details" href="<?=base_url?>order/orderDetails&id=<?=$item->id?>"><?=$item->id?></a> 
                </td>
                <td>
                    $<?= $item->total_price; ?>
                </td>
                <td>
                    <?= $item->date?>
                </td>
                <td>
                <?= $item->status?>
                </td>
            </tr>
       <?php endwhile; ?>
</table>

<?php else : ?>
    <h1 class="text-align-center">My Orders</h1>
    <table style="margin-bottom: 20px;">
        <tr>
            <th>Order ID</th>
            <th>Price</th>
            <th>Date</th>
            <th>State</th>
        </tr>

        
      <?php while($item = $res->fetch_object()):  ?>
            <tr>
                <td>
                   <a style="color: blue;" title="click to see order details" href="<?=base_url?>order/orderDetails&id=<?=$item->id?>"><?=$item->id?></a> 
                </td>
                <td>
                    $<?= $item->total_price; ?>
                </td>
                <td>
                    <?= $item->date?>
                </td>
                <td>
                <?= $item->status?>
                </td>
            </tr>
       <?php endwhile; ?>
</table>
<?php endif; ?>


