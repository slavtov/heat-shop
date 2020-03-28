<!-- Error report -->
<?php getReport();?>

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
            <div class="col-md-3">
                <div class="list-group">
                    <a href="profile" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="profile/orders" class="list-group-item list-group-item-action">My orders</a>
                    <a href="profile/address" class="list-group-item list-group-item-action">Order address</a>
                    <a href="profile/edit" class="list-group-item list-group-item-action">Edit personal data</a>
                    <a href="profile/password" class="list-group-item list-group-item-action">Change password</a>
                </div>
            </div>
            <div class="col-md-9 float-right">
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-user"></i>&nbsp;Personal data</div>
                    <div class="card-body">
                        <div class="row">
                            <h5 class="col-6 text-right">Email</h5>
                            <p class="col-6"><?=$_SESSION['user']['email'];?></p>

                            <h5 class="col-6 text-right">Username</h5>
                            <p class="col-6"><?=$_SESSION['user']['username'];?></p>
                        </div>
                        <a href="profile/edit" class="btn btn-primary">Edit</a>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-address-card"></i>&nbsp;Address</div>
                    <div class="card-body">
                    <?php if ($address): ?>
                        <div class="row">
                            <h5 class="col-6 text-right">Name</h5>
                            <p class="col-6">
                                <?=$address['first_name'];?>
                                <?=$address['middle_name'];?>
                                <?=$address['last_name'];?>
                            </p>

                            <h5 class="col-6 text-right">Country</h5>
                            <p class="col-6"><?=$address['country'];?></p>

                            <h5 class="col-6 text-right">City / Region</h5>
                            <p class="col-6">
                                <?=$address['city'];?>,
                                <?=stristr($address['region'], 'region') === false ? $address['region'] . ' Region' : $address['region'];?>
                            </p>

                            <h5 class="col-6 text-right">Street</h5>
                            <p class="col-6"><?=$address['street'];?></p>

                            <h5 class="col-6 text-right">House / Apartment</h5>
                            <p class="col-6"><?=$address['house'];?><?=$address['apartment'] ? '/'.$address['apartment'] : null;?></p>

                            <h5 class="col-6 text-right">ZIP</h5>
                            <p class="col-6"><?=$address['zip'];?></p>
                        </div>
                        <a href="profile/address" class="btn btn-primary mt-3">My addresses</a>
                    <?php else: ?>
                        <h4 class="text-center">You have no addresses</h4>
                        <a href="address/add" class="btn btn-primary mt-3">Add an address</a>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-truck"></i>&nbsp;Recent orders</div>
                    <div class="card-body">
                    <?php if ($orders): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Status</th>
                                        <th>Order Time</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order): ?>
                                <?php
                                // Completed
                                $class	   = $order['status'] ? 'class="bg-success text-white"' : null;
                                $classHref = $order['status'] ? 'text-white' : null;
                                ?>
                                    <tr <?=$class;?>>
                                        <td><?=$order['id'];?></td>
                                        <td><?=$order['status'] ? 'Completed' : 'Order Processing'; ?></td>
                                        <td><?=$order['date'];?></td>
                                        <td><?=$order['qty'];?></td>
                                        <td><?=$order['sum'];?> <?=$order['currency'];?></td>
                                        <td class="text-center"><a href="profile/order?id=<?=$order['id'];?>"><i class="fa fa-eye <?=$classHref;?>"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="profile/orders" class="btn btn-primary">All orders</a>
                    <?php else: ?>
                        <p class="text-danger">You have no orders</p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>