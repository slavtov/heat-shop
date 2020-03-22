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
                <img src="img/<?=$product['img'];?>" alt="" style="max-height: 300px">
                <form method="post" class="needs-validation" novalidate>
                    <label>Color</label>
                    <div class="form-row m-1">
                    <?php foreach ($arrColor as $color): ?>
                        <div class="custom-control custom-checkbox form-group mr-3">
                            <input type="checkbox" class="custom-control-input" id="<?=$color;?>" name="color[]" value="<?=$color;?>" <?=isset($colors[$color]) ? 'checked' : null;?>>
                            <label class="custom-control-label" for="<?=$color;?>"><?=ucfirst($color);?></label>
                        </div>
                    <?php endforeach; ?>
                    </div>

                    <label>Size</label>
                    <div class="form-row m-1">
                    <?php foreach ($arrSize as $size): ?>
                        <div class="custom-control custom-checkbox form-group mr-3">
                            <input type="checkbox" class="custom-control-input" id="<?=$size;?>" name="size[]" value="<?=$size;?>" <?=isset($sizes[$size]) ? 'checked' : null;?>>
                            <label class="custom-control-label" for="<?=$size;?>"><?=strtoupper($size);?></label>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="form-row m-1">
                    <?php foreach ($arrSizeNumber as $size): ?>
                        <div class="custom-control custom-checkbox form-group mr-3">
                            <input type="checkbox" class="custom-control-input" id="<?=$size;?>" name="size[]" value="<?=$size;?>" <?=isset($sizes[$size]) ? 'checked' : null;?>>
                            <label class="custom-control-label" for="<?=$size;?>"><?=$size;?></label>
                        </div>
                    <?php endforeach; ?>
                    </div>

                    <div class="form-row">
                        <div class="col form-group mr-2">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?=$product['title'];?>">
                        </div>
                        <div class="col form-group">
                            <label for="alias">Alias</label>
                            <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" value="<?=$product['alias'];?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group mr-2">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?=$product['description'];?>">
                        </div>
                        <div class="col form-group">
                            <label for="description">Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Keywords" value="<?=$product['keywords'];?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group mr-2">
                            <label for="exampleFormControlSelect1">Category</label>
                            <select class="form-control" name="category_id">
                        <?php if ($categories): ?>
                            <?php foreach ($categories as $key => $val): ?>
                                <option value="<?=$key;?>" <?= $product['category_id'] == $key ? 'selected' : null;?>><?=$val['title'];?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                            </select>
                        </div>
                        <div class="col form-group mr-2">
                            <label for="alias">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" min="0" value="<?=$product['price'];?>">
                        </div>
                        <div class="col form-group">
                            <label for="alias">Old price</label>
                            <input type="number" class="form-control" id="old_price" name="old_price" placeholder="Old price" min="0" value="<?=$product['old_price'];?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group">
                            <h5>Status</h5>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status-on" name="status" class="custom-control-input" value="on" <?=$product[ 'status']=='on' ? 'checked' : null;?>>
                                <label class="custom-control-label" for="status-on">on</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status-off" name="status" class="custom-control-input" value="off" <?=$product[ 'status']=='off' ? 'checked' : null;?>>
                                <label class="custom-control-label" for="status-off">off</label>
                            </div>
                        </div>
                        <div class="col form-group">
                            <h5>Hit</h5>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="hit-on" name="hit" class="custom-control-input" value="on" <?=$product[ 'hit']=='on' ? 'checked' : null;?>>
                                <label class="custom-control-label" for="hit-on">on</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="hit-off" name="hit" class="custom-control-input" value="off" <?=$product[ 'hit']=='off' ? 'checked' : null;?>>
                                <label class="custom-control-label" for="hit-off">off</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info">Information</label>
                        <textarea type="text" class="form-control" id="info" name="info" cols="30" rows="10"><?=$product['info'];?></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>