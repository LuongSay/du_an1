<?php
session_start(); 
require_once './commoms/utils.php';
if (isset($_GET['cate_id'])) {
	$id = $_GET['cate_id'];
};
// 1. Kiem tra xem id danh muc co thuc su ton tai khong
$sql = "select * from ".TABLE_CATEGORY."";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetchAll();

$sql = "select * from ".TABLE_CATEGORY."";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetchAll();

$sql = "select * from " . TABLE_PRODUCT."";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sản phẩm</title>
	<?php include './share/client_asset.php'; ?>
	<link rel="stylesheet" type="text/css" href="./plugins/simplePagination/simplePagination.css">
	<script type="text/javascript" src="./plugins/simplePagination/jquery.simplePagination.js"></script>
	<style type="text/css">
	.select select option{
		font-size: 12px;
	}
</style>
</head>
<body>
	<?php require './share/header.php'; ?>
	<div class="container">
		<div class="row pt-5">
			<div class="col-3">
				<div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<?php foreach ($cate as $key): ?>
						<a class="nav-link" id="v-pills-home-tab" href="san-pham.php?cate_id=<?= $key['id'] ?>"><?= $key['name'] ?></a>
					<?php endforeach ?>
					
				</div>
			</div>
			<div class="col-9">
				<div class="row d-flex justify-content-end">
					<div class="col-md-2 toolbar1 pull-right select">
						<select id="input-sort" class="form-control" style="font-size: 13px" onchange="location = this.value;" >
							<?php if (isset($id)): ?>
								<option value="" selected="selected">Sắp xếp</option> 
								<option value="san-pham.php?cate_id=<?= $id ?>&&order=ASC">
									Giá (Thấp &gt; Cao)
								</option> 
								<option value="san-pham.php?cate_id=<?= $id ?>&&order=DESC">
									Giá (Cao &gt; Thấp)
								</option>
								<?php else: ?>
									<option value="" selected="selected">Sắp xếp</option> 
									<option value="san-pham.php?order=ASC">
										Giá (Thấp &gt; Cao)
									</option> 
									<option value="san-pham.php?order=DESC">
										Giá (Cao &gt; Thấp)
									</option>
								<?php endif ?>
							</select>
						</div>
						<div class="col-md-2 toolbar2 pull-right select">
							<select id="input-limit" class="form-control" style="font-size: 13px" onchange="location = this.value;">
								<?php if (isset($id)): ?>
									<option value="" selected="selected">Hiển thị</option> 
									<option value="san-pham.php?cate_id=<?= $id?>&&limit=5">5</option>
									<option value="san-pham.php?cate_id=<?= $id?>&&limit=10">10</option>
									<option value="san-pham.php?cate_id=<?= $id?>&&limit=15">15</option>
									<option value="san-pham.php?cate_id=<?= $id?>&&limit=20">20</option> 
									<?php else: ?>
										<option value="" selected="selected">Hiển thị</option> 
										<option value="san-pham.php?limit=5">5</option>
										<option value="san-pham.php?limit=10">10</option>
										<option value="san-pham.php?limit=15">15</option>
										<option value="san-pham.php?limit=20">20</option> 
									<?php endif ?>

								</select>
							</div>
						</div>			
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
								<?php 
								require_once 'chon-danh-muc.php';
								?>
							</div>

						</div>
					</div>
				</div>
				<hr>
			</div>
			<?php require './share/footer.php'; ?>
			<script type="text/javascript">
				var pageUrl = '<?= $siteUrl. "chon-danh-muc.php?id=" . $id?>';
				$('.paginate').pagination({
					items: <?=$cate['total_product']?>,
					currentPage: <?= $pageNumber?>, 
					itemsOnPage: <?= $pageSize?>,
					cssStyle: 'light-theme',
					onPageClick: function(val){
						window.location.href = pageUrl+`&page=${val}`;
					}
				});
			</script>
		</body>
		</html>