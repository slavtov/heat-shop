<!-- Success or Error report -->
<?php getReport(); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-auto mt-md-5">
            <div class="card-body">
                <h4 class="card-title mb-5">Log In</h4>

                <form method="post" class="form-input needs-validation" novalidate>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?=isset($_SESSION['form-data']['username']) ? html($_SESSION['form-data']['username']) : null;?>" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" data-error="Password is not 6 lendth" value="<?=isset($_SESSION['form-data']['password']) ? html($_SESSION['form-data']['password']) : null;?>" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mt-4">
                        <a href="password/reset" class="float-right">Forgot password?</a>
                        <label class="float-left custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" checked disabled>
							<div class="custom-control-label">Remember me</div>
						</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center mt-4">Don't have account? <a href="signup">Sign Up</a></p>
    </div>
</div>