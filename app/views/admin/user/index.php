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
                    <a href="<?=ADMIN;?>/order" class="list-group-item list-group-item-action border-0 rounded ">Orders</a>
                    <a href="<?=ADMIN;?>/product" class="list-group-item list-group-item-action border-0 rounded">Products</a>
                    <a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded active">Users</a>
                    <a href="<?=ADMIN;?>/category" class="list-group-item list-group-item-action border-0 rounded">Categories</a>
                    <a href="<?=ADMIN;?>/cache" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                    <a href="<?=ADMIN;?>/question" class="list-group-item list-group-item-action border-0 rounded">Questions</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?=$user['id'];?></td>
                                <td><?=$user['username'];?></td>
                                <td><?=$user['email'];?></td>
                                <td><?=$user['role'];?></td>
                                <td class="text-center"><a href="<?=ADMIN;?>/user/edit?id=<?=$user['id'];?>" class="mr-3"><i class="fas fa-edit"></i></a><a href="<?=ADMIN;?>/user/delete?id=<?=$user['id'];?>" class="delete"><i class="fas fa-trash text-danger"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php if ($pagination->countPages > 1): ?>
                <?=$pagination;?>
                <p class="text-center">(<?=count($users);?> out of <?=$count;?> users)</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>