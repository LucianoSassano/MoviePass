<?php

require_once(VIEWS_PATH . "header.php");

?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="show">
        <div class="container">

            <form action="<?php echo FRONT_ROOT . "" ?>" method="POST">
                <div class="form-row">
                    <div class="card mb-3">
                        <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $movie->getPoster_path(); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Movie Title: <?php echo $movie->getTitle() ?></h5>
                            <p class="card-text">Overview: <?php echo $movie->getOverview() ?></p>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Pick a theater</label>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected>Choose a theater...</option>

                        <?php foreach ($theaterList as $theater) { ?>
                            <option value="<?php echo $theater->getId(); ?>"> <?php echo $theater->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit Show</button>
            </form>
        </div>
    </div>

</body>

</html>