<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="analytics">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title">Tickets sold and remaining from shows</h3>
                <div class="form-group">
                    <form action="<?php echo FRONT_ROOT . "admin/showTheaterAnalytics" ?>" method="POST">

                        <select class="form-control" name="theater_id">
                            <option value="NULL">Select a theater </option>
                            <?php if (is_array($theaters)) {
                                if (!empty($theaters)) {
                                    foreach ($theaters as $theater) {
                            ?>

                                        <option value="<?php echo $theater->getId() ?>"> <?php echo $theater->getName() ?> </option>


                            <?php }
                                }
                            } ?>
                            <?php if (!is_array($theaters)) { ?>
                                <option value="<?php echo $theater->getId() ?>"> <?php echo $theater->getName() ?> </option>
                            <?php } ?>
                        </select>
                        <button class="btn btn-primary">Select</button>
                    </form>

                </div>
            </div>



        </div>

    </div>

</body>

</html>