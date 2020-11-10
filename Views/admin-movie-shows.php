<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="homeViewShow">
    <?php require_once(VIEWS_PATH . 'admin-navbar.php'); ?>
    <div>
        <div class="container ">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">

                        <img src="<?php echo "https://image.tmdb.org/t/p/original/" . $movie->getPoster_path(); ?>" class="card-img-top" alt="...">
                        <div class="card-body">

                            <p>Duration: <strong class="text-bold"> <?php echo $movie->getDuration(); ?> minutes </strong></p>
                            <hr>
                            <p> <?php echo $movie->getAdult() ? "Adult only" : "Family friendly" ?> </p>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <hr>
                    <h2>Available Shows</h2>
                    <hr>

                    <?php
                    foreach ($theaters as $theater) {
                    ?>
                        <div class="card mb-3" style="margin: 20px;">
                            <div class="card-header">Cine: <?php echo $theater->getName() ?></div>

                            <div class="card-body">
                                <?php
                                foreach ($theater->getRooms() as $room) {
                                ?>
                                    <h4> Sala: <?php echo $room->getName() ?> </h4>
                                    <h6>Funciones de la sala:</h6>
                                    <br>
                                  
                                    <?php
                                    foreach ($room->getShows() as $show) {
                                    ?>
                                        <br>
                                        <p> Show date: <?php echo $show->getDate() ?></p>
                                        <p>Show Start: <?php echo $show->getStartTime() ?></p>
                                        <p>Show End: <?php echo $show->getEndTime() ?></p>
                                        <br>

                                        </p>

                                    <?php
                                    }
                                    ?>

                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>

</body>

</html>