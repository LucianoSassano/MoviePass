<?php require_once(VIEWS_PATH . "header.php") ?>

<body>
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="container">
        <div class="form-group">
            <form action="<?php echo FRONT_ROOT . "ticket/soldTickets" ?>">

                <select name="theater_id">
                    <option value="NULL">Select a theater</option>
                    <?php if (is_array($theaters)) {
                        if (!empty($theaters)) {
                            foreach ($theaters as $theater) {
                    ?>

                                <option  value="<?php echo $theater->getId() ?>"> <?php echo $theater->getName() ?> </option>


                    <?php }
                        }
                    } ?>
                    <?php if (!is_array($theaters)) { ?>
                        <option value="<?php echo $theater->getId() ?>"> <?php echo $theater->getName() ?> </option>
                    <?php } ?>
                </select>
        </div>
        <div class="row">

            <div class="col-6">
                <label>From...</label>
                <input name="date1" type="date" class="form-control">
            </div>
            <div class="col-6">
                <label>To...</label>
                <input name="date2" type="date" class="form-control">
            </div>
        </div>
        <hr>
        <button class="btn btn-primary" type="submit">Filter</button>
        <br>
        </form>

        <?php if (isset($sold) && isset($tickets)) { ?>

            <label>Cantidad de entradas vendidas / cantidad de entradas disponibles</label>
            <div> <?php echo $sold ?> / <?php echo $tickets ?> <div>
                <?php } ?>
                <hr>



                </div>

</body>

</html>