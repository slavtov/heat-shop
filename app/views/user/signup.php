<!-- Success or Error report -->
<?php getError(); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-auto mt-md-5">
            <div class="card-body">
                <h4 class="card-title mb-5">Sign Up</h4>
                <form method="post" class="form-input needs-validation" novalidate>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email" value="<?=isset($_SESSION['form-data']['email']) ? html($_SESSION['form-data']['email']) : null;?>" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?=isset($_SESSION['form-data']['username']) ? html($_SESSION['form-data']['username']) : null;?>" required>
                    </div>
                    <div class="form-row">
                        <div class="col form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" data-error="Password is not 6 lendth" value="<?=isset($_SESSION['form-data']['password']) ? html($_SESSION['form-data']['password']) : null;?>" required>
                        </div>
                        <div class="col form-group">
                            <input type="password" class="form-control" name="confirm-password" placeholder="Confirm password" data-error="Password is not 6 lendth" value="<?=isset($_SESSION['form-data']['confirm-password']) ? html($_SESSION['form-data']['confirm-password']) : null;?>" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block mt-4">Submit</button>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" name="checkbox" checked required>
							<div class="custom-control-label">I am agree with <a href="#">terms and contitions</a></div>
						</label>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center mt-4">Have an account? <a href="login">Log In</a></p>
    </div>
</div>