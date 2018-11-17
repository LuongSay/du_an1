<?php 
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once '../../commoms/utils.php';
session_start();
// dem ton so record trong bang danh muc
$id = $_GET['id'];
$sql = "select * from slideshows where id='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$slideshows = $stmt->fetch();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Quản lý sản phẩm</title>

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
        <small>Slideshow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sản phẩm</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <form enctype="multipart/form-data" action="<?= $adminUrl?>slideshow/save_edit.php" method="post" id="form">
          <input type="hidden" value="<?= $slideshows['id']?>" name="id">
           <input type="hidden" name="old_filename" value="<?= $slideshows['image'] ?>">
          <div class="col-md-6">
             <div class="form-group">
              <label>Url</label>
              <input type="text" name="url" class="form-control" value="<?= $slideshows['url']?>">
            </div>
            <div class="form-group">
              <label>Status</label>
                  <select name="status">
                    <option value="1">Hiển thị</option>
                      <option value="0">Ẩn</option>
                  </select>
               
            </div>
            
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <img id="imageTarget" src="<?= $siteUrl?><?= $slideshows['image'] ?>" class="img-responsive" >
              </div>
            </div>
            <div class="form-group">
              <label>Ảnh sản phẩm</label>
              <input type="file" name="image" id="product_image" class="form-control">
            </div>
          </div>
          
          <div class="col-md-12 text-right">
            <a href="<?= $adminUrl?>slideshow" class="btn btn-xs btn-danger">Huỷ</a>
            <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <?php include_once $path.'_share/footer.php'; ?>  
  <!-- /.content-wrapper -->
  <?php include_once $path.'_share/sidebar.php'; ?>  
</div>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?> 

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
      $('#imageTarget').attr('src', "<?= $siteUrl ?>$slideshow['image']");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script>
    $().ready(function() {
        $("#form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "url": {
                    required: true,
                    url:true,

                    
                },
                
            
            },
            messages: {
                "url": {
                    required: "<p class='mb-0' style='color: red;'>Bạn cần nhập url!!!</p>",
                    url: "<p class='mb-0' style='color: red;'>Cần nhập đúng định dạng url!!!</p>",
                },
                

            }
        });
    });
</script>

</body>
</html>