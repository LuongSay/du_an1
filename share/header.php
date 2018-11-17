<?php 
require_once '././commoms/utils.php';
$web_settings = "SELECT * FROM web_settings";
$stmt = $conn->prepare($web_settings);
$stmt->execute();
$web_settings = $stmt->fetch();

$menu = "SELECT * FROM menu WHERE status=1 ORDER BY id ASC";
$stmt = $conn->prepare($menu);
$stmt->execute();
$menu = $stmt->fetchAll();

$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
$totalPrice = 0;

$totalItemInCart = 0;
if(isset($_SESSION['CART'])
	&& count($_SESSION['CART'])>0){
	$cart = $_SESSION['CART'];
	foreach ($cart as $pro) {
		$totalItemInCart += $pro['quantity'];
	}
}




?>
<div class="container-fluid header border-bottom">
	<div class="container">
		<div class="row" style="padding-top: 20px">
			<div class="col-md-12 d-flex justify-content">
				<div class="col-lg-3 col-md-3 col-sm-3 col-3">
					<a href="index.php"><img src="<?= $siteUrl.$web_settings['logo']?>" class="img-fluid"></a>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 col-3">
					<div class="dropdown" style="padding-top: 10px">
						<button class="btn btn-link dropdown-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Tài khoản
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Đăng kí</a>
							<a class="dropdown-item" href="#">Đăng nhập</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-4 border-right">
					<form action="search.php" post="get" style="padding-top: 10px">
						<input type="search" name="search" placeholder="Tìm kiếm" class="form-control" >
						<div class="search">
							<button type="submit" class="btn btn-default"><i class="fas fa-search fa-lg"></i></button>
						</div>
					</form>
				</div>
	<!-- cart -->
				<div class="col-lg-2 col-md-2 col-sm-2 col-2 pt-2">
					<div class="dropdown dropdowns-no-carets dropdown-effect-fadeup float-right show">
						<a href="#" class="btn btn-icon btn-dark btn-link float-right dropdown-toggle cart-link" data-toggle="dropdown" aria-expanded="true">
							<span class="cart-link-icon"> <i class="fa fa-shopping-cart"></i> <span class="sr-only">Cart</span> <span class="cart-link-count bg-primary text-white"><?= $totalItemInCart ?></span> </span>
						</a>

						<!--Shopping cart dropdown -->
				<!-- 		<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow cart-dropdown-menu show" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-262px, 38px, 0px);">
							<h5 class="dropdown-header mb-0">
								Your Shopping Cart
							</h5>
							<hr class="mt-0 mb-3">
						
							<div class="cart-items">
								
								<?php foreach ($cart as $item): ?>
									<div class="cart-items-item">
									<a href="#" class="cart-img mr-2 float-left">
										<img class="img-fluid" src="$item['image']" alt="Product 1">
									</a>
									<div class="float-left">
										<h5 class="mb-0">
											<?= $item['name'] ?>
										</h5>
										<p class="mb-0"><?= $item['price'] *$item['quanlity']  ?></p>
										<a href="#" class="close cart-remove text-primary"> <i class="fa fa-times"></i> </a>
									</div>
								</div>
								<?php endforeach ?>
							
							</div>
							
							<hr class="mt-3 mb-0">
							<div class="dropdown-footer text-center">
								<?php 
									$totalPrice += $item['price']*$item['quanlity'];
								 ?>
								<h5 class="font-weight-bold">
									Tổng: <span class="text-primary"><?= $totalPrice ?></span>
								</h5>
								<a href="shop-cart.html" tabindex="-1" class="btn btn-outline-primary btn-sm btn-rounded mx-2">View Cart</a> <a href="shop-checkout.html" tabindex="-1" class="btn btn-primary btn-sm btn-rounded mx-2">Checkout</a> 
							</div>
						</div> -->
					</div>
					

				</div>
<!-- end cart -->
			</div>
		</div>

		<div class="row" style="padding-top: 50px;">
			<ul class="nav" style="color: black">
				<?php foreach ($menu as $key => $value): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= $value['url']?>"><?= $value['name'] ?></a>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>