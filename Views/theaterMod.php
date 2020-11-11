<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaters">
        <div class="container mt-4">
            <div class="row mt-3 d-flex justify-content-center">

                <div class="col-md-6">
                    <div class="card btn-round shad"> 
                        <div class="card-header">
                            <h3 class="mt-1" style=" margin-bottom: 0px;">Theater Modification</h3><hr>
                        </div>

                       
                        
                        <form action="<?php echo FRONT_ROOT . "theater/modify" ?>" method="POST">
                            
                            <div class="form-group col-md-12">
                                <label for="theaterName">Theater Name</label>
                                <input type="text" class="form-control" id="theaterName" name="name" placeholder="Enter a new theater name" value="<?php echo $theater->getName(); ?>">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Enter a new theater address" value="<?php echo $theater->getAddress(); ?>">
                            </div>
                            <p class="text-danger">
                                <?php if (isset($errorMsg)) {
                                    echo $errorMsg;
                                } ?>
                            </p>

                            <div class="text-right mr-3">
                                <button type="submit" class="btn btn-primary btn-round">Submit changes</button>
                            </div>
                            
                            
                        </form>
                    </div>
                    <div class="card btn-round shad">
                        <div class="card-header">
                            <h3 class="mt-1" style=" margin-bottom: 0px;">Rooms</h3><hr>
                        </div>
                        <div class="card-body" style="padding: 1.25rem 1.25rem 0;">
                            <?php
                            if(is_array($theater->getRooms())){
                                if (!empty($theater->getRooms())) {
                                    foreach ($theater->getRooms() as $room) { ?>
                                        <div class="">
                                            <p>Name: <strong class="text-bold"> <?php echo $room->getName(); ?> </strong></p>
                                            <p>Capacity: <strong><?php echo $room->getCapacity(); ?> </strong></p>
                                            <hr>
                                        </div>
                                    <?php } ?>
                                <?php }
                            } else if ($theater->getRooms()) { ?>
                                <div class="">
                                    <p>Name: <strong class="text-bold"> <?php echo $theater->getRooms()->getName(); ?> </strong></p>
                                    <p>Capacity: <strong><?php echo $theater->getRooms()->getCapacity(); ?> </strong></p>
                                    <hr>
                                </div>
                            <?php
                            } else{
                                echo "No rooms here ...";
                            } ?>
                        
                        
                        

                        <form action="<?php echo FRONT_ROOT . "room/createView" ?>" method="POST">
                            <input type="number" name="theater_id" value=<?php echo $theater->getId() ?> hidden>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-round mt-2 mb-3">Add a room</button>
                            </div>
                            
                        </form>
                        </div>
                    </div>

                        
                        

                    </div>

                


                </div>
            
            






            </div>






        </div>
    </div>

</body>

</html>