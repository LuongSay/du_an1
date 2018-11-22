<?php
$path = "";
include_once '../commoms/utils.php';
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] == null) {
  header('location: '.$siteUrl.'login.php');
  die;
}
if ($_SESSION['login']['role']<300) {
    header('location:'.'../index.php');
  }
//dem tong so repory trong bang danh muc;
$sql = "select count(*) as total from ".TABLE_CATEGORY;
$stsm = $conn->prepare($sql);
$stsm->execute();
$totalCate = $stsm->fetch();

$sql = "select count(*) as total from ".TABLE_PRODUCT;
$stsm = $conn->prepare($sql);
$stsm->execute();
$countPro = $stsm->fetch();

$sql = "select count(*) as total from ".TABLE_COMMENT;
$stsm = $conn->prepare($sql);
$stsm->execute();
$countComment = $stsm->fetch();

$sql = "select count(*) as total from users";
$stsm = $conn->prepare($sql);
$stsm->execute();
$countUser = $stsm->fetch();


 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>

  <?php include_once './_share/top_asset.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include_once './_share/header.php'; ?> 

  <?php include_once './_share/sidebar.php'; ?>  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>danh-muc"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $totalCate['total']  ?></h3>

              <p>Tổng số danh mục</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?= $adminUrl?>danh-muc" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $countPro['total']  ?><sup style="font-size: 20px"></sup></h3>

              <p>Tổng số sản phẩm</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= $adminUrl?>san-pham" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $countComment['total']?></h3>

              <p>Số lượng phản hồi sản phẩm</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= $adminUrl?>comment" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $countUser['total']?></h3>

              <p>Tài khoản</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= $adminUrl?>tai-khoan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once './_share/sidebar.php'; ?>  

</div>
<!-- ./wrapper -->
<?php include_once './_share/bottom_asset.php'; ?>  

</body>
</html>