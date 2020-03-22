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
                <form method="post" class="form-input" enctype="multipart/form-data" novalidate>
                <?php if ($category['img']): ?>
                    <div class="form-group text-center">
                        <h6>Background</h6>
                        <a href="<?=ADMIN;?>/category/delete?background=<?=$category['id'];?>" class="close delete" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                        <img src="img/<?=$category['img'];?>" class="w-50 round" alt="">
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label for="image">Category image input</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                <?php endif; ?>
                    <div class="form-row">
                        <div class="col form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?=$category['title'];?>">
                        </div>
                        <div class="col form-group">
                            <label for="alias">Alias</label>
                            <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" value="<?=$category['alias'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?=$category['description'];?>">
                    </div>
                    <div class="form-group">
                        <label for="parent-id">Parent category</label>
                        <select class="form-control" id="parent-id" name="parent_id">
                            <option value="no">No parent</option>
                    <?php if ($categories): ?>
                        <?php foreach ($categories as $key => $val): ?>
                            <option value="<?=$key;?>" <?= $category['parent_id'] == $key ? 'selected' : null;?>><?=$val['title'];?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>