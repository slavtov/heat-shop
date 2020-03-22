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
                    <a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded ">Users</a>
                    <a href="<?=ADMIN;?>/category" class="list-group-item list-group-item-action border-0 rounded active">Categories</a>
                    <a href="<?=ADMIN;?>/cache" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                    <a href="<?=ADMIN;?>/question" class="list-group-item list-group-item-action border-0 rounded">Questions</a>
                </div>
            </div>
            <div class="col-md-10">
                <form method="post" class="form-input needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label for="image">Category image input</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="parent_id">
                            <option value="no">No parent</option>
                    <?php if ($categories): ?>
                        <?php foreach ($categories as $key => $val): ?>
                            <option value="<?=$key;?>"><?=$val['title'];?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>