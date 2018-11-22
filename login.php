<?php
session_start();
require_once './commoms/utils.php';
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container" style="margin-top: 10%;margin-left: 40%">
    <div class="col-lg-4 text-center">
      <a href="<?= $siteUrl ?>post-login.php"><img src="<?= $siteUrl?>public/img/logo.png"></a>

      <!-- /.login-logo -->
      <form action="post-login.php" method="post">
        <input type="email" class="form-control mt-3" name="email" placeholder="Email">
        <input type="password" class="form-control mt-3 mb-3" name="password" placeholder="Password">


        <div class="">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </form>
    </div>
  </div>



</body>
</html>
