<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="shows-active">
        <div class="container mt-3">

            <h2>Show id: <?php echo $show_id ?></h2>
            <hr>
            <form action="<?php echo FRONT_ROOT . "purchase/confirm" ?>" method="POST">
                <input type="hidden" value="<?php echo $show_id ?>" name="show_id">
                <?php 
                    for($i = 1; $i <= $room->getCapacity(); $i++){
                ?>  
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php if(in_array($i, $seatsOccupied)){ echo 'disabled'; } ?> value="<?php echo $i ?>" name="seats[]" type="checkbox" id="<?php echo $i ?>">
                            <label class="form-check-label" for="<?php echo $i ?>"><?php echo $i ?></label>
                        </div>
                <?php
                    }
                ?>
                
                <button class="btn btn-warning"> Select </button>
            </form>
        </div>
    </div>

</body>

</html>