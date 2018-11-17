<?php
session_start();
require './commoms/utils.php';

$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$category = $stmt->fetchAll();

//truy van product co luot view lon nhat
$sql = "SELECT * FROM products ORDER BY views DESC LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->execute();
$views = $stmt->fetchAll();

$web_settings = "SELECT * FROM web_settings";
$stmt = $conn->prepare($web_settings);
$stmt->execute();
$web_settings = $stmt->fetch();

//gio hang

// dd($category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	 <link rel="stylesheet" type="text/css" href="./plugins/simplePagination/simplePagination.css">
	 <script type="text/javascript" src="./plugins/simplePagination/jquery.simplePagination.js"></script>
	<?php include './share/client_asset.php'; ?>
	<style type="text/css">
	.product .card:hover{
		border: 1px solid green;
		transition: 1s;
	}
	.box{
		position: relative;
		margin-top: 10px;
	}
	.name{
		position: absolute;
		left: 50%;
		top: 20%;
		transform: translate(-50%, -50%);
		text-align: center;
		width: 300px;
		z-index: 1;
	}
	.name h2{
		
		font-family: 'Berkshire Swash';
		color: white;
		font-weight:700;
		font-size: 40px;
	}
	
 .cate-hover img:hover{
	transform: scale(1.2);
	transition: 2s;
	z-index: -999;
 }
</style>
</head>
<body>

	<?php require './share/header.php'; ?>
	<div class="container-fluid slideshow">
		<?php require 'slideshow.php'; ?>
	</div>
	
	<div class="container-fluid category pt-5 pb-5" style="background: rgb(243, 246, 245);">
		<div class="container">
			<div class="row">
				<div class=" col-md-12 text-center">
					<h1 style="font-weight:700;font-size:45px;">DANH MỤC NỔI BẬT</h1>
				</div>
			</div>
			<div class="row">
				<?php foreach ($category as $key): ?>
					<div class="box col-lg-3 col-md-6 col-sm-6 col-6 cate-hover">
						<div style="height: 349px;width: 255px;overflow: hidden;">
						<div class="name card-title card-title">
							<a href="san-pham.php?cate_id=<?= $key['id'] ?>"><h2><?= $key['name'] ?></h2></a>
						</div>
						<div class="img">
							<img width="100%" src="<?= $siteUrl.$key['image'] ?>">
						</div>
					</div></div>
				<?php endforeach ?>
			</div>
		</div>
		
		<div class="container-fluid tab-category">
			<div class="container">
				<div class="col-md-12 text-center pt-5">
					<h2 style="font-family: 'Berkshire Swash',cursive;font-size: 40px;">Sản Phẩm Của Chúng Tôi</h2>
				</div>

			</div>
			<div class="container">
				<div class="row product">
					<?php require_once './list-sanpham.php'; ?>
				</div>
			</div>
			<div class="row">
				<div class="paginate"></div>
			</div>
		</div>
	</div>
	<div class="container-fluid sub-contact p-5" style="background: rgb(243, 246, 245);">
		<div class="container">
			<div class="col-md-12">
				<h2 class="text-center" style="font-family: 'Berkshire Swash',cursive;font-size: 40px;">Vì Sao Chọn Chúng Tôi</h2>
				<div class="accordion" id="accordionExample">
					<div class="card pb-3">
						<div class="card-header" id="headingOne" style="background: rgb(98, 210, 162);">
							<h5 class="mb-0">
								<button class="btn btn-link text-white" type="button" style="text-decoration: none;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="fas fa-location-arrow"></i>  Đặt hàng nhanh chóng
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body " >
								Hỗ trợ đang hàng ngay qua điện thoại
							</div>
						</div>
					</div>
					<div class="card pb-3">
						<div class="card-header" id="headingTwo" style="background: rgb(98, 210, 162);">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed text-white" type="button" style="text-decoration: none;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									<i class="fas fa-truck-moving"></i> Miễn phí vận chuyển
								</button>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							<div class="card-body">
								Áp dụng cho đơn hàng từ 500.000
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree" style="background: rgb(98, 210, 162);text-decoration: none;">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed text-white" type="button" style="text-decoration: none;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									<i class="fas fa-phone"></i> Tư vấn 24/7
								</button>
							</h5>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
							<div class="card-body">
								Hãy nhấc máy lên và gọi <?= $web_settings['hotline']?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-12 col-sm-12 col-12">
					<img src="./public/img/cms1-1.png" class="container-fluid">
				</div>
				<div class="col-lg-3 col-md-12 col-sm-12 pt-5">
					<div class="row">
						<h3 class="border-bottom border-success" style="font-family: 'Berkshire Swash',cursive;font-size: 35px">Nổi bật</h3>

					</div>
					<div class="row d-flex justify-content-between">
						<?php foreach ($views as $key): ?>
							<div class="row col-lg-12 col-md-4 col-sm-4 col-4 pt-5">
								<div class="col-md-6">
									<img src="<?= $key['image'] ?>" style="width: 100%" class="rounded border border border-success">
								</div>
								<div class="col-md-6">
									<a href="chi-tiet-sp.php?id=<?= $key['id'] ?>"><h5 class="pb-3" style="font-size: 17px;color: black"><?= $key['product_name'] ?></h5></a>
									<a><?= $key['list_price'] ?>,000đ</a>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container banner2 pt-3">
			<div class="row justify-content-between">
				<div class="col-md-6">
					<img src="./public/img/cms-12.jpg" style="width: 99%">
				</div>
				<div class="col-md-6">
					<img src="./public/img/cms-13.jpg" style="width: 99%">
				</div>
			</div>
		</div>
	</div>
