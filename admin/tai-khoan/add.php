<?php 
session_start();
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once '../../commoms/utils.php';
checkLogin(USER_ROLES['admin']);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Quản lý Tài khoản</title>

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
        <small>Quản lý tài khoản</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tài khoản</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form action="<?= $adminUrl?>/tai-khoan/save-add.php" method="post" id="form">
          <div class="col-md-6">
            <div class="form-group">
              <label>Email</label>
              <!-- /.error -->
              <?php 
              if(isset($_GET['msg2']) && $_GET['msg2'] != ""){
               ?>
               <span class="text-danger"> | <?= $_GET['msg2'] ?></span>
              <?php } 
              ?>

              <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Tên đầy đủ</label>
              <input type="text" name="fullname" class="form-control">
            </div>
            <div class="form-group">
              <label>Số điện thoại</label>
              <input type="text" name="sdt" class="form-control">
            </div>
            <div class="form-group">
              <label>Mật khẩu</label>
              <input type="password" id="password" name="password" class="form-control">
            </div>
            <!-- /.error -->
              <?php 
              if(isset($_GET['msg']) && $_GET['msg'] != ""){
               ?>
               <span class="text-danger"><?= $_GET['msg'] ?></span>
              <?php } 
              ?>
            <div class="form-group">
              <label>Xác nhận mật khẩu</label>
              <input type="password" name="confirm_password" class="form-control">
            </div>
            <div class="form-group">
              <label>Quyền</label>
              <select name="role" class="form-control">
                <?php foreach (USER_ROLES as $key => $value): ?>
                  <option value="<?= $value?>"><?= $key ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-md-12 text-right">
              <a href="<?= $adminUrl?>san-pham" class="btn btn-xs btn-danger">Huỷ</a>
              <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
            </div>
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

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $().ready(function() {
        $("#form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "email": {
                    required: true,
                    email:true,
          
                },
                
                "fullname":{
                    required: true,
                    minlength:2,
                },
               
                
                "password":{
                    required: true,
                     minlength:6,
                },
                "confirm_password":{
                    required: true,
                     minlength:6,
                    equalTo: "#password",
                },
            },
            messages: {
                "email": {
                    required: "<p class='mb-0' style='color: red;'>Bạn cần nhập email!!!</p>",
                    email: "<p class='mb-0' style='color: red;'>Cần nhập đúng định dạng email!!!</p>",
                },
                

                "fullname":{
                    required: "<p class='mb-0' style='color: red;'>Vui lòng điền tên</p>",
                    minlength: "<p class='mb-0' style='color: red;'>Độ dài ít nhất 2 kí tự</p>",
                },
                
                "password":{
                    required: "<p class='mb-0' style='color: red;'>Vui lòng nhập mật khẩu</p>",
                    minlength: "<p class='mb-0' style='color: red;'>Độ dài ít nhất 6 kí tự</p>",
                },
                "confirm_password":{
                    required: "<p class='mb-0' style='color: red;'>Vui lòng nhập đầy đủ</p>",
                    minlength: "<p class='mb-0' style='color: red;'>Độ dài ít nhất 6 kí tự</p>",
                    equalTo:"<p class='mb-0' style='color: red;'>Mật khẩu không khớp</p>",
                },
            }
        });
    });
</script>
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
      $('#imageTarget').attr('src', "<?= $siteUrl ?>img/default/default-picture.jpg");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>
</body>
</html>