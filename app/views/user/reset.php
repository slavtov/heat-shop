<!-- Success or Error report -->
<?php getError(); ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card mx-auto mt-md-5">
            <div class="card-body">
                <h4 class="card-title mb-5">Set Password</h4>

                <form role="form" method="post" class="form-login" novalidate>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control" name="password" placeholder="New password" required>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control" name="confirm-password" placeholder="Confirm password" required>
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