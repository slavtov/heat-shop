<!-- Success or Error report -->
<?php getReport(); ?>

<div class="card mx-auto mt-4">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12 col-md-2 col-lg-2">
                <h4 class="card-title float-left">Admin Panel</h4>
            </div>
            <div class="col-6 col-md-4 col-lg-4">
                <a href="<?=ADMIN;?>/product/add" class="btn btn-sm btn-success">Add a product</a>
            </div>
            <div class="col-6">
                <a href="user/logout" class="btn btn-sm btn-danger float-right">Log Out</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 mb-4">
                <div class="list-group">
                    <a href="<?=ADMIN;?>" class="list-group-item list-group-item-action border-0 rounded">Dashboard</a>
                    <a href="<?=ADMIN;?>/order" class="list-group-item list-group-item-action border-0 rounded ">Orders</a>
                    <a href="<?=ADMIN;?>/product" class="list-group-item list-group-item-action border-0 rounded active">Products</a>
                    <a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded">Users</a>
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Alias</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Keywords</th>
                                <th>Price</th>
                                <th>Old price</th>
                                <th>Hit</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?=$product['id'];?></td>
                                <td><?=$product['title'];?></td>
                                <td><?=$product['description'];?></td>
                                <td><?=$product['alias'];?></td>
                                <td><?=$_SESSION['category'][$product['category_id']]['title'];?></td>
                                <td><?=$product['img'];?></td>
                                <td><?=$product['keywords'];?></td>
                                <td><?=$product['price'];?></td>
                                <td><?=$product['old_price'];?></td>
                                <td><?=$product['hit'];?></td>
                                <td><?=$product['status'];?></td>
                                <td class="text-center"><a href="<?=ADMIN;?>/product/edit?id=<?=$product['id'];?>" class="mr-3"><i class="fas fa-edit"></i></a><a href="<?=ADMIN;?>/product/delete?id=<?=$product['id'];?>" class="delete"><i class="fas fa-trash text-danger"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php if ($pagination->countPages > 1): ?>
                <?=$pagination;?>
                <p class="text-center">(<?=count($products);?> out of <?=$count;?> products)</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>