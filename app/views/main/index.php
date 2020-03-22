<main role="main">

    <div class="clearfix mt-2">
        <h1 class="float-left h3">Main</h1>
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

    <div id="carouselExampleIndicators" class="carousel slide mt-4 mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="category/men-t-shirts"><img src="img/t-shirts.png" class="d-block w-100" alt="t-shirts"></a>
            </div>
            <div class="carousel-item">
                <a href="category/backpacks"><img src="img/backpacks.png" class="d-block w-100" alt="backpacks"></a>
            </div>
            <div class="carousel-item">
                <a href="category/watches"><img src="img/watches.png" class="d-block w-100" alt="watches"></a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-lg-4">
                    <img class="img-responsive" src="img/delivery.png" height="50" width="50" alt="" />
                    <h3>Free Delivery</h3>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis magnam sit tempore voluptatem aspernatur et maiores voluptate veritatis doloribus corporis eos quas autem, rem libero dolorem molestias voluptas? Sunt, inventore!</p>
                </div>
                <div class="col-lg-4">
                    <img class="img-responsive" src="img/quality.png" height="50" width="50" alt="" />
                    <h3>High Quality</h3>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda rem aliquid distinctio labore! Debitis non, ad quas at, quasi aspernatur ab dolore dolores saepe aliquam, tempore sequi voluptatem excepturi officiis?</p>
                </div>
                <div class="col-lg-4">
                    <img class="img-responsive" src="img/payment.png" height="50" width="50" alt="" />
                    <h3>Secure Payment</h3>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quis, obcaecati esse excepturi veritatis id voluptates rem voluptas incidunt, quas velit eligendi sit repellendus pariatur quam necessitatibus, cum ad quibusdam.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
<?php if ($hits): ?>
    <?php foreach ($hits as $hit): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow hover-product half-round">
                <a href="product/<?=$hit['alias']?>" class="mx-auto new">
                    <span class="badge badge-danger">NEW</span>
                <?php if ($hit['old_price']): ?>
                    <span class="badge badge-warning mt-4"><?= getSale($hit['old_price'], $hit['price']); ?></span>
                <?php endif; ?>
                    <img src="img/<?=$hit['img'];?>" class="mt-4 mw-100" style="height:200px" alt="" />
                </a>
                <div class="card-body d-flex align-items-center">
                    <div class="w-100">
                        <h5 class="card-title">
                            <a href="product/<?=$hit['alias']?>" class="text-decoration-none text-dark">
                                <?=$hit['title'];?>
                            </a>
                        </h5>
                        <div class="card-text text-muted">
                            <span class="h5 font-weight-bold text-dark"><?=$hit['price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></span>
                        <?php if ($hit['old_price']): ?>
                            <span class="h6 text-dark"><s><?=$hit['old_price']*$_SESSION['currency']['value'];?><?=$_SESSION['currency']['symbol'];?></s></span>
                        <?php endif; ?> for one
                        </div>
            <?php if ($hit['stock'] == 'on'): ?>
                <?php if (isset($colors[$hit['id']])): ?>
                        <a href="product/<?=$hit['alias']?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-clone"></i>&nbsp;Select color</a>
                <?php else: ?>
                    <?php if (isset($sizes[$hit['id']])): ?>
                        <a href="product/<?=$hit['alias']?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-clone"></i>&nbsp;Select size</a>
                    <?php else: ?>
                        <a data-id="<?=$hit['id'];?>" href="cart/add?id=<?=$hit['id'];?>" class="btn btn-block btn-outline-primary border-0 mt-2 font-weight-bold"><i class="fas fa-shopping-cart"></i>&nbsp;Add to cart</a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
    </div>

</main>