<?php 
session_start();


// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/ultis.php";

checkLogin();
$id = $_GET['id'];
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
  <title>AdminLTE 2 | Edit Profile</title>

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
        Dashboard
        <small>Edit Profilec</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="<?= $adminUrl ?>profile/save-edit.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <input type="hidden" name="id" value="<?= $id ?>">
          <input type="hidden" name="old_filename" value="<?= $u['avatar'] ?>">
            <div class="form-group">
              <label>Tên</label>
              <input type="text" name="name" class="form-control" value="<?= $u['fullname'] ?>">
              <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <span class="text-danger"><?= $_GET['errName'] ?></span>
              <?php } ?>
            </div>
            <div class="row">
            <div class="col-md-offset-3">
              <img  id="imageTarget" width="70%" src="<?= $siteUrl ?><?= $u['avatar'] ?>" class="img-reponsive">
            </div>
          </div>
          <div class="form-group">
              <label>Ảnh</label>
              <input id="product_image" type="file" name="image" class="form-control">
            </div>
            <div class="col-md-12">
          <div class="text-center">
              <a href="<?= $adminUrl?>profile" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Sửa</button>
            </div>
        </div>
            
          
        </div>
        <div class="col-md-6">

        </div>
        
      </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once $path.'_share/sidebar.php'; ?>  

</div>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?>  
<script type="text/javascript">
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
