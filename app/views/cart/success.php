<div class="card mt-4">
    <div class="card-body text-center my-5">
        <h3>Thank You for your order!</h3>
        <p>The order will be processed shortly</p>
        <a href="/">Back to main</a>
    </div>
</div>

<?php if (isset($_SESSION['cart.success'])) unset($_SESSION['cart.success']); ?>