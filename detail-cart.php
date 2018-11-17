<?php 
session_start();
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
$totalPrice = 0;
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>
    <?php 
    require_once './share/client_asset.php' ;
     ?>
  </title>
</head>
<body>
  <?php 
  require_once './share/header.php';
   ?>
</body>
</html>
 		<?php foreach ($cart as $item): ?>
 			<tr>
 				<td><?= $item['id'] ?></td>
 				<td><?= $item['product_name'] ?></td>
 				<td>
 					<img src="<?= $item['image'] ?>" width="100">
 				</td>
 				<td><?= $item['quantity'] ?></td>
 				<td><?= $item['list_price'] ?></td>
 				<td><?= $item['list_price']*$item['quantity'] ?></td>
 			</tr>
 			<?php 
 				$totalPrice += $item['list_price']*$item['quantity'];
 			 ?>
 		<?php endforeach ?>
 		<tr>
 			<td colspan="5">Tong so tien</td>
 			<td><?= $totalPrice ?></td>
 		</tr>
 	</tbody>
 </table>
 <div class="container">
  <h2>Condensed Table</h2>
  <p>The .table-condensed class makes a table more compact by cutting cell padding in half:</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th></th>
        <th>Ảnh</th>
        <th>Tên Sản Phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      
    </tbody>
  </table>
</div>
