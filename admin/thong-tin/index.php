<?php
session_start();
$path = "../";
//Hien thi danh sach danh muc cua he thong
require_once '../../commoms/utils.php';
$sql = "select * from web_settings";
$stmt = $conn->prepare($sql);
$stmt->execute();
$setting = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Xuper | Web Setting Admin</title>
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
                Web Setting
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Web Setting</li>
            </ol>
        </section>

        <!-- Main content --> 
        <section class="content">
            <div class="container">
                <div class="row">
                    <form method="POST" action="<?= $adminUrl?>thong-tin/save-edit.php" id="demoForm" enctype="multipart/form-data">
                        <input type="hidden" name="image_cf" value="<?= $setting['logo']?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="<?= $setting['hotline']?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="<?= $setting['email']?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Map</label>
                                <textarea name="map" cols="10" rows="7" class="form-control"><?= $setting['map']?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Fb</label>
                                <textarea name="fb" cols="10" rows="5" class="form-control"><?= $setting['fb']?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <img id="imageTarget" src="<?= $siteUrl?><?= $setting['logo']?>" class="img-responsive" >
                            </div>
                        </div>
                        <div class="form-group">
                          <label>Ảnh sản phẩm</label>
                          <input type="file" id="product_image" name="image" class="form-control">
                      </div>
                  </div>
                  <div class="col-md-12">
                       <input type="submit" name="submit" class="btn btn btn-primary btn-lg text-center" style="text-align: center" value="Sửa"></a>
                  </div>
                 


              </form>
          </div>
      </div>
  </section>
  <!-- /.content -->
</div>

<!-- /.content-wrapper -->
<?php include_once $path.'/_share/footer.php';?>

<!-- Control Sidebar -->

<!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
 </div>

 <!-- ./wrapper -->

 <?php
 include_once $path.'_share/bottom_asset.php';
 ?>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 
 <script type="text/javascript">
  $(document).ready(function(){
    $('#editor').wysihtml5();
  });
  function getBase64(file, selector) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      $(selector).attr('src', reader.result);
     };
     reader.onerror = function (error) {
       console.log('Error: ', error);
     };
  }
  var img = document.querySelector('#product_image');
  img.onchange = function(){
    var file = this.files[0];
    if(file == undefined){
      $('#imageTarget').attr('src', "<?= $siteUrl?>/<?= $setting['logo']?>");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>
</body>
</html>