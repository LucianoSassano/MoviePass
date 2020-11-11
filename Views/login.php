<?php
require_once(VIEWS_PATH . "header.php");
?>

<body class="base-login">
  <?php require_once(VIEWS_PATH . "navbar.php") ?>
  
  <?php if (isset($errorMsg)) { ?>
        <!-- Control de errores -->
        <div class="alert alert-danger" role="alert">
            <div class="container">
                <div class="alert-icon">
                    <i class="now-ui-icons objects_support-17"></i>
                </div>
                <strong>
                    
                       <?php echo $errorMsg; ?>
                    
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                    </span>
                </button>
            </div>
        </div>
    <?php } ?>

  <div class="login">
    <div class="container">
      <div class="row d-flex justify-content-center">
      <form class="login-form bord" action="<?php echo FRONT_ROOT . "login/login" ?>" method="POST">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email">

        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>

        


        <button type="submit" class="btn btn-primary btn-round">Login</button>
        <small id="emailHelp" class="form-text ">We'll never share your email with anyone else.</small>
      </form>
      <div class="mt-3">
      <?php \Utils\Helper\Helper::facebookAPI(); ?>
      </div>
      </div>
    </div>
  </div>

</body>

</html>