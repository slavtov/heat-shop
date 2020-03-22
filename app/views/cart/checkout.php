<div class="clearfix mt-2">
    <div class="float-left">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Main</a></li>
                <li class="breadcrumb-item"><a href="cart/view">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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

<div class="pb-4 text-center">
    <h2>Checkout form</h2>
</div>

<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-primary badge-pill"><?=$_SESSION['cart.qty'];?></span>
        </h4>
        <ul class="list-group mb-3">
        <?php foreach ($_SESSION['cart'] as $product): ?>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-4">
                        <img src="img/<?=$product['img'];?>" height="70" class="">
                    </div>
                    <div class="col-5">
                        <h6 class="my-0"><?=$product['title'];?></h6>
                    <?php if ($product['size']): ?>
                        <span class="d-block text-muted">size: <?=strtoupper($product['size']);?></span>
                    <?php endif; ?>
                        <span class="d-block text-muted">amount: <?=$product['qty'];?></span>
                    </div>
                    <div class="col-3">
                        <span class="text-muted float-right"><?=$product['price'] * $_SESSION['currency']['value'] . $_SESSION['currency']['symbol'];?></span>
                    </div>

                </div>
            </li>
        <?php endforeach; ?>
            <!-- <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Promo code</h6>
                    <small>EXAMPLECODE</small>
                </div>
                <span class="text-success">-$5</span>
            </li> -->
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (<?=$_SESSION['currency']['code'];?>)</span>
                <strong><?=$_SESSION['cart.sum'] * $_SESSION['currency']['value'] . $_SESSION['currency']['symbol'];?></strong>
            </li>
        </ul>

        <!-- <form class="card p-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Promo code">
                <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
            </div>
        </form> -->
    </div>
    <div class="col-md-8 order-md-1">

        <!-- Success or Error report -->
        <?php getReport(); ?>

        <form class="needs-validation" method="POST" novalidate>
        <?php if (!\app\models\User::auth()): ?>
            <p>Want to register?
                <button class="btn btn-success ml-1" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Also register
                </button>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="mb-3">
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?=isset($_SESSION['form-data']['password']) ? html($_SESSION['form-data']['password']) : null;?>">
                            <div class="invalid-feedback" style="width: 100%;">Your username is required.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-error="Password is not 6 lendth" value="<?=isset($_SESSION['form-data']['password']) ? html($_SESSION['form-data']['password']) : null;?>">
                            <div class="help-block with-errors"></div>
                            <div class="invalid-feedback">Password error</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm password" data-error="Password is not 6 lendth" value="<?=isset($_SESSION['form-data']['password']) ? html($_SESSION['form-data']['password']) : null;?>">
                            <div class="help-block with-errors"></div>
                            <div class="invalid-feedback">Confirm password error</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
            <h4 class="mb-3">Shipping address</h4>
    <?php if (\app\models\User::auth() AND !$address): ?>
        <?php if ($addresses): ?>
            <h5 class="mb-3 font-weight-bold">Select address</h5>
        <?php endif; ?>
    <?php endif; ?>
        <?php if (\app\models\User::auth() AND ($address OR $addresses)): ?>
            <div class="row">
            <?php if (\app\models\User::auth() AND $address): ?>
                <div class="col-12">
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

                                <p class="col-6 text-right">House / Apartment</p>
                                <p class="col-6 "><?=$userAddress['house'];?><?=$userAddress['apartment'] ? '/'.$userAddress['apartment'] : null;?></p>

                                <p class="col-6 text-right">ZIP</p>
                                <p class="col-6"><?=$userAddress['zip'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php foreach ($addresses as $key => $val): ?>
                <div class="col-12">
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
            </div>

            <a href="profile/address" class="btn btn-primary">My addresses</a>

            <div class="mt-4">
                <label for="address">Note <span class="text-muted">(Optional)</span></label>
                <textarea name="note" class="form-control"><?=isset($_SESSION['form-data']['note']) ? html($_SESSION['form-data']['note']) : null;?></textarea>
            </div>
        <?php endif; ?>
    <?php if ($address OR $addresses): ?>
    <?php else: ?>

        <?php if (!\app\models\User::auth()): ?>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?=isset($_SESSION['form-data']['email']) ? html($_SESSION['form-data']['email']) : null;?>" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>
        <?php endif; ?>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" name="first_name" value="<?=isset($_SESSION['form-data']['first_name']) ? html($_SESSION['form-data']['first_name']) : null;?>" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="middleName">Middle name <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="middleName" name="middle_name" value="<?=isset($_SESSION['form-data']['middle_name']) ? html($_SESSION['form-data']['last_name']) : null;?>">
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" name="last_name" value="<?=isset($_SESSION['form-data']['last_name']) ? html($_SESSION['form-data']['last_name']) : null;?>" required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?=isset($_SESSION['form-data']['city']) ? html($_SESSION['form-data']['city']) : null;?>" required>
                    <div class="invalid-feedback">
                        Please enter your city.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" id="street" name="street" value="<?=isset($_SESSION['form-data']['street']) ? html($_SESSION['form-data']['street']) : null;?>" required>
                    <div class="invalid-feedback">
                        Please enter your street.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="house">House</label>
                    <input type="text" class="form-control" id="house" name="house" value="<?=isset($_SESSION['form-data']['house']) ? html($_SESSION['form-data']['house']) : null;?>" required>
                    <div class="invalid-feedback">
                        Please enter your house.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="apartment">Apartment <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="apartment" name="apartment" value="<?=isset($_SESSION['form-data']['apartment']) ? html($_SESSION['form-data']['apartment']) : null;?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Country</label>
                    <select class="custom-select d-block w-100" id="country" name="country" required>
                        <option value disabled hidden selected>Choose...</option>
                        <?php //debug($_SESSION['form-data']); ?>
                        <?php foreach ($countries as $country) {
                            if (isset($_SESSION['form-data']['country']) AND $_SESSION['form-data']['country'] == $country) {
                                echo "<option selected>". $country . "</option>" . PHP_EOL;
                            } else {
                                echo "<option>". $country . "</option>" . PHP_EOL;
                            }
                        } ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid country.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="state">State/Region</label>
                    <input type="text" class="form-control" id="region" name="region" value="<?=isset($_SESSION['form-data']['region']) ? html($_SESSION['form-data']['region']) : null;?>" required>
                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?=isset($_SESSION['form-data']['zip']) ? html($_SESSION['form-data']['zip']) : null;?>" required>
                    <div class="invalid-feedback">
                        Zip code required.
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="address">Note <span class="text-muted">(Optional)</span></label>
                <textarea name="note" class="form-control"><?=isset($_SESSION['form-data']['note']) ? html($_SESSION['form-data']['note']) : null;?></textarea>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address" name="same-address" disabled>
                <label class="custom-control-label" for="same-address">Billing address is the same as my shipping address</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="save-info" name="save-info">
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div>
    <?php endif; ?>

            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                    <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="paypal">PayPal</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" required disabled>
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                        Name on card is required
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" required disabled>
                    <div class="invalid-feedback">
                        Credit card number is required
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration</label>
                    <input type="text" class="form-control" id="cc-expiration" required disabled>
                    <div class="invalid-feedback">
                        Expiration date required
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-cvv">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" required disabled>
                    <div class="invalid-feedback">
                        Security code required
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
    </div>
</div>
<br>