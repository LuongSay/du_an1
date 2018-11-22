<?php 
session_start(); 
require_once './commoms/utils.php';
$id = $_GET['id'];
$commentSql = "select * from " . TABLE_COMMENT
. " where product_id = $id order by id desc";
$stmt = $conn->prepare($commentSql);
$stmt->execute();
$comments = $stmt->fetchAll();

$sql = "SELECT * FROM products where id='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch();

//view + 1
$updateView = "UPDATE products SET views=views+1 WHERE id='$id'";
$stsm = $conn->prepare($updateView);
$stsm->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<?php include './share/client_asset.php'; ?>

	<style type="text/css">
	$quantity-btn-color: #95d7fc;
	.product {
		width: 30%;
		margin: 30px;
	}
	.form-group {
		width: 30%;
		margin: 30px;
		.glyphicon {
			color: $quantity-btn-color;
		}
	}
	@import url(//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css);

	.detailBox {
		width:320px;
		border:1px solid #bbb;
		margin:50px;
	}
	.titleBox {
		background-color:#fdfdfd;
		padding:10px;
	}
	.titleBox label{
		color:#444;
		margin:0;
		display:inline-block;
	}

	
	.commentBox .form-group:first-child, .actionBox .form-group:first-child {
		width:80%;
	}
	.commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
		width:18%;
	}
	.actionBox .form-group * {
		width:100%;
	}
	.taskDescription {
		margin-top:10px 0;
	}
	.commentList {
		padding:0;
		list-style:none;
		max-height:200px;
		overflow:auto;
	}
	.commentList li {
		margin:0;
		margin-top:10px;
	}
	.commentList li > div {
		display:table-cell;
	}
	.commenterImage {
		width:30px;
		margin-right:5px;
		height:100%;
		float:left;
	}
	.commenterImage img {
		width:100%;
		border-radius:50%;
	}
	.commentText p {
		margin:0;
	}
	.sub-text {
		color:#aaa;
		font-family:verdana;
		font-size:11px;
	}
	.actionBox {
		border-bottom:1px dotted #bbb;
		padding:10px;
	}
</style>


</head>
<body>
	<?php require './share/header.php'; ?>
	<div class="container pt-5">
		<div class="row">
			<div class="col-md-5 border rounded" style="border: 1px solid grey">
				<img src="<?= $siteUrl.$product['image']?>" style="width: 100%">
			</div>
			<div class="col-md-5 pl-5">
				<h2><?= $product['product_name'] ?></h2><br>
				<h4><?= $product['list_price'] ?> đ</h4><br>
				<p><small>
					Thương hiệu: USA<br>
					Mã sản phẩm: <?= $product['product_name'] ?><br>
					Tình trạng: <?php if ($product['status'] == 1) {
						echo "Còn trong kho";
					}else {
						echo "Hết hàng";
					};
					?>
				</small></p>
				<hr>
				
					<a href="save-cart.php?id=<?= $product['id'] ?>"><button type="button" class="btn btn-success mt-5">Thêm vào giỏ</button></a>
			
				
			</div>
		</div>
		<div class="row pt-5 pb-5">
			<div class="col-3">
				<div class="nav flex-column default" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link btn-default" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mô tả</a>
					<a class="nav-link btn-default" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Đánh giá</a>
					<a class="nav-link btn-default" id="v-pills-comment-tab" data-toggle="pill" href="#v-pills-comment" role="tab" aria-controls="v-pills-comment" aria-selected="false">Bình Luận</a>
					
				</div>
			</div>
			<div class="col-9 border border-success">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active mb-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
						<br>
						<?= $product['detail'] ?>
					</div>
					<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">	
						<h2 class="pt-5">Viết đánh giá</h2>
						<form onsubmit="return validateForm()" class="myForm" id="myForm" action="submit_comment.php" method="POST">
							<input type="hidden" name="id" value="<?= $id?>">
							<div class="form-group" style="width: 750px">
								<label class="control-label" for="input-name">Email</label> 
								<input type="text" id="email" name="email" class="form-control" >
								
							</div>
							<div class="form-group" style="width: 750px">

								<label class="control-label" for="input-review">Nội dung đánh giá</label>
								<textarea class="form-control" id="content" rows="5" name="content"></textarea>
								<div class="help-block">

								</div>
							</div>
							<div class="buttons clearfix"> 
								<div class="pull-right d-flex justify-content-end">
									<button type="submit" " class="btn btn-success mb-2 mt-2">Gủi đi</button> 
								</div> 
							</div>
						</form>
					</div>
					<div class="tab-pane fade show" id="v-pills-comment" role="tabpanel" aria-labelledby="v-pills-comment-tab" style="height: 468px;overflow: scroll;">
						<div class="col-lg-12 pt-3">
							<?php foreach ($comments as $c): ?>
								<div class="actionBox">
									<ul class="commentList">
										<li>
											<div class="commenterImage">
												<img src="http://placekitten.com/50/50" />
											</div>
											<div class="commentText">
												<p class=""><?= $c['email'] ?></p> <span class="date sub-text"><?= $c['content'] ?></span>

											</div>
										</li>
									</ul>

								</div>
							<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<?php require './share/footer.php'; ?>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script type="text/javascript">
		function up(max) {
			document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
			if (document.getElementById("myNumber").value >= parseInt(max)) {
				document.getElementById("myNumber").value = max;
			}
		}
		function down(min) {
			document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
			if (document.getElementById("myNumber").value <= parseInt(min)) {
				document.getElementById("myNumber").value = min;
			}
		}

	</script>
	<script>
		$().ready(function() {
			$("#myForm").validate({
				onfocusout: false,
				onkeyup: false,
				onclick: false,
				rules: {
					"email": {
						required: true,
						email: true
					},

					"content":{
						required: true,
					}
				},
				messages: {
					"email": {
						required: "<p class='mb-0' style='color: red;'>Bạn cần nhập email !!!</p>",
						email: "<p class='mb-0' style='color: red;'>Cần nhập đúng định dạng !!!</p>"
					},


					"content":{
						required: "<p class='mb-0' style='color: red;'>Vui lòng điền nội dung tin nhắn</p>",
						maxlength: "<p class='mb-0' style='color: red;'>You just type 200 word</p>"
					}
				}
			});
		});
	</script>
</body>
</html>