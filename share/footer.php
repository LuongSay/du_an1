<?php 
require_once '././commoms/utils.php';
// truy van websettings
$sql = "SELECT * FROM web_settings";
$stmt = $conn->prepare($sql);
$stmt->execute();
$web_settings = $stmt->fetch();


?>
	<div class="container-fluid footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<address class="pl-5">
						<h5 class="pt-5" style="color: #333;
						margin: 0 0 30px 0;font-size: 15px;
						font-weight: 600;">GIỚI THIỆU</h5>
						<span style="font-weight:600;">Địa chỉ:</span><br>
						<p style="font-size:15px;margin: 0 0 10px;"><?= $web_settings['adress'] ?></p><br>
						<span style="font-weight:600;">Số điện thoại:</span><br>
						<p style="font-size:15px;margin: 0 0 10px;"><?= $web_settings['hotline'] ?></p><br>
						<span style="font-weight:600;">Email:</span><br>
						<p style="font-size:15px;"><?= $web_settings['email'] ?></p><br>
					</address>
				</div>
				<div class="col-md-6 pt-5 d-flex justify-content-end">
					<iframe name="f212fe33db99808" width="1200px" height="1500px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/v2.10/plugins/page.php?adapt_container_width=true&amp;app_id=829732533863539&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2F__Bz3h5RzMx.js%3Fversion%3D42%23cb%3Df1e2552f94e0ca8%26domain%3Dselan.myzozo.net%26origin%3Dhttp%253A%252F%252Fselan.myzozo.net%252Ff59bd9f00d84%26relation%3Dparent.parent&amp;container_width=263&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FFacebookVietNam&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=none" style="border: none; visibility: visible; width: 263px; height: 214px;" class=""></iframe>
				</div>
			</div>
			
		</div>
	</div>
	<div class="container-fluid" style="height: 50px;padding: 20px 0;
	background: #f3f6f5;">
	<div class="container">
		<p style="margin: 0;
		color: #666;
		font-size: 14px;
		line-height: 25px;">Nguyễn Đại Lượng PH06219</p>
	</div>