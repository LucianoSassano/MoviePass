<?php

require_once(VIEWS_PATH . "header.php");

?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- Destruir session ? -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "home/index" ?>">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "admin/dashboard" ?>">Dashboard</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="show">
        <div class="container">
            <div class="card mb-3">
                <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Movie Title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.<br>
                        This content is a little bit longer.</p>
                    <label for="start">Pick Show date:</label>
                    <input type="date" id="show" name="show-date" value="2020-10-20" min="2020-10-20" max="2018-12-40">
                    <br>
                    <button class="btn btn-info">Create</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>