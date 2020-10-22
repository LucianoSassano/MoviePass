<?php require_once(VIEWS_PATH . "header.php"); ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaters">
        <div class="container">
            <?php
            foreach ($theaters as $theater) {
            ?>

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $theater->getName(); ?></h5>
                        <p class="card-text"><?php echo $theater->getAddress(); ?></p>
                        <a href="<?php echo FRONT_ROOT . " admin/modifyTheater" ?>" class="btn btn-primary">Modify Theater</a>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</body>

</html>