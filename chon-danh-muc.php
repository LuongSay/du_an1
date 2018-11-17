<?php 
require_once './commoms/utils.php';

if (isset($_GET['cate_id'])) {
	$id = $_GET['cate_id'];
	$sql = "SELECT * FROM products where cate_id = '$id'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$products= $stmt->fetchAll();
}else{
	$sql = "SELECT * FROM products";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$products= $stmt->fetchAll();
}

?>

<div class="row product pt-5">
	<?php foreach ($products as $key): ?>
		<div class="col-md-4 pb-1">
			<div class="card" style="height: 450px;overflow: hidden;">
				<div style="width: 100%;height: 252px">
					<img class="card-img-top" src="<?= $siteUrl.$key['image']?>" alt="Card image cap" width="100%" height="100%">
				</div>

				<div class="card-body text-center">
					<a href="chi-tiet-sp.php?id=<?= $key['id'] ?>" class="text-center"><h4><?= $key['product_name'] ?></h4></a><hr>
					<p class="card-text"><small class="text-muted"><?= $key['list_price']?> đ</small></p>
					<a href="save-cart.php?id=<?= $key['id']?>"><button type="button" class="btn btn-outline-success"><i class="fas fa-shopping-bag"></i></button></a>
				</div>
			</div>
		</div>
	<?php endforeach ?>

</div>


