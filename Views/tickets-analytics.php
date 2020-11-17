<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="analytics">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <form action="<?php echo FRONT_ROOT . "ticket/historicTicketSales" ?>" method="POST">
                        <select class="form-control" name="theater_id">
                            <option value="NULL">Select a theater</option>
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
                        <button type="submit" class="btn btn-primary">Get Historic</button>
                    </form>

                </div>
                
            </div>

            <div class="col-12">
                <hr>
               
               
                <?php if (isset($sold) && isset($seats)) { ?>

                    <label>Amount of tickets sold</label>
                    <div> <?php echo $sold ?> </div>
                    <hr>
                    <label>Amount of unsold tickets $</label>
                    <div> <?php echo $seats ?> </div>


                <?php }else{ ?>

                    <p>No tickets sold </p>
                <?php } ?>
                <hr>


            </div>
        </div>
    </div>
    </div>
</body>

</html>