<?php if (!empty($_SESSION['cart'])): ?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Size</th>
                <th>Amount</th>
                <th>Price</th>
                <th><span class="fas fa-trash" aria-hidden="true"></span></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
            <tr>
                <td><a href="product/<?=$item['alias'];?>"><img src="img/<?=$item['img'];?>" alt="" height="50"></a></td>
                <td><a href="product/<?=$item['alias'];?>"><?=$item['title'];?></a></td>
                <td><?=strtoupper($item['size']);?></td>
                <td>
                    <span data-id="<?=$id;?>" class="fas fa-plus text-success qty-plus" aria-hidden="true" style="cursor:pointer"></span>
                    <span class="qty-item"><?=$item['qty'];?></span>
                    <span data-id="<?=$id;?>" class="fas fa-minus qty-minus" aria-hidden="true" style="cursor:pointer"></span>
                </td>
                <td><?=$item['price'] * $_SESSION['currency']['value'];?></td>
                <td><span data-id="<?=$id;?>" class="fas fa-trash text-danger del-item" aria-hidden="true" style="cursor:pointer"></span></td>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td>Amount:</td>
                <td colspan="5" class="text-right cart-qty"><?=$_SESSION['cart.qty'];?></td>
            </tr>
            <tr>
                <td>Total:</td>
                <td colspan="5" class="text-right cart-sum"><?=$_SESSION['cart.sum'] * $_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php else: ?>
<h5>Cart is empty</h5>
<?php endif; ?>