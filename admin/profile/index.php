<?php 
session_start();


// hien thi danh sach danh muc cua he thong

$path = "../";
require_once $path.$path."commons/ultis.php";

checkLogin(USER_ROLES['moderator']);

// dem ton so record trong bang danh muc
$id = $_SESSION['login']['id'];
$sql = "select * from 
			users  where id = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$u = $stmt->fetch();

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Quản lý Profile</title>

  <?php include_once $path.'_share/top_asset.php'; ?>
  <style type="text/css">
  *{margin:0px;padding: 0px}


  	html {
  
  min-height: 100%;
  background: linear-gradient(#9d9181, #9e866c);
}

body {
  background-color: transparent;
}

.card-profile {
  width: 350px;
  margin: 50px auto;
  background-color: #e6e5e1;
  border-radius: 0;
  border: 0;
  box-shadow: 1em 1em 2em rgba(0, 0, 0, 0.2);
}
.card-profile .card-img-top {
  border-radius: 0;
}
.card-profile .card-img-profile {
  max-width: 100%;
  border-radius: 50%;
  margin-top: -95px;
  margin-bottom: 10px;
  border: 5px solid #e6e5e1;
}
.card-profile .card-title {
  margin-bottom: 50px;
}
.card-profile .card-title small {
  display: block;
  font-size: 0.6em;
}
.card-profile .card-links {
  margin-bottom: 25px;
}
.card-profile .card-links .fa {
  margin: 0 1px;
  font-size: 1em;
}
.card-profile .card-links .fa:focus, .card-profile .card-links .fa:hover {
  text-decoration: none;
}
.card-profile .card-links .fa.fa-dribbble {
  color: #ea4b89;
  font-weight: bold;
}
.card-profile .card-links .fa.fa-dribbble:hover {
  color: #e51d6b;
}
.card-profile .card-links .fa.fa-twitter {
  color: #68aade;
}
.card-profile .card-links .fa.fa-twitter:hover {
  color: #3e92d5;
}
.card-profile .card-links .fa.fa-facebook {
  color: #3b5999;
}
.card-profile .card-links .fa.fa-facebook:hover {
  color: #2d4474;
}
.card-profile .card-links a{
	padding: 5px;
	margin-bottom: 10px;
  </style>
}

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
        Dashboard
        <small>Quản lý Profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="container">
    		<div class='card card-profile text-center'>
  <img alt='' class='card-img-top' src='<?= $siteUrl ?>img/160.jpg'>
  <div class='card-block'>
    <img  width="200px" id="imageTarget" alt='' class='card-img-profile' src='<?= $adminUrl . $u['avatar'] ?>'>

    <h4 class='card-title'>
      <div>
      	<b><?= $u['fullname'] ?></b>
      </div>
      <br>  
      <div>
      	<?= $u['email'] ?>
      </div>
      
    </h4>
    <h4 class='card-title'>
      
      <small></small>
    </h4>
    <div class='card-links'>
     <!-- <a href="<?= $adminUrl ?>profile/edit.php?id=<?= $_SESSION['login']['id'] ?>" class="btn btn-xs btn-info">
	                  			<i class="fa fa-pencil"></i> Edit -->
	                  <a>		</a>
    </div>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
	<?php 
	if(isset($_GET['success']) && $_GET['success'] == 'true'){
		?>
		swal('Thêm Profile thành công!');
	<?php
	}
	 ?>
	$('.btn-remove').on('click', function(){

		var removeUrl = $(this).attr('linkurl');
		// var conf = confirm('Bạn có chắc chắn muốn xoá Profile này không?');
		// if(conf){
		// 	window.location.href = removeUrl;
		// }
		swal({
		  title: "Cảnh báo",
		  text: "Bạn có chắc chắn muốn xoá Profile này không?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		    window.location.href = removeUrl;
		  } 
		});
	});

  $(document).ready(function(){
    $('#editor').wysihtml5();
  })


  function getBase64(file, selector) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      $(selector).attr('src', reader.result);
       // return reader.result;
     };
     reader.onerror = function (error) {
       console.log('Error: ', error);
     };
  }

  var img = document.querySelector('#product_image');
  img.onchange = function(){
    var file = this.files[0];
    if (file == undefined) {
      $('#imageTarget').attr('src', "<?= $siteUrl ?>/img/default/image.png" )
    }
    getBase64(file, '#imageTarget');
  }








</script>

</body>
</html>
