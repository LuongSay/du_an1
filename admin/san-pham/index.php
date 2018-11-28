<?php 
//dem tong so repory trong bang danh muc;
$path = '../';
require_once '../../commoms/utils.php';
session_start();
checkLogin(USER_ROLES['moderator']);


$sql = "select p.*,c.`name` as namecate from  categories c join products p on c.id = p.cate_id group by id desc";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates = $stmt->fetchAll();

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 4;
$offset = ($pageNumber-1)*$pageSize;

// 2. lay danh sach san pham thuoc danh muc
$sql = "select count(*) as total_product from products ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$countproduct = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <link rel="stylesheet" href="<?= $siteUrl ?>plugins/simplePagination/simplePagination.css">
  <script src="<?= $siteUrl ?>plugins/simplePagination/jquery.simplePagination.js"></script>
  <style type="text/css">

  td,th{
    text-align: center;
  }

</style>

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
          Product

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
                  <th style="width: 10px">ID</th>
                  <th>Tên danh mục</th>
                  <th>Game</th>
                  <th width="300">Mô tả</th>
                  <th>Giá</th>
                  
                  <th>Ảnh sản phẩm</th>
                  <th>Tình trạng</th>
                  <th>Lượt xem</th>
                  <th><a href="<?= $adminUrl?>san-pham/add.php" class="btn btn-sm btn-succer">
                    <i class="fa fa-plus"></i> Thêm mới</a></th>
                  </tr>
                  <?php foreach ($cates as $c): ?>
                    <tr>
                      <td><?= $c['id']  ?></td>
                      <td><?= $c['namecate']  ?></td>
                      <td>
                        <?= $c['product_name']  ?>
                      </td>

                      <td><div style="overflow: scroll;width: 250px;height: 170px"><?= $c['detail'] ?></div></td>
                      <td style=><?= $c['list_price'] ?>$</td>

                      <td
                      ><img src="<?= $siteUrl.$c['image']?>" width="250px" height="150px"></td>
                      <td> <?php 
                      if ($c['status'] == 1) {
                       echo "Còn hàng";
                     }else {
                       echo "Hết hàng";
                     } ?>
                   </td>
                   <td><?= $c['views'] ?></td>
                   <td>
                    <a href="<?= $adminUrl?>san-pham/edit.php?id=<?= $c['id']?>"
                      class="btn btn-xs btn-info"
                      >
                      <i class="fa fa-pencil"></i> Cập nhật
                    </a>
                    <a href="javascript:;"
                    linkurl="<?= $adminUrl?>san-pham/remove.php?id=<?= $c['id']?>"
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
    <!-- ./col -->


  </section>

  
    <div class="row">
      <div class="paginate"></div>
    </div>
  

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once $path.'_share/sidebar.php'; ?>  
</div>
</body>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?>
<script type="text/javascript">
  var pageUrl = '<?= $adminUrl. "san-pham.php?id=" . $id?>';
  $('.paginate').pagination({
    items: <?=$countproduct['total_product']?>,
    currentPage: <?= $pageNumber?>, 
    itemsOnPage: <?= $pageSize?>,
    cssStyle: 'light-theme',
    onPageClick: function(val){
      window.location.href = pageUrl+`&page=${val}`;
    }
  });
</script>
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