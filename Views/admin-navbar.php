<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "home/index" ?>">Logout</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Theaters
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "admin/showTheaters" ?>">Show Theathers</a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "admin/createTheaterForm" ?>">Create a Theather</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . 'movie/updateAll' ?>">Update Movies</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>