<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="shows-active" >
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div>
        <div class="container mt-3">
            <hr>
            <div class="form-group">
                <form action="<?php echo FRONT_ROOT . "show/filter" ?>" method="POST">
                    <select name="genre_id">
                        <option value="" selected>Select filter...</option>
                        <?php
                        foreach ($genres as $genre) { ?>
                            <option value="<?php echo $genre->getId(); ?>"><?php echo $genre->getName(); ?></option>
                        <?php } ?>
                    </select>
                    <button class="btn btn-danger" type="submit">Filtrar</button>
                </form>
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
                } else if($shows){ ?>
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
                }else {
                    echo "No shows here ...";
                } 
                ?>

            </div>

        </div>
    </div>

</body>

</html>