<?php 
session_start();
require_once './commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'GET'){
	header('location: ' . $siteurl);
	die;
}
$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 8;
$offset = ($pageNumber-1)*$pageSize;
$search = $_GET['search'];
$sql = "select * from products where product_name like '%$search%' limit $offset, $pageSize ";
$stmt =$conn->prepare($sql);
$stmt->execute();
$searchp = $stmt->fetchAll();
$sql = "select count(*) as total_search from products where product_name like '%$search%'";
$stmt =$conn->prepare($sql);
$stmt->execute();
$searchp2 = $stmt->fetch();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Search</title>
	<link rel="stylesheet" href="./plugins/simplePagination/simplePagination.css">
	<script src="./plugins/simplePagination/jquery.simplePagination.js"></script>
	<?php 
	require './share/client_asset.php'; ?>
	
</head>
<body>
	
	<?php 
	include './share/header.php' ?>
	
	
	<?php if (!$searchp):?>
		<h1 class="alert" style="text-align: center;">Không tìm thấy sản phẩm !!!</h1>
		<?php else:?>
			<div class="container pt-5 pb-5">
				<div class="row">
					<?php foreach ($searchp as $key): ?>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<a href="chi-tiet-sp.php?id=<?= $key['id'] ?>">
								<div class="card" style="height: 400px;overflow: hidden;">
									<div style="width: 253px;height: 253px">
										<img class="card-img-top" src="<?= $siteUrl.$key['image']?>" alt="Card image cap" style="width: 100%;height: 100%">
									</div>
									<div class="card-body text-center" style="width: 100%;height: 210px;overflow: hidden;">

										<a href="chi-tiet-sp.php?id=<?= $key['id'] ?>" class="text-center"><h5><?= $key['product_name'] ?></h5></a>
										<p class="card-text"><small class="text-muted"><?= $key['list_price']?>,000đ</small></p>
										<button type="button" class="btn btn-outline-success"><i class="fas fa-shopping-bag"></i></button>
									</div>

								</div></a>
							</div>
						<?php endforeach ?>
					<?php endif;?>

				</div>
				<div class="row">
					<div class="paginate"></div>
				</div>
			</div>

			<!-- /.row -->


		</body>
		<?php include "./share/footer.php" ?>
		<script type="text/javascript">
			var pageUrl = '<?= $siteurl. "search.php?search=".$search?>';
			$('.paginate').pagination({
				items: <?=$searchp2['total_search']?>,
				currentPage: <?= $pageNumber?>,
				itemsOnPage: <?= $pageSize?>,
				cssStyle: 'light-theme',
				onPageClick: function(val){
					window.location.href = pageUrl+`&page=${val}`;
				}
			});
		</script>
		</html>
