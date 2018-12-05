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

				<div class="col-lg-3 col-md-3 col-sm-3 col-3 pt-3">
					<?php if (isset($_SESSION['login'])): ?>
						<li class="dropdown user user-menu open">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							
								<span class="hidden-xs"><?= $_SESSION['login']['email'] ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								
								<li class="user-footer">

									<div class="pull-right">
										<a href="http://localhost/Leaning-PHP/du_an1/logout.php" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
						<?php else: ?>
							<div class="dropdown">
								<button class="btn btn-link dropdown-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Tài khoản
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="./registered.php">Đăng kí</a>
									<a class="dropdown-item" href="./login.php">Đăng nhập</a>
								</div>
							</div>
						<?php endif ?>


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
						<div class="float-right">
							<a href="./detail-cart.php" class="btn btn-icon  float-right"  aria-expanded="true">
								<span class="cart-link-icon"> <i class="fa fa-shopping-cart"></i> <span class="sr-only">Cart</span> <span class="cart-link-count "><?= $totalItemInCart ?></span> </span>
							</a>

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