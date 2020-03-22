<!-- Success or Error report -->
<?php getError(); ?>

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
					<a href="<?=ADMIN;?>" class="list-group-item list-group-item-action border-0 rounded active">Dashboard</a>
					<a href="<?=ADMIN;?>/order" class="list-group-item list-group-item-action border-0 rounded">Orders</a>
					<a href="<?=ADMIN;?>/product" class="list-group-item list-group-item-action border-0 rounded">Products</a>
					<a href="<?=ADMIN;?>/user" class="list-group-item list-group-item-action border-0 rounded">Users</a>
                    <a href="<?=ADMIN;?>/category" class="list-group-item list-group-item-action border-0 rounded">Categories</a>
                    <a href="<?=ADMIN;?>/cache" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                    <a href="<?=ADMIN;?>/question" class="list-group-item list-group-item-action border-0 rounded">Questions
                <?php if ($questions): ?>
                    <span class="badge badge-primary"><?=$questions;?></span>
                <?php endif; ?>
                    </a>
				</div>
            </div>

			<div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="<?=ADMIN;?>/order" class="text-decoration-none text-white">
                        <div class="jumbotron text-center bg-primary py-md-5 half-round">
                            <h3><b><?=$orders['processing'];?></b></h3>
                            <p><span class="lead">new orders</span></p>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="<?=ADMIN;?>/product" class="text-decoration-none text-white">
                        <div class="jumbotron text-center bg-success py-md-5 half-round">
                            <h3><b><?=$products['all'];?></b></h3>
                            <p><span class="lead"><b>products</b></span></p>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="<?=ADMIN;?>/user" class="text-decoration-none text-white">
                        <div class="jumbotron text-center py-md-5 half-round" style="background: darkorchid">
                            <h3><b><?=$users['all'];?></b></h3>
                            <p><span class="lead"><b>users</b></span></p>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="<?=ADMIN;?>/category" class="text-decoration-none text-white">
                        <div class="jumbotron text-center bg-danger py-md-5 half-round">
                            <h3><b><?=$categories['all'];?></b></h3>
                            <p><span class="lead"><b>categories</b></span></p>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body row">
                                <h4 class="col-12 text-center">Orders</h3>
                                <div class="col-6 text-right">Processing orders</div>
                                <div class="col-6"><?=$orders['processing'];?></div>
                                <div class="col-6 text-right">Complete orders</div>
                                <div class="col-6"><?=$orders['complete'];?></div>

                                <div class="col-6 text-right mt-2">Today</div>
                                <div class="col-6 mt-2"><?=$orders['today'];?></div>
                                <div class="col-6 text-right">Last month</div>
                                <div class="col-6"><?=$orders['month'];?></div>
                                <div class="col-6 text-right">Last year</div>
                                <div class="col-6"><?=$orders['year'];?></div>
                                <div class="col-6 text-right">All</div>
                                <div class="col-6"><?=$orders['all'];?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body row">
                                <h4 class="col-12 text-center">Users</h3>
                                <div class="col-6 text-right">Admins</div>
                                <div class="col-6"><?=$users['admin'];?></div>

                                <div class="col-6 text-right mt-2">Today</div>
                                <div class="col-6 mt-2"><?=$users['today'];?></div>
                                <div class="col-6 text-right">Last month</div>
                                <div class="col-6"><?=$users['month'];?></div>
                                <div class="col-6 text-right">Last year</div>
                                <div class="col-6"><?=$users['year'];?></div>
                                <div class="col-6 text-right">All</div>
                                <div class="col-6"><?=$users['all'];?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body row">
                                <h4 class="col-12 text-center">Products</h3>
                                <div class="col-6 text-right">Hit</div>
                                <div class="col-6"><?=$products['hit'];?></div>
                                <div class="col-6 text-right">Show</div>
                                <div class="col-6"><?=$products['show'];?></div>
                                <div class="col-6 text-right">Hide</div>
                                <div class="col-6"><?=$products['hide'];?></div>
                                <div class="col-6 text-right">All</div>
                                <div class="col-6"><?=$products['all'];?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body row">
                                <h4 class="col-12 text-center">Categories</h3>
                                <div class="col-6 text-right">Parent</div>
                                <div class="col-6"><?=$categories['parent'];?></div>
                                <div class="col-6 text-right">Child</div>
                                <div class="col-6"><?=$categories['child'];?></div>
                                <div class="col-6 text-right">All</div>
                                <div class="col-6"><?=$categories['all'];?></div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>
	</div>
</div>