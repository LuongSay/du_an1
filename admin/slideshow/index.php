<?php 
//dem tong so repory trong bang danh muc;
$path = '../';
require_once '../../commoms/utils.php';
session_start();
checkLogin(USER_ROLES['moderator']);
$sql = "select * from slideshows";
$stmt = $conn->prepare($sql);
$stmt->execute();
$slideshows = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>

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
          SlideShows

        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php 
        if(isset($_GET['msg2']) && $_GET['msg2'] != ""){

         ?>
         <p class='mb-0' style='color: red;'><?= $_GET['msg2'] ?></p>
       <?php } 
       ?>
       <div class="row">
        <div class="box">

          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tbody><tr>
                <th style="width: 10px">ID</th>
                <th width="450">Ảnh</th>
                
                <th>url</th>
                <th>Status</th>
                <th><a href="<?= $adminUrl?>slideshow/add.php" class="btn btn-sm btn-succer">
                  <i class="fa fa-plus"></i>
                Thêm mới</a></th>
              </tr>
              <?php foreach ($slideshows as $c): ?>
                <tr>
                  <td><?= $c['id']  ?></td>
                  <td>
                    <img src="<?= $siteUrl?><?= $c['image']?>"width='400'>
                    
                  </td>
                  
                  <td>
                    <?= $c['url']  ?>
                  </td>

                  <td><?= $c['desc'] ?></td>
                  <td>
                   <a href="<?= $adminUrl ?>slideshow/edit.php?id=<?= $c['id'] ?>" 
                    class="btn btn-xs btn-primary btn-info">Sửa</a>
                    <a href="javascript:;"
                    linkurl="<?= $adminUrl?>slideshow/remove.php?id=<?= $c['id']?>"
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