<!-- Success or Error report -->
<?php getReport(); ?>

<div class="card mx-auto mt-4">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12 col-md-2 col-lg-2">
                <h4 class="card-title float-left">Admin Panel</h4>
            </div>
            <div class="col-6 col-md-4 col-lg-4">
                <a href="<?=ADMIN;?>/category/add" class="btn btn-sm btn-success">Add a category</a>
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
                    <a href="<?=ADMIN;?>/product" class="list-group-item list-group-item-action border-0 rounded">Products</a>
                    <a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded ">Users</a>
                    <a href="<?=ADMIN;?>/category" class="list-group-item list-group-item-action border-0 rounded active">Categories</a>
                    <a href="<?=ADMIN;?>/cache" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                    <a href="<?=ADMIN;?>/question" class="list-group-item list-group-item-action border-0 rounded">Questions</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="list-group">
                    <?php new \app\widgets\category\Category([
                        'tpl' => APP . '/widgets/category/tpl/category_admin.php'
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>