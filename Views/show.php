<?php

require_once(VIEWS_PATH . "header.php");

?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="show">
        <div class="container mt-4">
            <div class="row d-flex justify-content-around">
                
                    <div class="col-md-5 d-flex justify-content-end">
                        <div class="card mb-3" style="">
                            <img src="<?php echo "https://image.tmdb.org/t/p/w500/" . $movie->getPoster_path(); ?>" class="card-img-top" alt="...">
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card shad">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3 style="margin-bottom: 0px;"><?php echo $movie->getTitle() ?></h3><hr>
                                </div>
                                <p class="card-text">Overview: <?php echo $movie->getOverview() ?></p>
                            </div>
                        </div>
                        <div class="">
                            <form action="<?php echo FRONT_ROOT . "show/chooseRoom" ?>" method="POST">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Pick a theater</label>
                                            <select name="theater_id" class="custom-select mr-sm-2 btn-round shad" id="inlineFormCustomSelect" style="padding: 0px 10px; ">
                                                <option selected>Choose a theater...</option>

                                                <?php 
                                                if(is_array($theaterList)){
                                                    if(!empty($theaterList))
                                                    foreach ($theaterList as $theater) { ?>
                                                        <option value="<?php echo $theater->getId(); ?>"> <?php echo $theater->getName(); ?></option>
                                                <?php 
                                                    }
                                                } else { ?>
                                                    <option value="<?php echo $theaterList->getId(); ?>"> <?php echo $theaterList->getName(); ?></option>
                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="movie_id" value="<?php echo $movie->getId(); ?>" hidden>

                                            <button type="submit" class="btn btn-primary btn-block btn-round shad" style="margin: 0px">Continue</button> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div>

            

        </div>
    </div>

</body>

</html>