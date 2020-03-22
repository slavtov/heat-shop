<div class="clearfix mt-2">
    <div class="float-left">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Main</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
    </div>
    <div class="float-right">
        <form action="search" method="get" autocomplete="off">
            <div class="input-group">
                <input class="form-control round" type="search" name="q" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-primary round" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="products">
    <h2 class="mb-4">Checkout</h2>

    <!-- Success or Error report -->
    <?php getReport(); ?>

<?php if (!empty($_SESSION['cart'])): ?>
    <div class="table-responsive" id="cart-view">
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
                    <td colspan="5" class="text-right cart-sum">
                        <?=$_SESSION['cart.sum'] * $_SESSION['currency']['value'];?>
                        <?=$_SESSION['currency']['symbol'];?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        <a href="cart/checkout" class="btn btn-primary d-flex justify-content-end">Checkout</a>
    </div>
<?php else: ?>
    <h5>Cart is empty</h5>
<?php endif;?>
</div>