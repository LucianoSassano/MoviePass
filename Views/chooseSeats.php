<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Movie Pass</title>
    <link href="<?php echo CSS_PATH . "bootstrap.min.css" ?>" rel="stylesheet" />
    <link href="<?php echo CSS_PATH . "style.css" ?>" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body class="seatPicker">
    <?php require_once(VIEWS_PATH . "navbar.php") ?>
    <div>
        <div class="container mt-3">

            <div class="row">
                <div class="col-12">
                    <h1>Back Area</h1>
                    <hr>
                    <form action="<?php echo FRONT_ROOT . "purchase/reservation" ?>" method="POST">
                        <input type="hidden" value="<?php echo $show_id ?>" name="show_id">
                 
                        <?php if (isset($room)) { ?>

                            <?php 
                            for ($i = 1; $i <= $room->getCapacity(); $i++) {
                            ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" <?php if (in_array($i, $seatsOccupied)) {
                                                                        echo 'disabled';
                                                                    } ?> value="<?php echo $i ?>" name="seats[]" type="checkbox" id="<?php echo $i ?>">
                                    <label class="form-check-label" for="<?php echo $i ?>"><?php echo $i ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        <?php } ?>
                        <input type="number" name="theater_id" value="<?php echo $theater_id ?>" hidden> 
                    
                        <button class="btn btn-warning"> Select </button>
                    </form>
                    <h1>Screen Area</h1>
                </div>
            </div>
        </div>
    </div>

</body>

</html>