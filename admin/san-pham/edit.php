<?php 
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once '../../commoms/utils.php';
session_start();
// dem ton so record trong bang danh muc
$productId = $_GET['id'];

$sql = "select * from ". TABLE_PRODUCT . " WHERE id = $productId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch();

$sql = "select 
           c.*
    from  ". TABLE_CATEGORY ." c";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates = $stmt->fetchAll();
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
        Update
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sản phẩm</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form enctype="multipart/form-data" action="<?= $adminUrl?>san-pham/save_edit.php" method="post" >
          
          <div class="col-md-6">
              
            <div class="form-group">
              <label>Tên sản phẩm</label>
              <input type="text" name="product_name" class="form-control" value="<?= $product['product_name']?>">
            </div>

            <input type="hidden" value="<?= $product['id']?>" name="id">
            <div class="form-group">
              <label>Danh mục</label>
              <select name="cate_id" class="form-control">
                <?php foreach ($cates as $c): ?>
                  
                      <option <?php 
                      if ($product['cate_id'] == $c['id']){echo "selected";}
                      ?> value="<?= $c['id']?>"><?= $c['name'] ?></option>
                  
                <?php endforeach ?>          
              </select>
            </div>
            <div class="form-group">
              <label>Giá bán</label>
              <input type="text" name="list_price" class="form-control" value="<?= $product['list_price']?>">
            </div>
            <div class="form-group">
              <label>Giá khuyến mại</label>
              <input type="text" name="sell_price" class="form-control" value="<?= $product['sell_price']?>">
            </div>
            <div class="form-group">
              <label>Status</label>
                  <select name="status">
                    <option value="1">Còn hàng</option>
                      <option value="0">Hết hàng</option>
                  </select>
               
            </div>
          </div>

          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <img id="imageTarget" src="<?= $siteUrl?>/<?= $product['image']?>" class="img-responsive" >
              </div>
            </div>
            <div class="form-group">
              <label>Ảnh sản phẩm</label>
              <input type="file" id="product_image" name="image" class="form-control">
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Mô tả</label>
              <textarea id="editor" rows="5" class="form-control" name="detail" ><?= $product['detail']?></textarea>
            </div>
          </div>
          <div class="col-md-12 text-right">
            <a href="<?= $adminUrl?>san-pham" class="btn btn-xs btn-danger">Huỷ</a>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $().ready(function() {
        $("#form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "product_name": {
                    required: true,

                    
                },
                
                "list_price":{
                    required: true,
                    number:true,
                },
               
                
                "detail":{
                    required: true,
                },
            },
            messages: {
                "product_name": {
                    required: "<p class='mb-0' style='color: red;'>Bạn cần nhập tên sản phẩm!!!</p>",
                   
                },
                

                "list_price":{
                    required: "<p class='mb-0' style='color: red;'>Vui lòng điền nội dung tin nhắn</p>",
                    number: "<p class='mb-0' style='color: red;'>Phải là số</p>"
                },
                "detail":{
                    required: "<p class='mb-0' style='color: red;'>Vui lòng điền mô tả</p>",
                    maxlength: "<p class='mb-0' style='color: red;'>You just type 200 word</p>"
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
      $('#imageTarget').attr('src', "<?= $siteUrl?>/<?= $product['image']?>");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>

</body>
</html>