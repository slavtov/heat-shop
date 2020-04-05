<!-- Success or Error report -->
<!-- <?php getReport(); ?> -->

<div class="card mx-auto mt-4">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12 col-md-2 col-lg-2">
                <h4 class="card-title float-left">Admin Panel</h4>
            </div>
            <div class="col-8 col-md-6 col-lg-6">
                <?php if($order['status']): ?>
                <a href="<?=ADMIN;?>/order/update?id=<?=$order['id'];?>&status=0" class="btn btn-secondary mr-1">Return</a>
                <?php else: ?>
                <a href="<?=ADMIN;?>/order/update?id=<?=$order['id'];?>&status=1" class="btn btn-success mr-1">Confirm</a>
                <?php endif; ?>
                <a href="<?=ADMIN;?>/order/delete?id=<?=$order['id'];?>" class="btn btn-danger delete">Delete</a>
            </div>
            <div class="col-4">
                <a href="user/logout" class="btn btn-sm btn-danger float-right">Log Out</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 mb-4">
                <div class="list-group">
                    <a href="<?=ADMIN;?>" class="list-group-item list-group-item-action border-0 rounded">Dashboard</a>
                    <a href="<?=ADMIN;?>/order" class="list-group-item list-group-item-action border-0 rounded active">Orders</a>
                    <a href="<?=ADMIN;?>/product" class="list-group-item list-group-item-action border-0 rounded">Products</a>
                    <a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded">Users</a>
                    <a href="<?=ADMIN;?>/category" class="list-group-item list-group-item-action border-0 rounded">Categories</a>
                    <a href="<?=ADMIN;?>/cache" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                    <a href="<?=ADMIN;?>/question" class="list-group-item list-group-item-action border-0 rounded">Questions</a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card mb-4">
                    <div class="card-header">Order №<?=$order['id'];?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td><?=$order['id'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Customer</th>
                                        <td><?=$order['username'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?=$order['status'] ? 'Completed' : 'New';?></td>
                                    </tr>
                                    <tr>
                                        <th>Created at</th>
                                        <td><?=$order['date'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Updated at</th>
                                        <td><?=$order['update_at'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Qty</th>
                                        <td><?=$order['qty'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td><?=$order['sum'];?> <?=$order['currency'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Note</th>
                                        <td><?=$order['note'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php $address = unserialize($order['address']); ?>
                <div class="card mb-3">
                    <div class="card-header">Address</div>
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

                <div class="card mb-5">
                    <div class="card-header">Products</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orderProducts as $product): ?>
                                    <tr>
                                        <td><b><?=$product['id'];?></b></td>
                                        <td><img src="<?=PATH;?>/img/<?=$product['img'];?>" height="50"><?=$product['title'];?></td>
                                        <td><?=$product['qty'];?></td>
                                        <td><?=$product['price'];?></td>
                                        <td><?=$product['price']*$product['qty'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                                    <tr class="bg-light">
                                        <td colspan="2"><b>Total:</b></td>
                                        <td><b><?=$order['qty'];?></b></td>
                                        <td colspan="2" class="text-center"><b><?=$order['sum'];?> <?=$order['currency'];?></b></td>
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