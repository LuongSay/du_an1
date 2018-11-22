<?php 
$path = '../';
require_once '../../commoms/utils.php';
session_start();
checkLogin(USER_ROLES['moderator']);
$sql = "select
c.*,
(select count(*) from products where cate_id = c.id) as totalProduct
from ".TABLE_CATEGORY." c
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates = $stmt->fetchAll();



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Dashboard</title>

	<?php include_once $path.'_share/top_asset.php'; ?>
	
</style>
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
					<div class="box">


						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tbody><tr>
									<th style="width: 10px">ID</th>
									<th>Tên danh mục</th>
									<th>Ảnh danh mục</th>
									<th>Sản phẩm</th>
									<th width="300">Mô tả</th>
									<th><a href="<?= $adminUrl?>danh-muc/add.php" class="btn btn-sm btn-succer">
										<i class="fa fa-plus"></i>
									Thêm mới</a></th>
								</tr>
								<?php foreach ($cates as $c): ?>
									<tr>
										<td><?= $c['id']  ?></td>
										<td><?= $c['name']  ?></td>
										<td><img src="<?= $siteUrl ?><?= $c['image']?>" style="width: 100px"></td>
										<td>
											<?= $c['totalProduct']  ?>
										</td>
										<td><?= $c['order_number'] ?></td>
										<td>
											<a href="<?= $adminUrl?>danh-muc/edit.php?id=<?= $c['id']?>"
												class="btn btn-xs btn-info"
												>
												<i class="fa fa-pencil"></i> Cập nhật
											</a>
											<a href="javascript:;"
											linkurl="<?= $adminUrl?>danh-muc/remove.php?id=<?= $c['id']?>"
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
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php include_once $path.'_share/sidebar.php'; ?> 

</div>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?>
<!-- ./alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
		var pageUrl = '<?= $adminUrl. "danh-muc?id=".$id?>';
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