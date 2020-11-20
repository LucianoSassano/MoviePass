<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="home-shows">
    <?php require_once(VIEWS_PATH . 'admin-navbar.php'); ?>
    <div>
        <div class="container mt-3">
            <div class="card-columns">
                <?php 
                if(is_array($shows)){
                    if (!empty($shows)) {
                        foreach ($shows as $show) { ?>
                        <div class="card" style="width: 18rem;">
                        <a href="<?php echo FRONT_ROOT . "admin/getSingleShowRatio/". $show->getId() . "/" . $theater_id; ?>">
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
                    <a href="<?php echo FRONT_ROOT . "admin/getSingleShowRatio/". $shows->getId() . "/" . $theater_id; ?>">
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