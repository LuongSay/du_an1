<?php
session_start(); 
require_once './commoms/utils.php';

// 1. Kiem tra xem id danh muc co thuc su ton tai khong
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
							<option value="/hoa-qua?sort=p.date_added&amp;order=DESC" selected="selected">Mặc định</option> 
							<option value="/hoa-qua?sort=pd.name&amp;order=ASC">Tên (A - Z)</option> 
							<option value="/hoa-qua?sort=pd.name&amp;order=DESC">Tên (Z - A)</option> 
							<option value="/hoa-qua?sort=p.price&amp;order=ASC">Giá (Thấp &gt; Cao)</option> 
							<option value="/hoa-qua?sort=p.price&amp;order=DESC">Giá (Cao &gt; Thấp)</option> 
						</select>
					</div>
					<div class="col-md-2 toolbar2 pull-right select">
						<select id="input-limit" class="form-control" style="font-size: 13px" onchange="location = this.value;">
							<option value="/hoa-qua?limit=9" selected="selected">9</option> <option value="/hoa-qua?limit=25">25</option>
							<option value="/hoa-qua?limit=50">50</option>
							<option value="/hoa-qua?limit=75">75</option>
							<option value="/hoa-qua?limit=100">100</option> 
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