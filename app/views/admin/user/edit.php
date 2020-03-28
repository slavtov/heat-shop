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

        <!-- Success or Error report -->
        <?php getReport(); ?>

        <div class="row">
            <div class="col-lg-2 mb-4">
                <div class="list-group">
                    <a href="<?=ADMIN;?>" class="list-group-item list-group-item-action border-0 rounded">Dashboard</a>
                    <a href="<?=ADMIN;?>/order" class="list-group-item list-group-item-action border-0 rounded ">Orders</a>
                    <a href="<?=ADMIN;?>/product" class="list-group-item list-group-item-action border-0 rounded">Products</a>
                    <a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded active">Users</a>
                    <a href="<?=ADMIN;?>/category" class="list-group-item list-group-item-action border-0 rounded">Categories</a>
                    <a href="<?=ADMIN;?>/cache" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                    <a href="<?=ADMIN;?>/question" class="list-group-item list-group-item-action border-0 rounded">Questions</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="mb-4">
                    <form method="post" class="form-input needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?=$user['email'];?>" required>
                            </div>
                            <div class="col form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="username" value="<?=$user['username'];?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option <?php if ($user['role'] == 'user') echo 'selected'; ?>>user</option>
                                <option <?php if ($user['role'] == 'admin') echo 'selected'; ?>>admin</option>
                            </select> -->
                            <h5>Role</h5>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="role-user" name="role" class="custom-control-input" value="user" <?=$user['role']=='user' ? 'checked' : null;?> required>
                                <label class="custom-control-label" for="role-user">User</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="role-admin" name="role" class="custom-control-input" value="admin" <?=$user['role']=='admin' ? 'checked' : null;?> required>
                                <label class="custom-control-label" for="role-admin">Admin</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Edit</button>
                    </form>
                </div>

                <hr>

                <h4>Current address</h4>
            <?php if ($address): ?>
                <div class="jumbotron p-md-5 half-round">
                    <div class="container">
                        <div class="row">
                            <p class="col-6 font-weight-bold text-right">Name</p>
                            <p class="col-6">
                                <?=$address['first_name'];?>
                                <?=$address['middle_name'];?>
                                <?=$address['last_name'];?>
                            </p>

                            <p class="col-6 font-weight-bold text-right">Country</p>
                            <p class="col-6"><?=$address['country'];?></p>

                            <p class="col-6 font-weight-bold text-right">City / Region</p>
                            <p class="col-6">
                                <?=$address['city'];?>,
                                <?=$address['region'];?> Region
                            </p>

                            <p class="col-6 font-weight-bold text-right">House / Apartment</p>
                            <p class="col-6"><?=$address['house'];?><?=$address['apartment'] ? '/'.$address['apartment'] : null;?></p>

                            <p class="col-6 font-weight-bold text-right">ZIP</p>
                            <p class="col-6"><?=$address['zip'];?></p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-danger">No current address</p>
            <?php endif; ?>

                <h4 class="text-dark">User orders</h4>
            <?php if ($orders): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Action</th>
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
                    </div>
                </div>
            <?php else: ?>
                <p class="text-danger">User didn't order anything</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>