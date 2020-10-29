<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . 'navbar.php'); ?>
    <div class="shows-active">
        <div class="container mt-3">

            <h2>Shows list</h2>
            <hr>
            <div class="form-group">
                <form action="<?php echo FRONT_ROOT . "show/filterClientSide" ?>" method="POST">
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

            <?php
            if (!empty($shows)) {
                foreach ($shows as $show) { ?>
                    <div class="lead">
                        <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $show->getMovie()->getPoster_path(); ?>" class="card-img-top" alt="...">
                        <p>Date: <strong class="text-bold"> <?php echo $show->getDate(); ?> </strong></p>
                        <p>Time: <strong><?php echo $show->getTime(); ?> </strong></p>
                        <p>Price: <strong><?php echo $show->getPrice(); ?> </strong></p>
                        <button class="btn btn-danger">Reserve</button>


                        <hr>
                    </div>
                <?php } ?>
            <?php } else {
                echo "No shows here ...";
            } ?>
            </form>
        </div>
    </div>

</body>

</html>