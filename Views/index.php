<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="home-shows">
    <?php require_once(VIEWS_PATH . 'navbar.php'); ?>
    <div>
        <div class="container mt-3">

            <h1>Now Playing</h1>
            <hr>
            
            <div class="row d-flex justify-content-end">
                <div class="card shad col-md-12">
                    <div class="form-inline">
                        <form action="<?php echo FRONT_ROOT . "show/filterClientSide" ?>" method="POST">
                            <select name="genre_id" class="form-control"  style="color:white;">
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
                if(is_array($shows)){
                    if (!empty($shows)) {
                        foreach ($shows as $show) { ?>
                        <div class="card" style="width: 18rem;">
                        <a href="<?php echo FRONT_ROOT . "movie/getShows/". $show->getId(); ?>">
                            <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $show->getPoster_path(); ?>" class="card-img-top"  alt="...">
                        </a>
                            <div class="card-body">
                                <?php echo $show->getTitle(); ?> 
                                <p>Show duration: <strong class="text-bold"> <?php echo $show->getDuration(); ?> minutes </strong></p>
                                
                            </div>
                        </div>
                        <?php } ?>
                    <?php } else {
                        echo "No shows here ...";
                    } 
                } else { ?>
                    <div class="card" style="width: 18rem;">
                    <a href="<?php echo FRONT_ROOT . "movie/getShows/". $shows->getId(); ?>">
                        <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $shows->getPoster_path(); ?>" class="card-img-top"  alt="...">
                    </a>
                        <div class="card-body">
                            <?php echo $shows->getTitle(); ?> 
                            <p>Show duration: <strong class="text-bold"> <?php echo $shows->getDuration(); ?> minutes </strong></p>
                            
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>

            </form>
        </div>
    </div>

</body>

</html>