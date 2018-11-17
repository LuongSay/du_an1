<?php 
require_once './commoms/utils.php';

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 8;
$offset = ($pageNumber-1)*$pageSize;

$sql = "select products.*,(select count(*) from products) as total_product from products limit $offset, $pageSize";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();


?>
<?php foreach ($products as $key): ?>
	<?php
	$detail = substr($key['detail'],0,100);
	?>
	<div class="col-lg-3 col-md-6 col-sm-6 col-6">
		<a href="chi-tiet-sp.php?id=<?= $key['id'] ?>">
			<div class="card" style="height: 575px;overflow: hidden;">
				<div style="width: 253px;height: 253px">
					<img class="card-img-top" src="<?= $siteUrl.$key['image']?>" alt="Card image cap" style="width: 100%;height: 100%">
				</div>
				<div class="card-body text-center" style="width: 100%;height: 210px;overflow: hidden;">
					<p class="card-text" style="width: 100%;height: 80px;"><?= $detail ?>...</p>
					<a href="chi-tiet-sp.php?id=<?= $key['id'] ?>" class="text-center"><h5><?= $key['product_name'] ?></h5></a>
					<p class="card-text"><small class="text-muted"><?= $key['list_price']?> đ</small></p>
					 <a href="save-cart.php?id=<?= $key['id']?>"><button type="button" class="btn btn-outline-success"><i class="fas fa-shopping-bag"></i></button></a>
				</div>

			</div></a>
		</div>

	<?php endforeach ?>

