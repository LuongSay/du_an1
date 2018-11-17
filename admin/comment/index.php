<?php 
//dem tong so repory trong bang danh muc;
$path = '../';
require_once '../../commoms/utils.php';
session_start();
checkLogin(USER_ROLES['moderator']);
$sql = "select
c.*,c.id as id_comment,
p.*
from  " . TABLE_COMMENT ." c
join " . TABLE_PRODUCT ." p
on c.product_id = p.id
group by c.id
order by c.id asc";
$stmt = $conn->prepare($sql);
$stmt->execute();
$comment = $stmt->fetchAll();


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
          Comment

        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">Id</th>
                  <th>Sản phẩm</th>
                  <th>Email</th>
                  <th width="300">Content</th>
                  <th><a class="btn btn-sm btn-succer">
                  </a></th>
                </tr>
                <?php foreach ($comment as $c): ?>

                  <tr>
                    <td>
                      <?= $c['id']?>
                    </td>
                      <td><a href="<?= $siteUrl?>chitiet.php?id=<?= $c['product_id']?>" target="_blank"><?= $c['product_name']?></a></td>
                    
                    <td>
                      <?= $c['email']  ?>
                    </td>
                    <td>
                      <?= $c['content']  ?>
                    </td>
                    
                    <td>
                      <a href="javascript:;"
                      linkurl="<?= $adminUrl?>comment/remove.php?id=<?= $c['id_comment']?>"
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
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once $path.'_share/footer.php'; ?>  

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