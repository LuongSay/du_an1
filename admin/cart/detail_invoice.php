<?php 
$path = '../';
require_once '../../commoms/utils.php';
session_start();
checkLogin(USER_ROLES['moderator']);
$id =$_GET['id'];
$sql = "select invoice_details.*,products.product_name from invoice_details inner join products on invoice_details.product_id = products.id where invoice_id='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$invoice_details = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Contacts</title>
	<?php include_once $path.'_share/top_asset.php'; ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include_once $path.'_share/header.php'; ?> 

		<?php include_once $path.'_share/sidebar.php'; ?>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">

				<h1>
					Contacts

				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Contacts</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="box">

						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered text-center">
								<tbody><tr>
									<th>Sản phẩm</th>
									
									<th>Số lượng</th>
									<th>Giá/1 sản phẩm</th>
									<th>Tổng tiền</th>
									
								</tr>
								<?php foreach ($invoice_details as $c): ?>

									<tr>
										<td>
											<a href="../../chi-tiet-sp.php?id=<?= $c['product_id']?>"><?= $c['product_name']?></a>
										</td>
										
										<td>
											<?= $c['quanlity'] ?>
										</td>

										<td>
											<?= $c['unit_price']  ?>đ
										</td>
										<td>
											<?= $c['total_price']  ?>đ
										</td>
										
									</tr>
								<?php endforeach ?>



							</tbody></table>
						</div>
						<div class="container-fuild float-left"><div class="row"><a href="../cart" class="btn btn-info" style="margin-left: 90%">Quay lại</a></div></div>
						<div class="box-footer clearfix">
							<ul class="pagination pagination-sm no-margin pull-right">
								<li><a href="#">«</a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">»</a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>

		</div>
		<?php include_once $path.'_share/footer.php'; ?>

	</div>
	<?php include_once $path.'_share/bottom_asset.php'; ?>
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