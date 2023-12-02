<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <title><?=$this->meta['title'];?></title>

<?php if (!empty($this->meta['desc'])): ?>
    <meta name="description" content="<?=$this->meta['desc']; ?>">
<?php endif; ?>

<?php if (!empty($this->meta['keywords'])): ?>
    <meta name="keywords" content="<?=$this->meta['keywords']; ?>">
<?php endif; ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="img/logo.png" class="d-inline-block align-top" height="32" width="32" alt=""> HeatShop
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto" id="nav-items">
                        <li class="nav-item my-md-auto mt-3 mr-md-2">
                            <select id="currency" class="form-control form-control-sm">
								<?php new \app\widgets\currency\Currency(); ?>
							</select>
                        </li>
                        <li class="nav-item" id="main">
                            <a class="nav-link" href="/">Main</a>
                        </li>
                        <li class="nav-item" id="about-us">
                            <a class="nav-link" href="about-us" tabindex="-1" aria-disabled="true">About Us</a>
                        </li>
                        <li class="nav-item" id="contact-us">
                            <a class="nav-link" href="contact-us" tabindex="-1" aria-disabled="true">Contact Us</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <form class="form-inline">
                            <div class="cart" style="position: relative">
                                <a href="cart/show" onclick="getCart(); return false;">
                                    <i class="btn fas fa-shopping-basket" style="font-size: 120%"></i>
                                <?php if (!empty($_SESSION['cart'])): ?>
                                    <span class="cart_total badge badge-primary badge-pill"><?=$_SESSION['cart.qty'];?></span>
                                <?php else: ?>
                                    <span class="cart_total badge badge-primary badge-pill"></span>
                                <?php endif; ?>
                                </a>
                            </div>
                        <?php if (!empty($_SESSION['user'])): ?>
                            <li class="nav-item dropdown active ml-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								My profile
								</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (\app\models\User::isAdmin()): ?>
                                    <a class="dropdown-item" href="admin">Admin Panel</a>
                                    <div class="dropdown-divider"></div>
                                <?php endif; ?>
                                    <a class="dropdown-item" href="profile">Dashboard</a>
                                    <a class="dropdown-item" href="profile/orders">My orders</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="user/logout">Log Out</a>
                                </div>
                            </li>
                        <?php else: ?>
                            <a type="button" href="login" class="btn btn-sm btn-primary mx-3 my-2">Log In</a>
                            <a type="button" href="signup" class="btn btn-sm btn-success my-2">Sign Up</a>
                        <?php endif; ?>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container p-0">
        <div class="text-center py-1">
            <?php new \app\widgets\category\Category(); ?>
        </div>
    </div>

    <div class="container pb-4">
        <?=$content;?>
    </div>

    <?php if (isset($_SESSION['form-data'])) unset($_SESSION['form-data']); ?>

    <footer class="bg-dark text-light mt-5 py-5">
        <div class="container">
            <div class="row text-center text-md-left">
                <div class="col-md-4 mb-5">
                    <div class="navbar-brand">
                        <img src="img/logo.png" class="d-inline-block align-top" height="40" width="40" alt="">
                        <span class="h3 font-weight-bold">HeatShop</span>
                    </div>
                    <span class="d-block text-white-50">HeatShop – a PHP MVC shop!</span>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h5 class="mb-4 font-weight-bold text-uppercase">Solutions</h5>
                            <ul class="list-group">
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a href="#" class="text-white-50">Sales</a></li>
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a href="#" class="text-white-50">Project Management</a></li>
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a href="#" class="text-white-50">Delivery</a></li>
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a href="#" class="text-white-50">E-Commerce</a></li>
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a href="#" class="text-white-50">Finance</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5 class="mb-4 font-weight-bold text-uppercase">Company</h5>
                            <ul class="list-group">
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a href="about-us" class="text-white-50">About</a></li>
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a href="contact-us" class="text-white-50">Contact</a></li>
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a class="text-white-50 mr-4" href="#">Privacy &amp; terms</a></li>
                                <li class="list-group-item bg-transparent border-0 p-0 mb-2"><a class="text-white-50 mr-4" href="#">Sitemap</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3 text-lg-right">
                            <h5 class="mb-4 font-weight-bold text-uppercase">Connect</h5>
                            <div class="h5 icon-feed">
                                <a class="text-white-50" href="https://linkedin.com/" target="_blank"><i class="fab fa-linkedin mr-1"></i></a>
                                <a class="text-white-50" href="https://github.com/slavtov/HeatShop" target="_blank"><i class="fab fa-github mr-1"></i></a>
                                <a class="text-white-50" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter mr-1"></i></a>
                                <a class="text-white-50" href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f mr-1"></i></a>
                                <a class="text-white-50" href="https://vk.com/" target="_blank"><i class="fab fa-vk mr-1"></i></a>
                                <a class="text-white-50" href="https://instagram.com/" target="_blank"><i class="fab fa-instagram mr-1"></i></a>
                                <a class="text-white-50" href="https://youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                            </div>
                            <div class="h2 mt-3 text-white-50 icon-feed">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-paypal"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="cart" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Continue shopping</button>
                    <a href="cart/view" type="button" class="btn btn-primary">Checkout</a>
                    <button type="button" class="btn btn-danger" onclick="clearCart()">Empty trash</button>
                </div>
            </div>
        </div>
    </div>

    <script>
		var path = '<?=PATH;?>',
			cource = '<?=$_SESSION['currency']['value'];?>',
			symbol = '<?=$_SESSION['currency']['symbol'];?>';
	</script>

    <!--scripts-->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>

</body>
</html>