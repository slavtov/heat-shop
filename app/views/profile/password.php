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
                    <a href="profile/edit" class="list-group-item list-group-item-action">Edit personal data</a>
                    <a href="profile/password" class="list-group-item list-group-item-action active">Change password</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-lock"></i>&nbsp;Change password</div>
                    <div class="card-body">
                        <form method="post" class="form-input needs-validation" novalidate>
                            <div class="form-group">
                                <input type="password" class="form-control" name="old_password" placeholder="Old password" required>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="password" class="form-control" name="new_password" placeholder="New password" required>
                                </div>
                                <div class="col form-group">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password" required>
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