<?php require_once(VIEWS_PATH . "header.php") ?>

<body>
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="container">
        <h4>Ingrese el rango de fechas </h4>
        <div class="row">

            <div class="col-6">
                <label>From...</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-6">
                <label>To...</label>
                <input type="date" class="form-control">
            </div>
        </div>

        <label>Cantidad de entradas vendidas / cantidad de entradas disponibles</label>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>


    </div>

</body>

</html>