<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo FRONT_ROOT . 'home/index' ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Movies
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Popular</a>
          <a class="dropdown-item" href="#">New Releases</a>
          <a class="dropdown-item" href="#">Most Viewed</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT."login/index" ?>" >Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT . "login/signup" ?>" tabindex="-1" >Signup</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT . "admin/dashboard" ?>" tabindex="-1" >Admin</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>