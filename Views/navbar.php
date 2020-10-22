<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo FRONT_ROOT . 'home/index' ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1) { ?>

        <li class="nav-item">
          <a class="nav-link" href="#">My Shows</a>
        </li>

      <?php } ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <?php if (!isset($_SESSION["loggedUser"])) { ?>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT . "login/index" ?>">Login</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT . "login/signup" ?>" tabindex="-1">Signup</a>
          </li>

        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT . "login/logout" ?>">Logout</a>
          </li>

        <?php } ?>
      </ul>
    </form>
  </div>
</nav>