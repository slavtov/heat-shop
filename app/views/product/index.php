<div class="clearfix my-2 mb-md-0">
    <div class="float-left">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Main</a></li>
        <?php if ($breadcrumbs): ?>
            <?php foreach ($breadcrumbs as $bread): ?>
                <li class="breadcrumb-item">
                    <a href="category/<?=$bread['url']?>">
                        <?=$bread['title']?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?=$product['title'];?>
                </li>
            </ol>
        </nav>
    </div>
    <div class="float-right">
        <form action="search" method="get" autocomplete="off">
            <div class="input-group">
                <input class="form-control round" type="search" name="q" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-primary round" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="row">
        <div class="col-md-7 text-center">
        <?php if ($gallery): ?>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php $i=0; foreach ($gallery as $img): ?>
                    <div class="carousel-item <?php if ($i === 0) echo 'active'; $i++; ?>">
                        <img src="img/<?=$img['img'];?>" class="d-block mw-100" alt="">
                    </div>
                <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="fa fa-angle-left text-dark display-4" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="fa fa-angle-right text-dark display-4" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        <?php else: ?>
            <img class="mw-100" src="img/<?=$product['img'];?>" alt="">
        <?php endif; ?>
        </div>
        <p class="h5 new"><span class="badge badge-danger">NEW</span></p>
	<?php if ($product['old_price']): ?>
        <p class="h5 new"><span class="badge badge-warning" style="margin-top: 2rem !important"><?= getSale($product['old_price'], $product['price']); ?></span></p>
	<?php endif; ?>
        <div class="col-md-5 border-left">
            <div class="mr-md-3 p-3">
                <h2 class="mt-3">
                    <?=$product['title'];?>
                </h2>
                <div class="my-3">
				<?php if ($product['stock'] == 'on'): ?>
					<span class="text-success"><i class="fas fa-clipboard-check"></i>&nbsp;in stock</span>
				<?php else: ?>
					<span class="text-danger"><i class="fas fa-clipboard-check"></i>&nbsp;out of stock</span>
				<?php endif; ?>
                </div>
                <!-- <div class="mb-3">
					<span class="h4 font-weight-bold item_price" id="base-price" data-base="<?=$product['price']*$_SESSION['currency']['value'];?>" data-oldbase="<?=$product['old_price']*$_SESSION['currency']['value'];?>"><?=$product['price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></span>
					<?php if ($product['old_price']): ?>
					<span class="h5"><s><?=$product['old_price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></s></span>
					<?php endif; ?>
					<span class="text-muted">for one</span>
				</div> -->
                <div class="d-flex align-items-center mb-3">
                    <h4 class="font-weight-bold item_price" id="base-price" data-base="<?=$product['price']*$_SESSION['currency']['value'];?>" data-oldbase="<?=$product['old_price']*$_SESSION['currency']['value'];?>">
                        <?=$product['price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?>
                    <?php if ($product['old_price']): ?>
                        <small><s><?=$product['old_price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></s></small>
                    <?php endif; ?>
                    </h4>
                    <span class="text-muted">&nbsp;for one</span>
                </div>
                <p><?=$product['description'];?></p>

                <hr>

                <dl class="row">
                    <dt class="col-sm-3">Delivery</dt>
                    <dd class="col-sm-9">Worldwide</dd>
                </dl>

                <hr>
        <?php if ($product['stock'] == 'on'): ?>
            <?php if ($mods): ?>
                <div class="available btn-group-toggle mt-4 mb-2" data-toggle="buttons">
                <?php foreach ($mods as $mod): ?>
                    <label class="btn btn-outline-secondary border border-secondary mr-2 mb-2">
						<div class="mx-auto" id="circle-<?=lcfirst($mod['title']);?>"></div>
						<input type="radio" name="mod-color" data-title="<?=$mod['title'];?>" data-price="<?=($product['price']+$mod['price'])*$_SESSION['currency']['value'];?>" <?php if ($product['old_price']): ?>data-oldprice="<?=($product['old_price']+$mod['price'])*$_SESSION['currency']['value'];?>"<?php endif; ?> value="<?=$mod['id'];?>"> <?=$mod['title'];?>
					</label>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($modSize): ?>
                <div class="mod-size btn-group-toggle my-3" data-toggle="buttons">
                <?php foreach ($modSize as $key => $val): ?>
                    <label class="btn btn-outline-secondary border border-secondary mr-2 mb-2 <?=$key == 0 ? 'active' : null;?>">
						<input type="radio" name="mod-size" value="<?=$val['title'];?>" <?=$key == 0 ? 'checked' : null;?>> <?=strtoupper($val['title']);?>
					</label>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

                <div class="quantity w-25">
                    <input type="number" class="form-control" value="1" name="quantity" min="1" step="1">
                </div>

                <a href="#" class="btn btn-primary my-3 mr-1" id="buy" data-id="<?=$product['id'];?>">Buy now</a>
                <a href="#" class="btn btn-outline-primary add-cart add-to-cart my-3 mr-2" id="productAdd" data-id="<?=$product['id'];?>">Add to cart&nbsp;<i class="fas fa-shopping-cart"></i></a>
                <span class="text-danger" id="check-color" style="display: none;">Select color</span>
                <span class="text-danger" id="check-size" style="display: none;">Select size</span>
        <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if ($product['info']): ?>
<div class="mt-4">
    <h3>Information</h3>
    <p><?=$product['info'];?></p>
</div>
<?php endif; ?>

<?php if ($related): ?>
<hr>
<h3>Relatives</h3>
<div class="row">
<?php foreach ($related as $item): ?>
    <div class="col-lg-3 col-md-4 col-sm-6 mt-2 mb-4">
        <div class="card h-100 shadow hover-product half-round">
            <a href="product/<?=$item['alias']?>" class="mx-auto new">
                <span class="badge badge-danger">NEW</span>
                <img src="img/<?=$item['img'];?>" class="mt-4 mw-100" style="height:200px" alt="" />
            </a>
            <div class="card-body d-flex align-items-center">
                <div class="w-100">
                    <h5 class="card-title">
                        <a href="product/<?=$item['alias']?>" class="text-decoration-none text-dark"><?=$item['title'];?></a>
                    </h5>
                    <div class="card-text text-muted">
                        <span class="h5 font-weight-bold text-dark"><?=$item['price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></span>
                    <?php if ($item['old_price']): ?>
                        <span class="h6 text-dark"><s><?=$item['old_price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></s></span>
                    <?php endif; ?> for one
                    </div>
        <?php if ($item['stock'] == 'on'): ?>
            <?php if (isset($allColor[$item['id']])): ?>
                    <a href="product/<?=$item['alias']?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-clone"></i>&nbsp;Select color</a>
            <?php else: ?>
                <?php if (isset($allSize[$item['id']])): ?>
                    <a href="product/<?=$item['alias']?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-clone"></i>&nbsp;Select size</a>
                <?php else: ?>
                    <a data-id="<?=$item['id'];?>" href="cart/add?id=<?=$item['id'];?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-shopping-cart"></i>&nbsp;Add to cart</a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php endif ?>

<?php if ($recentlyViewed): ?>
<hr>
<h3>Recently viewed</h3>
<div class="row">
<?php foreach ($recentlyViewed as $item): ?>
    <div class="col-lg-3 col-md-4 col-sm-6 mt-2 mb-4">
        <div class="card h-100 shadow hover-product half-round">
            <a href="product/<?=$item['alias']?>" class="mx-auto new">
                <span class="badge badge-danger">NEW</span>
                <img src="img/<?=$item['img'];?>" class="mt-4 mw-100" style="height:200px" alt="" />
            </a>
            <div class="card-body d-flex align-items-center">
                <div class="w-100">
                    <h5 class="card-title">
                        <a href="product/<?=$item['alias']?>" class="text-decoration-none text-dark"><?=$item['title'];?></a>
                    </h5>
                    <!-- <p class="card-text"><small class="text-muted">Explore Now</small></p> -->
                    <div class="card-text text-muted">
                        <span class="h5 font-weight-bold text-dark"><?=$item['price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></span>
                    <?php if ($item['old_price']): ?>
                        <span class="h6 text-dark"><s><?=$item['old_price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></s></span>
                    <?php endif; ?> for one
                    </div>
        <?php if ($item['stock'] == 'on'): ?>
            <?php if (isset($allColor[$item['id']])): ?>
                    <a href="product/<?=$item['alias']?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-clone"></i>&nbsp;Select color</a>
            <?php else: ?>
                <?php if (isset($allSize[$item['id']])): ?>
                    <a href="product/<?=$item['alias']?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-clone"></i>&nbsp;Select size</a>
                <?php else: ?>
                    <a data-id="<?=$item['id'];?>" href="cart/add?id=<?=$item['id'];?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-shopping-cart"></i>&nbsp;Add to cart</a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php endif ?>