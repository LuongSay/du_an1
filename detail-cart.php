<?php 
session_start();
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
$totalPrice = 0;
require './commoms/utils.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<?php 
	require_once './share/client_asset.php' ;
	?>
</head>
<body>
	<?php 
	require_once './share/header.php';
	?>
	<div class="container pt-5">
		<div class="row">
			<div class="col-lg-4">
				<h5>Địa chỉ</h5>
				<form enctype="multipart/form-data" method="post" action="save-cart2.php" id="form">
					<table>

						<tr>Họ Tên</tr>
						<tr><input class="form-control" type="text" name="name"></tr><br>
						<tr>Số điện thoại</tr>
						<tr><input class="form-control" type="text" name="phone"></tr><br>
						<tr>Email</tr>
						<tr><input class="form-control" type="text" name="email"></tr><br>
						<tr>Ghi chú</tr>
						<tr><textarea class="form-control" name="note"></textarea></tr>

					</table>
				</div>
				<div class="col-lg-8">
					<a href="reload-cart.php">Làm mới</a>
					<table class="table table-condensed text-center">
						<thead>
							<tr>

								<th>Ảnh</th>
								<th>Tên Sản Phẩm</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Tổng</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php foreach ($cart as $item): ?>
									<input type="hidden" name="id_product" value="<?= $item['id']?>">
									<td><img src="<?= $item['image'] ?>" width="100"></td>
									<td><input type="hidden" name="product_name" value="<?= $item['product_name'] ?>"><?= $item['product_name'] ?></td>
									<td><input type="hidden" name="list_price" value="<?= $item['list_price'] ?>"><?= $item['list_price'] ?></td>
									<td><input type="hidden" name="quantity" value="<?= $item['quantity'] ?>">
										<input class="text-center" style="width: 70px" type="number" name="quantity" value="<?= $item['quantity'] ?>"></td>
										<td><?= $total = $item['list_price']*$item['quantity'] ?>
										<input type="hidden" name="total" value="<?= $total ?>">
									</td>

									<td>
										<a href="javascript:;"
										linkurl="del-cart.php?id=<?=$item['id']?>"
										class="btn-remove"
										>
										<i class="far fa-trash-alt"></i>
									</a>
								</td>
							</tr>
							<?php $totalPrice += $item['quantity']*$item['list_price'];
							?> 
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="row col-lg-12 d-flex justify-content-end">
					<b>Tổng giá trị đơn hàng : <?= $totalPrice ?> VNĐ</b>
				</div>
				<input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
				<div class="float-right pt-5">
					<button type="submit" class="btn btn-outline-info">TIẾP TỤC MUA HÀNG</button>
					<a href="save-cart2.php"><button type="submit" class="btn btn-outline-info">THANH TOÁN</button></a>

				</div>
			</form>

		</div> 
	</div>
</div>

<?php 
require_once './share/footer.php';
?>
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
				"phone": {
					required: true,
				},
				"email": {
					required: true,
					email:true,
				},
				

			},
			messages: {
				"name": {
					required: "<p class='mb-0' style='color: red;'>Vui lòng điền tên !!!</p>",

				},
				"phone": {
					required: "<p class='mb-0' style='color: red;'>Vui lòng nhập số điện thoại !!!</p>"
				},
				"email": {
					required: "<p class='mb-0' style='color: red;'>Vui lòng nhập email !!!</p>",
					email: "<p class='mb-0' style='color: red;'>Cần nhập đúng định dạng email!!!</p>"
				},
				
			}
		});
	});
</script>
<script type="text/javascript">
	$('.btn-remove').on('click', function(){
		var removeUrl = $(this).attr('linkurl');
		var conf = confirm("Bạn có chắc chắn muốn xoá danh mục này không?");
		if (conf) {
			window.location.href = removeUrl;
		}});
	</script>
</body>
</html>


