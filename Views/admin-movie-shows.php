<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-image: linear-gradient(to right top, #051937, #102b65, #323a93, #6146c0, #984be9);color: #D1C4C2;" >
    <?php require_once(VIEWS_PATH . 'admin-navbar.php'); ?>
    <div class="show">
        <div class="container mt-4">
            <div class="row d-flex justify-content-around">
                
                <div class="col-md-5">
                    <div class="card card-round mb-3" style=" font-color:white;">
                        <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $movie->getPoster_path(); ?>" class="card-img-top" alt="...">
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
                <div class="col-md-7">
                    
                    <div class="card card-round shad">
                        <div class="card-body">
                            <div class="card-header">
                                <h2 style="margin-bottom: 0px;">Available shows</h2><hr>
                            </div>
                            
                            <?php
                    foreach ($theaters as $theater) {
                    ?>
                        <div class="card card-round shad mb-3">
                        <div class="card-body">
                            <div class="card-header">
                                <h3 style="margin-bottom: 0px;"><?php echo $theater->getName() ?></h3><hr>
                            </div>
                            
                            
                                <?php
                                foreach ($theater->getRooms() as $room) {
                                ?>
                                    
                                    <h4> Sala: <?php echo $room->getName() ?> </h4>
                                    <div class="card-body">
                                    <h6>Funciones de la sala:</h6>
                                  
                                    <?php
                                    foreach ($room->getShows() as $show) {
                                    ?>
                                        <div class="card-body">
                                        <p> Show date: <?php echo $show->getDate() ?></p>
                                        <p>Show Start: <?php echo $show->getStartTime() ?></p>
                                        <p>Show End: <?php echo $show->getEndTime() ?></p>

                                        </p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    </div>
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
        </div>
    </div>

</body>

</html>