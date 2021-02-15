<h1 class="text-align-center">Order Details</h1>

<?php
$lastOrder = $lastRes->fetch_object();
?>

<?php if(isset($_SESSION['admin'])): ?>
    <h2 class="table-align">Change Order Status</h2>
    <form style="margin-bottom: 20px;" class="table-align" action="<?=base_url?>order/status" method="POST">
    <div class="form-group">
        <input type="text" class="hidden" name="orderId" value="<?=$lastOrder->id?>">
        <select name="status" style="width: 35%" id="order-status">
            <option value="confirmed" <?=$lastOrder->status == "confirmed" ? 'selected' : ''?>>Confirmed to be delivered</option>
            <option value="processing" <?=$lastOrder->status == "processing" ? 'selected' : ''?>>Being processed</option>
            <option value="sent" <?=$lastOrder->status == "sent" ? 'selected' : ''?>>Already sent</option>
            <option value="delivered" <?=$lastOrder->status == "delivered" ? 'selected' : ''?>>Order delivered</option>
        </select>
    </div>   
    <div>
        <input type="submit" value="Change Status" class="btn">
    </div>
    </form>
<?php endif; ?>

<div class="order-details-container" style="margin-bottom: 50px;">
        <h2 class="table-align">Order Info</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Delivery Address</th>
                <th>Date</th>
                <th>Time</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
            <tr>
                <td><?=$lastOrder->id;?></td>
                <td><?=$lastOrder->address;?></td>
                <td><?=$lastOrder->date;?></td>
                <td><?=$lastOrder->time;?></td>
                <td>$<?=$lastOrder->total_price;?></td>
                <td><?=$lastOrder->status;?></td>
            </tr>
        </table>
   


    <h2 class="table-align" style="margin-top: 20px;">Products Info</h2>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Unities</th>
        </tr>
        <?php while($item = $products->fetch_object()) :?>
            <tr>
                <td>
                    <img width="115px;" src="<?=base_url?>/uploads/images/<?=$item->image?>" alt="product image"> 
                </td>
                <td>
                    <a style="color: blue" href="<?=base_url?>product/singleProduct&id=<?=$item->id?>"><?= $item->name; ?></a>
                </td>
                <td>
                    $<?= $item->price?>
                </td>
                <td>
                    <?= $item->unities;?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

