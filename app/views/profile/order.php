<!-- Success or Error report -->
<?php getReport(); ?>

<?php if (isset($_SESSION['form-data'])) unset($_SESSION['form-data']); ?>

<div class="card mx-auto mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title mb-5 float-left">My profile</h4>
            </div>
            <div class="col">
                <a href="user/logout" class="btn btn-sm btn-danger float-right">Log Out</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="list-group">
                    <a href="profile" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="profile/orders" class="list-group-item list-group-item-action active">My orders</a>
                    <a href="profile/address" class="list-group-item list-group-item-action">Order address</a>
                    <a href="profile/edit" class="list-group-item list-group-item-action">Edit personal data</a>
                    <a href="profile/password" class="list-group-item list-group-item-action">Change password</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-user"></i>&nbsp;Order #<?=$order['id'];?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>№</th>
                                        <td><?=$order['id'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?=$order['status'] ? 'Completed' : 'Order Processing';?></tr>
                                    <tr>
                                        <th>Order Time</th>
                                        <td><?=$order['date'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Update Time</th>
                                        <td><?=$order['update_at'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Note</th>
                                        <td><?=$order['note'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="profile/orders">Return to Orders</a>
                    </div>
                </div>
                <?php $address = unserialize($order['address']); ?>
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-address-card"></i>&nbsp;Address</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            <?=$address['first_name'];?>
                                            <?=$address['middle_name'];?>
                                            <?=$address['last_name'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td><?=$address['country'];?></td></tr>
                                    <tr>
                                        <th>City / Region</th>
                                        <td>
                                            <?=$address['city'];?>,
                                            <?=$address['region'];?> Region
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>House / Number</th>
                                        <td><?=$address['house'];?><?=$address['apartment'] ? '/'.$address['apartment'] : null;?></td>
                                    </tr>
                                    <tr>
                                        <th>ZIP</th>
                                        <td><?=$address['zip'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-truck"></i>&nbsp;Products</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Amount</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orderProducts as $product): ?>
                                    <tr>
                                        <td>
                                            <img src="<?=PATH;?>/img/<?=$product['img'];?>" height="50">
                                            <?=$product['title'];?>
                                        </td>
                                        <td><?=strtoupper($product['size']);?></td>
                                        <td><?=$product['qty'];?></td>
                                        <td><?=$product['price'];?></td>
                                        <td><?=$product['price']*$product['qty'];?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr class="bg-light">
                                        <td colspan="2"><b>Total:</b></td>
                                        <td><b><?=$order['qty'];?></b></td>
                                        <td colspan="3" class="text-center">
                                            <b><?=$order['sum'];?> <?=$order['currency'];?></b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>