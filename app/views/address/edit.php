<!-- Success or Error report -->
<?php getReport(); ?>

<div class="card mx-auto">
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
                    <div class="card-header"><i class="fas fa-user"></i>&nbsp;Add an address</div>
                    <div class="card-body">
                        <form role="form" method="post" class="form-input" novalidate>
                            <div class="form-row">
                                <div class="col-md-4 form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" class="form-control" id="first-name" name="first_name" value="<?=$address['first_name'];?>" pattern="[a-zA-Zа-яА-Я]+">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="middle-name">Middle Name <span class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control" id="middle-name" name="middle_name" placeholder="(Optional)" value="<?=$address['middle_name'] ? $address['middle_name'] : null;?>" pattern="[a-zA-Zа-яА-Я]+">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" name="last_name" value="<?=$address['last_name'];?>" pattern="[a-zA-Zа-яА-Я]+">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="country">Select Country</label>
                                    <select class="form-control" id="country" name="country">
                                        <?php foreach ($countries as $country) {
                                            if ($address['country'] == $country) {
                                                echo '<option value selected>'. $country . '</option>' . PHP_EOL;
                                            } else {
                                                echo '<option>' . $country . '</option>' . PHP_EOL;
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="region">Region</label>
                                    <input type="text" class="form-control" id="region" name="region" value="<?=$address['region'];?>" pattern="[a-zA-Zа-яА-Я-]+">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?=$address['city'];?>" pattern="[a-zA-Zа-яА-Я-]+">
                                </div>
                                <div class="col form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" value="<?=$address['street'];?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="house">House</label>
                                    <input type="number" class="form-control" id="house" name="house" value="<?=$address['house'];?>" min="1">
                                </div>
                                <div class="col form-group">
                                    <label for="apartment">Apartment</label>
                                    <input type="number" class="form-control" id="apartment" name="apartment" placeholder="(Optional)" value="<?=$address['apartment'] ? $address['apartment'] : null;?>" min="0">
                                </div>
                                <div class="col form-group">
                                    <label for="zip">ZIP</label>
                                    <input type="number" class="form-control" id="zip" name="zip" value="<?=$address['zip'];?>" min="10000" max="999999">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary btn-block mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>