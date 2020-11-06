<?php require_once(VIEWS_PATH . "header.php"); ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaters">
        <?php
            if(!empty($theaters)){
                foreach ($theaters as $theater) {
                    ?>
            
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <form action="<?php echo FRONT_ROOT . " theater/modifyView" ?>" method="post">
            
                                    <h5 class="card-title">Cine: <?php echo $theater->getName(); ?></h5>
                                    <p class="card-text">Direccion: <?php echo $theater->getAddress(); ?></p>
            
                                    <input type="number" name="id" value="<?php echo $theater->getId(); ?>" hidden>
            
                                    <button class="btn btn-primary">Modify Theater</button>
                                </form>
                            </div>
                        </div>
            
                    <?php
                    }
            }
        ?>


    </div>
</body>

</html>