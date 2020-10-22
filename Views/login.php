<?php
require_once(VIEWS_PATH . "header.php");
?>

<body class="base-login">
  <?php require_once(VIEWS_PATH . "navbar.php") ?>

  <div class="login">
    <div class="container">
      <form class="login-form" action="<?php echo FRONT_ROOT . "login/login" ?>" method="POST">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email">

        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>

        <!-- Control de errores -->
        <p class="text-danger">
          <?php if (isset($errorMsg)) {
            echo $errorMsg;
          } ?>
        </p>


        <button type="submit" class="btn btn-primary">Login</button>
        <small id="emailHelp" class="form-text ">We'll never share your email with anyone else.</small>
      </form>
    </div>
  </div>

</body>

</html>