<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="analytics">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="container">
        <div class="form-group">
            <form action="<?php echo FRONT_ROOT . "ticket/soldTickets" ?>">

                <select name="theater_id">
                    <option value="NULL">Select a theater to get his gains between periods</option>
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

        <?php if (isset($sold) && isset($money)) { ?>

            <label>Cantidad de entradas vendidas</label>
            <div> <?php echo $sold ?> <div>
                    <hr>
                    <label>Ganancias totals en pesos</label>
                    <div> <?php echo $money ?> <div>


                        <?php } ?>
                        <hr>



                        </div>

</body>

</html>