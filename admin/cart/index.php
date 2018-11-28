<?php 
$path = '../';
require_once '../../commoms/utils.php';
session_start();
checkLogin(USER_ROLES['moderator']);

$sql = "SELECT * FROM invoices";
$stmt = $conn->prepare($sql);
$stmt->execute();
$invoices = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Cart</title>
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
					Cart

				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Cart</li>
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
									<th>Chi tiết hóa đơn</th>
									<th>ID Hóa đơn</th>
									<th>Tên khách hàng</th>
									<th>Số điện thoại</th>
									<th>Email</th>
									<th>Tổng hóa đơn</th>
									<th>Tin nhắn</th>
									<th>Ngày đặt hàng</th>
									<th>Trạng thái</th>
									<th><a class="btn btn-sm btn-succer">
									</a></th>
								</tr>
								<?php foreach ($invoices as $c): ?>

									<tr>
										<td><a href="detail_invoice.php?id=<?= $c['id']?>">Xem chi tiết</td>
										<td>
											<?= $c['id']?>
										</td>
										<td>
											<?= $c['customer_name'] ?>
										</td>

										<td>
											<?= $c['customer_phone']  ?>
										</td>
										<td>
											<?= $c['customer_email']  ?>
										</td>
										
										<td>
											<?= $c['total_price']  ?>đ
										</td>
										<td>
											<?= $c['note']  ?>
										</td>
										<td>
											<?= $c['created_date']  ?>
										</td>
										
										<td>
											<?php if ($c['status'] == 0): ?>
												<a href="edit.php?id=<?= $c['id']?>" class="btn btn-sm btn-danger" style="width: 63%;">Chưa xử lí</a>
											<?php else: ?>
												<a href="edit.php?id=<?= $c['id']?>" class="btn btn-sm btn-info" style="width: 63%;">Đã xử lí</a>
											<?php endif ?>
									</td>
									<td>
										<a href="javascript:;" linkurl="<?= $adminUrl?>cart/remove.php?id=<?= $c['id']?>"
											class="btn btn-sm btn-danger btn-remove"
											>
											<i class="fa fa-trash"></i> Xoá
										</a>
									</td>
								</tr>
							<?php endforeach ?>



						</tbody></table>
					</div>
					<!-- /.box-body -->
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