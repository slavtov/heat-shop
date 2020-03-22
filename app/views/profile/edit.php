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
                    <a href="profile/address" class="list-group-item list-group-item-action">Order address</a>
                    <a href="profile/edit" class="list-group-item list-group-item-action active">Edit personal data</a>
                    <a href="profile/password" class="list-group-item list-group-item-action">Change password</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-user"></i>&nbsp;Edit personal data</div>
                    <div class="card-body">
                        <form id="signup" role="form" method="post" class="form-input" novalidate>
                            <div class="form-group">
                                <label for="email" class="mr-2">Email</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?=$_SESSION['user']['email'];?>" value="<?=isset($_SESSION['form-data']['email']) ? html($_SESSION['form-data']['email']) : null;?>">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="username" class="mr-2">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?=$_SESSION['user']['username'];?>" value="<?=isset($_SESSION['form-data']['username']) ? html($_SESSION['form-data']['username']) : null;?>">
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