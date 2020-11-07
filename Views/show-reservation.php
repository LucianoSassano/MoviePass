<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "navbar.php") ?>

    <div class="show-reservation">
        <div class="container">
            <?php foreach ($show as $show) { ?>
            
                <div class="card mx-auto" style="width: 45rem;">
                
                 <img src="<?php echo "https://image.tmdb.org/t/p/original/" . $show->getMovie()->getPoster_path(); ?>" class="card-img-top" alt="..."> 
                    <div class="card-body">
                        <h4 class="card-title"> <?php echo $show->getMovie()->getTitle(); ?></h4>
                        <p>Date: <strong class="text-bold"> <?php echo $show->getDate(); ?> </strong></p>
                        <p>Start time: <strong class="text-bold"> <?php echo $show->getStartTime(); ?> </strong></p>
                        <p>End time: <strong class="text-bold"> <?php echo $show->getEndTime(); ?> </strong></p>
                        <p>Price: <strong><?php echo $show->getPrice(); ?> </strong></p>
                        
                        <form action="<?php echo FRONT_ROOT . "show/showReservation" ?>" >
                        <button type="submit" class="btn btn-danger">Confirm Reservation</button>
                        <input value="<?php echo $_SESSION['loggedUser']->getId() ?>" name="user_id" hidden>
                        <input value="<?php echo $show->getId() ?>" name="show_id" hidden>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>