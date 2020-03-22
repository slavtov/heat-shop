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
                    <div class="card-header"><i class="fas fa-truck"></i>&nbsp;Orders</div>
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
                                        <td class="text-center"><a href="profile/order?id=<?=$order['id'];?>"><i class="fas fa-eye <?=$classHref;?>"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <p class="text-danger">You have no orders</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- <a href="#" class="btn btn-secondary">Change personal data</a>
		<a href="#" class="btn btn-primary">My orders</a>
		<a href="#" class="btn btn-danger">Log Out</a> -->
    </div>
</div>
<!-- <p class="text-center mt-4">Don't have account? <a href="#">Sign Up</a></p> -->