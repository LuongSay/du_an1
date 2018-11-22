<?php 
session_start();
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
$totalPrice = 0;
require './commoms/utils.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>
  </title>
  <?php 
  require_once './share/client_asset.php' ;
  ?>
</head>
<body>
  <?php 
  require_once './share/header.php';
  ?>
  <div class="container pt-5">
   <div class="row">
    <div class="col-lg-4">
      <form action="save-cart2.php" method="POST">
        <h5>Địa chỉ</h5>
        <table>

          <tr>Họ Tên</tr>
          <tr><input class="form-control mb-3" type="text" name="name"></tr>

          <tr>Số điện thoại</tr>
          <tr><input class="form-control mb-3" type="text" name="phone"></tr>


          <tr>Email</tr>
          <tr><input class="form-control mb-3" type="text" name="email"></tr>

          <tr>Ghi chú</tr>
          <tr><textarea class="form-control" name="note"></textarea></tr>

        </table>
      </div>
      <div class="col-lg-8">
        <a href="reload-cart.php">Làm mới</a>
        <table class="table table-condensed text-center">
          <thead>
            <tr>

              <th>Ảnh</th>
              <th>Tên Sản Phẩm</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Tổng</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>

             <?php foreach ($cart as $item): ?>

              <td><img src="<?= $item['image'] ?>" width="100"></td>
              <td><?= $item['product_name'] ?></td>
              <td><?= $item['list_price'] ?></td>
              <td><input class="text-center" style="width: 70px" type="number" name="quantity" value="<?= $item['quantity'] ?>"></td>
              <td><?= $total = $item['list_price']*$item['quantity'] ?></td>

              <td>
                <a href="javascript:;"
                linkurl="del-cart.php?id=<?=$item['id']?>"
                class="btn-remove"
                >
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php $totalPrice += $item['quantity']*$item['list_price'];
          ?> 
        <?php endforeach ?>
      </tbody>
    </table>
    <div class="float-right">
     <b>Tổng giá trị đơn hàng : <?= $totalPrice ?> VNĐ</b>
   </div>
   <button type="submit">Mua hang</button>
 </form>
</div> 
</div>
</div>

<?php 
require_once './share/footer.php';
?>
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


