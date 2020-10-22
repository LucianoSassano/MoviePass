<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
  <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="admin">
        <div class="container">
            <div class="card-columns">
                <?php
                foreach ($movies as $movie) {
                ?>

                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo "https://image.tmdb.org/t/p/original/" . $movie->getPoster_path(); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $movie->getTitle(); ?></h5>
                            <p class="card-text"><?php echo $movie->getOverview(); ?></p>
                            <p> <?php echo $movie->getAdult() ? "Adult only" : "Family friendly" ?> </p>
                            <a href="<?php echo FRONT_ROOT . "show/createView" ?>" class="btn btn-primary">Create Show</a>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>