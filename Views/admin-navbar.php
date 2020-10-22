<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "admin/dashboard" ?>">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Theaters
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "theater/showAll" ?>">Show Theathers</a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "theater/createView" ?>">Create a Theather</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "show/getActive" ?>">Shows</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . 'movie/getAll' ?>">Movies</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <span class="nav-link"> <?php echo "Hola " . $_SESSION["loggedUser"]->getEmail(); ?> </span>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT . "login/logout" ?>">Logout</a>
                    </li>
                </ul>
            </form>
        </div>
    </nav>