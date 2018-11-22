<?php 
//dem tong so repory trong bang danh muc;
$path = '../';
require_once '../../commoms/utils.php';
session_start();
$cateId = $_GET['id'];
$sql = "select * from ". TABLE_CATEGORY . " WHERE id = $cateId";
$stsm = $conn->prepare($sql);
$stsm->execute();
$cate = $stsm->fetch();

if (!$cate) {
	header('location: '.$adminUrl. 'danh-muc');
};
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Dashboard</title>

	<?php include_once $path.'_share/top_asset.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<?php include_once $path.'_share/header.php'; ?> 

		<?php include_once $path.'_share/sidebar.php'; ?>  

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Category
					<small>Control panel</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-md-6">
						<form enctype="multipart/form-data" action="<?= $adminUrl ?>danh-muc/save-edit.php" method="post" id="form">
							<input type="hidden" name="id" value="<?= $cate['id'] ?>">
							<input type="hidden" name="image" value="<?= $cate['image'] ?>">
							<div class="form-group">
								<label>Tên danh mục</label>
								<input type="text" name="name" class="form-control" value="<?= $cate['name'] ?>"> 
							</div>
							<?php 
							if(isset($_GET['errName']) && $_GET['errName'] != ""){
								?>
								<span class="text-danger"><?= $_GET['errName'] ?></span>
							<?php } ?>
							<img id="imageTarget" src="<?= $siteUrl?>/<?= $cate['image']?>" class="img-responsive" >
							<div class="form-group">
								<label>Ảnh sản phẩm</label>
								<input type="file" id="product_image" name="image1" class="form-control" accept="image/*">
							</div>
							<div class="text-center">
								<a href="<?= $adminUrl?>danh-muc" class="btn btn-danger btn-xs">Huỷ</a>
								<button type="submit" class="btn btn-primary btn-xs">Cập nhật</button>
							</div>

						</form>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<?php include_once $path.'_share/sidebar.php'; ?> 

	</div>
	<!-- ./wrapper -->
	<?php include_once $path.'_share/bottom_asset.php'; ?>
	<!-- ./alert -->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script>
		$().ready(function() {
			$("#form").validate({
				onfocusout: false,
				onkeyup: false,
				onclick: false,
				rules: {
					"name": {
						required: true,
						
					},
				
				},
				messages: {
					"name": {
						required: "<p class='mb-0' style='color: red;'>Bạn cần nhập tên danh mục !!!</p>",
						
					},
					
					
				}
			});
		});
	</script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script type="text/javascript">
		$('.btn-remove').on('click', function(){
			var removeUrl = $(this).attr('linkurl');
			var conf = confirm("Bạn có chắc chắn muốn xoá danh mục này không?");
			if (conf) {
				window.location.href = removeUrl;
			};
	/*
		swal({
		  title: "Cảnh báo",
		  text: "Bạn có chắc chắn muốn xoá danh mục này không?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		    window.location.href = removeUrl;
		  } 
		}); 

		*/
	}); 
</script>

</body>
</html>