<?php require_once(VIEWS_PATH . "header.php"); ?>

<body>
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaters">
        <div class="container mt-4">
            
        <?php
        if(is_array($theaters)){
            if(!empty($theaters)){
                foreach ($theaters as $theater) {
                    ?>
            
                        <div class="card btn-round" style="background-color: rgba(255, 255, 255, 0.95);">
                            <div class="card-body" style="padding: 0rem;">
                                <form action="<?php echo FRONT_ROOT . " theater/modifyView" ?>" method="post">
            
                                <div class="card-header mt-2"><h5> <?php echo $theater->getName(); ?></h5></div><hr>
                                <div class="card-body">

                                    <div class="row d-flex justify-content-between">
                                        <div class="col-md-6">
                                            <strong> Direccion: </strong><?php echo $theater->getAddress(); ?>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button class="btn btn-primary btn-round" style="margin: 0;">Modify Theater</button>
                                        </div>
                                    </div>

                                </div>

                                <input type="number" name="id" value="<?php echo $theater->getId(); ?>" hidden>
            
                                    
                                </form>
                            </div>
                        </div>
            
                    <?php
                    }
            }
        } else { ?>
            <div class="card btn-round" style="background-color: rgba(255, 255, 255, 0.95);">
                <div class="card-body" style="padding: 0rem;">
                    <form action="<?php echo FRONT_ROOT . " theater/modifyView" ?>" method="post">

                        <div class="card-header mt-2"><h5> <?php echo $theaters->getName(); ?></h5></div><hr>

                        <div class="card-body">

                            <div class="row d-flex justify-content-between">
                                <div class="col-md-6">
                                    <strong> Direccion: </strong><?php echo $theaters->getAddress(); ?>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-primary btn-round" style="margin: 0;">Modify Theater</button>
                                </div>
                            </div>
                            
                        </div>

                        <input type="number" name="id" value="<?php echo $theaters->getId(); ?>" hidden>

                        
                    </form>
                </div>
            </div>

        <?php
        }
        ?>

</div>
    </div>
</body>

</html>