<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="activeMovies">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
        <div class="container">

            <div class="row justify-content-center">
               
                    <div class="col-md-12 mt-3">
                        <div class="card mt-2 btn-round shad">
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-round ml-2" href="<?php echo FRONT_ROOT . 'movie/updateAll' ?>">Update Movies</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <form action="<?php echo FRONT_ROOT . "movie/searchMovie" ?>" method="POST">
                                        <div class="d-flex justify-content-around">
                                            <div class="col-md-7 form-group ">
                                                <input name="movie_name" style="margin: 10px 1px 0px" class="form-control" type="search" placeholder="Search a Movie" aria-label="Search">
                                            </div>
                                            <div class="col-md-5 d-flex justify-content-center">
                                                <button class="btn btn-primary btn-round" type="submit">
                                                <i class="now-ui-icons ui-1_zoom-bold"></i>
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                    
                        <div class="card-columns">
                            <?php
                            if (empty($movies)) { ?>
                                <p> No se encontraron peliculas cargadas </p>
                                <?php
                            } else {
                                foreach ($movies as $movie) {
                                ?>

                                    <div class="card bord shad mb-4" >
                                        <a href="<?php echo FRONT_ROOT . "show/createView/" . $movie->getId() ?>">
                                            <img src="<?php echo "https://image.tmdb.org/t/p/original/" . $movie->getPoster_path(); ?>" class="card-img-top bord" alt="...">
                                        </a>
                                        <div class="card-body">

                                            <h5 class="card-title"><?php echo $movie->getTitle(); ?></h5>
                                            <p class="card-text"><?php echo $movie->getOverview(); ?></p>
                                            <hr>
                                            <p> <?php echo $movie->getAdult() ? "Adult only" : "Family friendly" ?> </p>
                                            

                                            <p>
                                                
                                                <?php
                                                if (!empty($movie->getGenres())) { 
                                                    if (is_array($movie->getGenres())) { ?>
                                                    <hr>
                                                    <p>Genres:</p>
                                                    <?php
                                                        foreach ($movie->getGenres() as $genre) { ?>
                                                            <span class="badge badge-default"> <?php echo $genre->getName() ?> </span>

                                                        <?php
                                                        }
                                                    } else {
                                                        
                                                    }
                                                }
                                                ?>
                                            </p>

                                            <!-- <hr>
                                            <form action="<?php echo FRONT_ROOT . "show/createView" ?>" method="POST">
                                                <input type="number" name="id" value="<?php echo $movie->getId(); ?>" hidden>
                                                <div class="text-right">
                                                <button type="submit" class="btn btn-primary btn-round">Create Show</button>
                                                </div>
                                                
                                            </form> -->
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                
            </div>

        </div>
</body>

</html>