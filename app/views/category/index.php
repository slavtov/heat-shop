<div class="clearfix my-2 mb-md-0">
    <div class="float-left">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Main</a></li>
    <?php if ($breadcrumbs): ?>
        <?php foreach ($breadcrumbs as $bread): ?>
            <?php if ($bread != end($breadcrumbs)): ?>
                <li class="breadcrumb-item">
                    <a href="category/<?=$bread['url']?>">
                        <?=$bread['title']?>
                    </a>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?=$bread['title']?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
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

<div class="row">
    <div class="col-md-9 mb-2">
        <div id="product">
        <?php if ($products): ?>
            <div class="row">
            <?php foreach ($products as $item): ?>
                <?php if ($item['status'] == 'off') continue; ?>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 shadow hover-product half-round">
                        <a href="product/<?=$item['alias']?>" class="mx-auto new">
                            <span class="badge badge-danger">NEW</span>
                            <?php if($item['old_price']): ?>
                            <span class="badge badge-warning mt-4"><?= getSale($item['old_price'], $item['price']); ?></span>
                            <?php endif; ?>
                            <img src="img/<?=$item['img'];?>" class="mt-4 mw-100" style="height:200px" alt="" />
                        </a>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h5 class="card-title">
                                    <a href="product/<?=$item['alias']?>" class="text-decoration-none text-dark">
                                        <?=$item['title'];?>
                                    </a>
                                </h5>
                                <div class="card-text text-muted">
                                    <span class="h5 font-weight-bold text-dark"><?=$item['price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></span>
                                    <?php if ($item['old_price']): ?>
                                    <span class="h6 text-dark"><s><?=$item['old_price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></s></span>
                                    <?php endif; ?> for one
                                </div>
                    <?php if ($item['stock'] == 'on'): ?>
                        <?php if (isset($colors[$item['id']])): ?>
                                <a href="product/<?=$item['alias']?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-clone"></i>&nbsp;Select color</a>
                        <?php else: ?>
                            <?php if (isset($sizes[$item['id']])): ?>
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
        <?php else: ?>
            <p>Not found</p>
        <?php endif; ?>

        <?php if ($pagination->countPages > 1): ?>
            <?=$pagination;?>
            <p class="text-center">(<?=count($products);?> out of <?=$total;?>)</p>
        <?php endif; ?>
        </div>
    </div>
    <aside class="col-md-3">
        <div class="sidebar-widget">
            <?php new \app\widgets\filter\Filter(); ?>
        </div>
    </aside>
</div>