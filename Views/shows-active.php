<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="shows-active">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>

    <div class="show">
        <div class="container mt-3">
            <div class="row d-flex justify-content-end">
                <div class="card shad col-md-12">
                    <div class="form-inline">
                        <form action="<?php echo FRONT_ROOT . "show/filter" ?>" method="POST">
                            <select name="genre_id" class="form-control">
                                <option value="" selected>Select filter...</option>
                                <?php
                                foreach ($genres as $genre) { ?>
                                    <option value="<?php echo $genre->getId(); ?>"><?php echo $genre->getName(); ?></option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-danger btn-round" type="submit">Filtrar</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card-columns">
                <?php
                if (is_array($shows)) {
                    if (!empty($shows)) {
                        foreach ($shows as $show) { ?>
                            <div class="card card-round" style="width: 18rem;">
                                <a href="<?php echo FRONT_ROOT . "movie/getShows/" . $show->getId(); ?>">
                                    <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $show->getPoster_path(); ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <div class="card-header">
                                        <h4 style=" margin: 0px;"><?php echo $show->getTitle(); ?></h4><hr>
                                    </div>
                                    
                                    <p>Show duration: <strong class="text-bold"> <?php echo $show->getDuration(); ?> minutes </strong></p>

                                    <p>
                                                
                                        <?php
                                        if (!empty($show->getGenres())) { 
                                            if (is_array($show->getGenres())) { ?>
                                            <?php
                                                foreach ($show->getGenres() as $genre) { ?>
                                                    <span class="badge badge-default"> <?php echo $genre->getName() ?> </span>

                                                <?php
                                                }
                                            } else { ?>
                                                <span class="badge badge-default"> <?php echo $genre->getName() ?> </span>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </p>

                                </div>
                            </div>
                        <?php } ?>
                    <?php } else {
                        echo "No shows here ...";
                    }
                } else if (!is_array($shows)) { ?>
                    <div class="card card-round" style="width: 18rem;">
                        <a href="<?php echo FRONT_ROOT . "movie/getShows/" . $shows->getId(); ?>">
                            <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $shows->getPoster_path(); ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <div class="card-header">
                                <h4 style=" margin: 0px;"><?php echo $shows->getTitle(); ?></h4><hr>
                            </div>
                            <p>Show duration: <strong class="text-bold"> <?php echo $shows->getDuration(); ?> minutes </strong></p>
                            <p>
                                                
                                <?php
                                if (!empty($shows->getGenres())) { 
                                    if (is_array($shows->getGenres())) { ?>
                                    <?php
                                        foreach ($shows->getGenres() as $genre) { ?>
                                            <span class="badge badge-default"> <?php echo $genre->getName() ?> </span>

                                        <?php
                                        }
                                    } else { ?>
                                        <span class="badge badge-default"> <?php echo $genre->getName() ?> </span>
                                    <?php
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                <?php
                } else {
                    echo "No shows here ...";
                }
                ?>

            </div>

        </div>
    </div>

</body>

</html>