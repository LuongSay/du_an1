<?php 
$path = '../';
require_once '../../commoms/utils.php';
session_start();
checkLogin(USER_ROLES['moderator']);

$sql = "SELECT * FROM contacts";
$stmt = $conn->prepare($sql);
$stmt->execute();
$contacts = $stmt->fetchAll();


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
							<table class="table table-bordered">
								<tbody><tr>
									<th style="width: 10px">Id</th>
									<th>Tên</th>
									<th>Email</th>
									<th width="300">Địa chỉ</th>
									<th width="300">Tin nhắn</th>
									<th><a class="btn btn-sm btn-succer">
									</a></th>
								</tr>
								<?php foreach ($contacts as $c): ?>

									<tr>
										<td>
											<?= $c['id']?>
										</td>
										<td>
											<?= $c['name'] ?>
										</td>

										<td>
											<?= $c['email']  ?>
										</td>
										<td>
											<?= $c['address']  ?>
										</td>
										<td><?= $c['messenger'] ?></td>
										<td>
											<a href="javascript:;" linkurl="<?= $adminUrl?>lien-he/remove.php?id=<?= $c['id']?>"
												class="btn btn-xs btn-danger btn-remove"
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