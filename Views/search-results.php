<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="search-results" >
        <div class="container">
            <?php if (!isset($errorMsg)) { ?>

                <div class="card" style="width: 18rem;">
                    <img src="<?php echo "https://image.tmdb.org/t/p/original/" . $movie->getPoster_path(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">

                        <h5 class="card-title"><?php echo $movie->getTitle(); ?></h5>
                        <p class="card-text"><?php echo $movie->getOverview(); ?></p>
                        <hr>
                        <p> <?php echo $movie->getAdult() ? "Adult only" : "Family friendly" ?> </p>
                        <hr>

                        <p>
                            <p>Genres:</p>
                            <?php
                            if (!empty($movie->getGenres())) {
                                if (is_array($movie->getGenres())) {
                                    foreach ($movie->getGenres() as $genre) {
                                        echo $genre->getName() . " , ";
                                    }
                                } else {
                                    echo 'movies has no genres';
                                }
                            }
                            ?>
                        </p>

                        <hr>
                        <form action="<?php echo FRONT_ROOT . "show/createView" ?>" method="POST">
                            <input type="number" name="id" value="<?php echo $movie->getId(); ?>" hidden>
                            <button type="submit" class="btn btn-primary">Create Show</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <?php if(isset($errorMsg)){ ?>

                <p><?php echo $errorMsg ?></p>

            <?php }?>

        </div>
    </div>
</body>

</html>