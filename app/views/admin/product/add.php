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
                    <a href="<?=ADMIN;?>/product" class="list-group-item list-group-item-action border-0 rounded active">Products</a>
                    <a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded">Users</a>
                    <a href="<?=ADMIN;?>/category" class="list-group-item list-group-item-action border-0 rounded">Categories</a>
                    <a href="<?=ADMIN;?>/cache" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                    <a href="<?=ADMIN;?>/question" class="list-group-item list-group-item-action border-0 rounded">Questions</a>
                </div>
            </div>
            <div class="col-md-10">
                <form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label for="image">Product image input</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>

                    <label>Gallery images input</label>
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="gallery[]">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="gallery[]">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="gallery[]">
                    </div>

                    <label>Color</label>
                    <div class="form-row m-1">
                    <?php foreach ($arrColor as $color): ?>
                        <div class="custom-control custom-checkbox form-group mr-3">
                            <input type="checkbox" class="custom-control-input" id="<?=$color;?>" name="color[]" value="<?=$color;?>">
                            <label class="custom-control-label" for="<?=$color;?>"><?=ucfirst($color);?></label>
                        </div>
                    <?php endforeach; ?>
                    </div>

                    <label>Size</label>
                    <div class="form-row m-1">
                    <?php foreach ($arrSize as $size): ?>
                        <div class="custom-control custom-checkbox form-group mr-3">
                            <input type="checkbox" class="custom-control-input" id="<?=$size;?>" name="size[]" value="<?=$size;?>">
                            <label class="custom-control-label" for="<?=$size;?>"><?=strtoupper($size);?></label>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="form-row m-1">
                    <?php foreach ($arrSizeNumber as $size): ?>
                        <div class="custom-control custom-checkbox form-group mr-3">
                            <input type="checkbox" class="custom-control-input" id="<?=$size;?>" name="size[]" value="<?=$size;?>">
                            <label class="custom-control-label" for="<?=$size;?>"><?=$size;?></label>
                        </div>
                    <?php endforeach; ?>
                    </div>

                    <div class="form-row">
                        <div class="col form-group mr-2">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                        </div>
                        <div class="col form-group">
                            <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group mr-2">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                        </div>
                        <div class="col form-group">
                            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Keywords">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group mr-2">
                            <select class="form-control" name="category_id">
                                <option value disabled hidden selected>Select category</option>
                        <?php if ($categories): ?>
                            <?php foreach ($categories as $key => $val): ?>
                                <option value="<?=$key;?>"><?=$val['title'];?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                            </select>
                        </div>
                        <div class="col form-group mr-2">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" min="0" required>
                        </div>
                        <div class="col form-group">
                            <input type="number" class="form-control" id="old_price" name="old_price" placeholder="Old price" min="0">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group">
                            <h5>Status</h5>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status-on" name="status" class="custom-control-input" value="on" checked>
                                <label class="custom-control-label" for="status-on">on</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status-off" name="status" class="custom-control-input" value="off">
                                <label class="custom-control-label" for="status-off">off</label>
                            </div>
                        </div>
                        <div class="col form-group">
                            <h5>Hit</h5>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="hit-on" name="hit" class="custom-control-input" value="on" checked>
                                <label class="custom-control-label" for="hit-on">on</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="hit-off" name="hit" class="custom-control-input" value="off">
                                <label class="custom-control-label" for="hit-off">off</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="info" name="info" placeholder="Information"></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>