<!-- Success or Error report -->
<?php getReport(); ?>

<?php if (isset($_SESSION['form-data'])) unset($_SESSION['form-data']); ?>

<div class="card mx-auto mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title mb-5 float-left">My profile</h4>
            </div>
            <div class="col">
                <a href="user/logout" class="btn btn-sm btn-danger float-right">Log Out</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="list-group">
                    <a href="profile" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="profile/orders" class="list-group-item list-group-item-action">My orders</a>
                    <a href="profile/address" class="list-group-item list-group-item-action active">Order address</a>
                    <a href="profile/edit" class="list-group-item list-group-item-action">Edit personal data</a>
                    <a href="profile/password" class="list-group-item list-group-item-action">Change password</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-user"></i>&nbsp;Order address</div>
                    <div class="card-body">
                <?php if (!$address): ?>
                    <?php if ($addresses): ?>
                        <h4 class="mb-3">Select address</h4>
                    <?php else: ?>
                        <h4>You have no addresses</h4>
                    <?php endif; ?>
                <?php endif; ?>
                        <div class="row">
                        <?php if ($address): ?>
                            <div class="col-12">
                                <a href="address/delete?id=<?=$address;?>" class="close mr-4 mt-3 text-white delete" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                                <a href="address/edit?id=<?=$address;?>" class="close mr-2 mt-3 text-white" aria-label="Close">
                                    <span aria-hidden="true" class="fas fa-edit h5" style="text-shadow: none; font-size:1rem;"></span>
                                </a>
                                <div class="jumbotron bg-primary text-white p-md-5 half-round">
                                    <div class="container">
                                        <h4 class="mb-3 text-center">Your current address</h4>
                                        <div class="row">
                                            <p class="col-6 text-right">Name</p>
                                            <p class="col-6">
                                                <?=$userAddress['first_name'];?>
                                                <?=$userAddress['middle_name'];?>
                                                <?=$userAddress['last_name'];?>
                                            </p>

                                            <p class="col-6 text-right">Country</p>
                                            <p class="col-6"><?=$userAddress['country'];?></p>

                                            <p class="col text-right">City / Region</p>
                                            <p class="col-6">
                                                <?=$userAddress['city'];?>,
                                                <?=$userAddress['region'];?> Region
                                            </p>

                                            <p class="col-6 text-right">Street</p>
                                            <p class="col-6"><?=$userAddress['street'];?></p>

                                            <p class="col-6 text-right">House / Apartment</p>
                                            <p class="col-6 "><?=$userAddress['house'];?><?=$userAddress['apartment'] ? '/'.$userAddress['apartment'] : null;?></p>

                                            <p class="col-6 text-right">ZIP</p>
                                            <p class="col-6"><?=$userAddress['zip'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php if ($addresses): ?>
                        <?php foreach ($addresses as $key => $val): ?>
                            <div class="col-12">
                                <a href="address/delete?id=<?=$key;?>" class="close mr-4 mt-3 delete" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                                <a href="address/edit?id=<?=$key;?>" class="close mr-2 mt-3" aria-label="Close">
                                    <span aria-hidden="true" class="fas fa-edit" style="text-shadow: none; font-size: 1rem;"></span>
                                </a>
                                <a href="profile/address?id=<?=$key;?>" class="text-decoration-none text-dark">
                                    <div class="jumbotron p-md-5 half-round">
                                        <div class="container">
                                            <div class="row">
                                                <p class="col-6 font-weight-bold text-right">Name</p>
                                                <p class="col-6">
                                                    <?=$val['first_name'];?>
                                                    <?=$val['middle_name'];?>
                                                    <?=$val['last_name'];?>
                                                </p>

                                                <p class="col-6 font-weight-bold text-right">Country</p>
                                                <p class="col-6"><?=$val['country'];?></p>

                                                <p class="col-6 font-weight-bold text-right">City / Region</p>
                                                <p class="col-6">
                                                    <?=$val['city'];?>,
                                                    <?=$val['region'];?> Region
                                                </p>

                                                <p class="col-6 font-weight-bold text-right">Street</p>
                                                <p class="col-6"><?=$val['street'];?></p>

                                                <p class="col-6 font-weight-bold text-right">House / Apartment</p>
                                                <p class="col-6"><?=$val['house'];?><?=$val['apartment'] ? '/'.$val['apartment'] : null;?></p>

                                                <p class="col-6 font-weight-bold text-right">ZIP</p>
                                                <p class="col-6"><?=$val['zip'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </div>
                        <a href="address/add" class="btn btn-lg d-block btn-primary mt-2">Add an address</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>