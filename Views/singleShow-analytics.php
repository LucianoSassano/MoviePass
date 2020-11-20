<?php require_once(VIEWS_PATH . "header.php") ?>

<body  class="analytics">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="container mt-4">
        <div class="row ">


            <div class="col-5">
                <div class="card card-round mb-3" >
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
            <div class="col-7" >
                <hr>


                <?php if (isset($tickets) && isset($seats)) { ?>

                    <label>Amount of tickets sold</label>
                    <div> <?php echo $tickets ?> </div>
                    <hr>
                    <label>Amount of unsold tickets </label>
                    <div> <?php echo $seats ?> </div>


                <?php } else { ?>

                    <p>No tickets sold </p>
                <?php } ?>
                <hr>


            </div>
        </div>
    </div>
    
</body>

</html>