<!-- Success or Error report -->
<?php getReport(); ?>

<div class="card mx-auto mt-4">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col">
                <h4 class="card-title float-left">Admin Panel</h4>
            </div>
            <div class="col">
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
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>QTY</th>
                                <th>Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                        <?php
                        // Completed
                        $class	    = $order['status'] ? 'class="bg-success text-white"' : null;
                        $classEdit  = $order['status'] ? 'text-white' : null;
                        $classTrash = $order['status'] ? 'text-white' : 'text-danger';
                        ?>
                            <tr <?=$class;?>>
                                <td><?=$order['id'];?></td>
                                <td><?=$order['username'];?></td>
                                <td><?=$order['status'] ? 'Completed' : 'New';?></td>
                                <td><?=$order['date'];?></td>
                                <td><?=$order['update_at'];?></td>
                                <td><?=$order['qty'];?></td>
                                <td><?=$order['sum'];?> <?=$order['currency'];?></td>
                                <td class="text-center"><a href="<?=ADMIN;?>/order/view?id=<?=$order['id'];?>" class="mr-3"><i class="fas fa-edit <?=$classEdit;?>"></i></a><a href="<?=ADMIN;?>/order/delete?id=<?=$order['id'];?>" class="delete"><i class="fas fa-trash <?=$classTrash;?>"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php if ($pagination->countPages > 1): ?>
                <?=$pagination;?>
                <p class="text-center">(<?=count($orders);?> out of <?=$count;?> orders)</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>