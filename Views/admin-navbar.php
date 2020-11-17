<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 0px;">
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shows
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "show/getActive" ?>">View available</a>
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "movie/getAll" ?>">Create show</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT . 'movie/getAll' ?>">Movies</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Analytics
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "admin/profitAnalytics" ?>">Profits</a>
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "admin/ticketsAnalytics" ?>">Tickets sold</a>
                </div>
            </li>

        </ul>

        <form class="form-group form-inline my-2 my-lg-0" action="<?php echo FRONT_ROOT . "movie/searchMovie" ?>" method="POST" >
            <input name="movie_name" class="form-control mr-sm-2" type="search" placeholder="Search a Movie" aria-label="Search">
            <button class="btn btn-primary btn-icon btn-round my-2 my-sm-0" type="submit"><i class="now-ui-icons ui-1_zoom-bold"></i></button>
        </form>
        <form class="form-inline my-2 my-lg-3">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <span class="nav-link"> <?php if (isset($_SESSION["loggedUser"])) {
                                                echo "Welcome " . $_SESSION["loggedUser"]->getEmail();
                                            } ?> </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "login/logout" ?>">Logout</a>
                </li>
            </ul>
        </form>
    </div>
</nav>