<?php 
session_start();
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once '../../commoms/utils.php';
checkLogin(USER_ROLES['admin']);
if (USER_ROLES < USER_ROLES['admin']) {
  header('location:.$adminUrl');
}
// dem ton so record trong bang danh muc
$sql = "select * from users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
// dd($cates);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Quản lý tài khoản</title>

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
        <table class="table table-stripped">
          <thead>
            <th>#</th>
            <th>Email</th>
            <th>Tên</th>
            <th>Quyền</th>
            
            <th>Số điện thoại</th>
            <th>
              <a href="<?= $adminUrl ?>tai-khoan/add.php" 
                  class="btn btn-sm btn-success">Thêm</a>
            </th>
          </thead>   
          <tbody>
            <?php foreach ($users as $u): ?>
              <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['fullname'] ?></td>
                <td>
                  <?php if ($u['role'] == USER_ROLES['admin']): ?>
                    <span>Quản trị</span>  
                  <?php elseif($u['role'] == USER_ROLES['moderator']): ?>
                    <span>Quản trị viên</span> 
                  <?php else: ?>
                    <span>Thành viên</span>  
                  <?php endif ?>
                  </td>
               
                <td><?= $u['phone_number'] ?></td>
                <td>
                  <a href="<?= $adminUrl ?>tai-khoan/edit.php?id=<?= $u['id'] ?>" 
                  class="btn btn-xs btn-primary btn-info">Sửa</a>
                        <a href="javascript:;"
                      linkurl="<?= $adminUrl?>tai-khoan/remove.php?id=<?= $u['id'] ?>"
                      class="btn btn-xs btn-danger btn-remove"
                      >
                      <i class="fa fa-trash"></i> Xoá
                    </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>       
        </table>
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