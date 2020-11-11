<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaters">
        <div class="container mt-4">
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card btn-round " >
                        <div class="card-header">
                            <div class="float-right">
                                <form action="<?php echo FRONT_ROOT . "room/createView" ?>" method="POST">
                                    <input type="number" name="theater_id" value=<?php echo $theater->getId() ?> hidden>
                                    <button type="submit" class="btn btn-info btn-round mt-2 mb-3">Add a room</button>
                                </form>
                            </div>
                            <h3 class="mt-1" style=" margin-bottom: 0px;">Choose the room</h3>
                            
                        </div>
                    </div>
                </div>
            </div>


            <form action="<?php echo FRONT_ROOT . "show/create" ?>" method="POST">
                <input type="number" name="movieId" value="<?php echo $movie_id; ?>" hidden>
                <input type="number" name="theater_id" value=<?php echo $theater->getId() ?> hidden>
                <?php 
                if(is_array($theater->getRooms())){
                    if(!empty($theater->getRooms())){
                        foreach($theater->getRooms() as $room){ ?>
                        <div class="row mt-3 d-flex justify-content-center">
                            <div class="col-md-6">
                                <div class="card btn-round " >
                                <div class="float-right">
                                    <button type="submit" name="roomId" value="<?php echo $room->getRoom_id(); ?>" class="btn btn-primary btn-round">Select</button>
                                </div>
                                <div class="card-header mt-2">
                                    <h5># <strong> <?php echo $room->getRoom_id() . " " . $room->getName() ?> </strong></h6>
                                </div>
                                
                                
                                <p>Capacity:  <strong><?php echo $room->getCapacity(); ?> </strong></p>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    <?php }else {echo "No rooms here ...";} 
                } else {?>
                    <div class="row mt-3 d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="card btn-round " >
                            <div class="float-right">
                                <button type="submit" name="roomId" value="<?php echo $theater->getRooms()->getRoom_id(); ?>" class="btn btn-primary btn-round">Select</button>
                            </div>
                            <div class="card-header mt-2">
                                <h5># <strong> <?php echo $theater->getRooms()->getRoom_id() . " " .  $theater->getRooms()->getName() ?> </strong></h6>
                            </div>
                            
                            
                            <p>Capacity:  <strong><?php echo $theater->getRooms()->getCapacity(); ?> </strong></p>
                            </div>
                        </div>
                    </div>
                <?php 
                }
                ?>
            </form>


            
        </div>
    </div>

</body>

</html>