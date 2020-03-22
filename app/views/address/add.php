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
                        <form role="form" method="post" class="form-input needs-validation" novalidate>
                            <div class="form-row">
                                <div class="col-md-4 form-group">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" class="form-control" name="middle_name" placeholder="Middle Name (Optional)">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <select class="form-control" id="country" name="country" required>
                                        <option value disabled hidden selected>Select Country</option>
                                        <?php foreach ($countries as $country) {
                                            echo '<option>'. $country . '</option>' . PHP_EOL;
                                        } ?>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="text" class="form-control" name="region" placeholder="Region" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" name="city" placeholder="City" required>
                                </div>
                                <div class="col form-group">
                                    <input type="text" class="form-control" name="street" placeholder="Street" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="number" class="form-control" name="house" placeholder="House" min="1" required>
                                </div>
                                <div class="col form-group">
                                    <input type="number" class="form-control" name="apartment" placeholder="Apartment (Optional)" min="0">
                                </div>
                                <div class="col form-group">
                                    <input type="number" class="form-control" name="zip" placeholder="ZIP" min="10000" max="999999" required>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>