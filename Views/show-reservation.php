<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "navbar.php") ?>

    <div class="show-reservation">
        <div class="container">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo "https://image.tmdb.org/t/p/original/" . $show->getMovie()->getPoster_path(); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <p>Date: <strong class="text-bold"> <?php echo $show->getDate(); ?> </strong></p>
                    <p>Time: <strong><?php echo $show->getTime(); ?> </strong></p>
                    <p>Price: <strong><?php echo $show->getPrice(); ?> </strong></p>
                    <button class="btn btn-danger">Confirm Reservation</button>
                </div>

            </div>
        </div>
    </div>

</body>

</html>