<!-- 	<div class="container-fluid news pt-5 pb-5" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;">
		<div class="row">
			<div class="col-md-6 "style="background: rgb(243, 246, 245);">
				<div class="row">
					<div class="col-md-6">
						<img src="./public/img/blog_2-465x450.jpg" style="width: 100%">
					</div>
					<div class="col-md-6 pt-5">
						<p>4/11/2018</p>
						<a href=""><h5 style="width: 100%;overflow: hidden;color: black;font-weight: bold">CÀ CHUA 500.000 ĐỒNG MỘT CÂY GIỐNG, CẢ TRIỆU ĐỒNG MỖI KG QUẢ</h5></a>
						<p>Sau cơn sốt săn cà chua thân gỗ giá cả triệu đồng/kg, nhiều người đang lùng giống loại cây này về trồng. Mỗi cây con được bán giá 500.000 đồng, còn một hạt giống là 50.000 đồng.
						Loại cà chua đắt đỏ này được nhiều bà nội trợ Việt tìm mua và trở nên sốt khoảng 2 tháng nay.</p>
						<a href=""><h5 style="width: 100%;overflow: hidden;color: black;font-weight: bold">Xem thêm</h5></a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row" style="background: rgb(243, 246, 245);">
					<div class="col-md-6">
						<img src="./public/img/blog_3-465x450.jpg" style="width: 100%">
					</div>
					<div class="col-md-6 pt-5"">
						<p>4/11/2018</p>
						<a href=""><h5 style="width: 100%;overflow: hidden;color: black;font-weight: bold">CÀ CHUA 500.000 ĐỒNG MỘT CÂY GIỐNG, CẢ TRIỆU ĐỒNG MỖI KG QUẢ</h5></a>
						<p>Sau cơn sốt săn cà chua thân gỗ giá cả triệu đồng/kg, nhiều người đang lùng giống loại cây này về trồng. Mỗi cây con được bán giá 500.000 đồng, còn một hạt giống là 50.000 đồng.
						Loại cà chua đắt đỏ này được nhiều bà nội trợ Việt tìm mua và trở nên sốt khoảng 2 tháng nay.</p>
						<a href=""><h5 style="width: 100%;overflow: hidden;color: black;font-weight: bold">Xem thêm</h5></a>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="container pt-5 pb-5 border-top border-bottom">
		<?php require 'doi-tac.php'; ?>
	</div>
	<div id='toTop'><button type="button" class="btn btn-success"><i class="fa fa-angle-up"></i></button></div>
	<?php require './share/footer.php'; ?>
	<style type="text/css">
	#toTop {
		padding: 5px 3px;

		color: #fff;
		position: fixed;
		bottom: 0;
		right: 5px;
		display: none;
	}
</style>
<script type="text/javascript">
		var pageUrl = '<?= $siteUrl. "danh-muc.php?id=" . $id?>';
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
<script type="text/javascript">
	$(window).scroll(function() {
		if ($(this).scrollTop()) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	});
	$("#toTop").click(function () {
   //1 second of animation time
   //html works for FFX but not Chrome
   //body works for Chrome but not FFX
   //This strange selector seems to work universally
   $("html, body").animate({scrollTop: 0}, 1000);
});
</script>
</div>
</div>
</body>
</html>