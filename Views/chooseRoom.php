<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaterMod">
        <div class="container mt-3">
            
            <h2>Choose the room</h2>
            <hr>
            <form action="<?php echo FRONT_ROOT . "show/create" ?>" method="POST">
                <input type="number" name="movieId" value="<?php echo $movie_id; ?>" hidden>
            <?php 
            if(!empty($theater->getRooms())){
                foreach($theater->getRooms() as $room){ ?>
                    <div class="lead">
                        <div class="float-right">
                            <button type="submit" name="roomId" value="<?php echo $room->getId(); ?>" class="btn btn-dark">Select</button>
                        </div>
                        <p>Name: <strong class="text-bold"> <?php echo $room->getName(); ?> </strong></p>
                        <p>Capacity:  <strong><?php echo $room->getCapacity(); ?> </strong></p>
                        
                        
                        <hr>
                    </div>
                <?php }?>
            <?php }else {echo "No rooms here ...";} ?>
            </form>
            <form action="<?php echo FRONT_ROOT . "room/createView" ?>" method="POST">
                <input type="number" name="theater_id" value=<?php echo $theater->getId() ?> hidden>
                <button type="submit" class="btn btn-primary mt-2 mb-3">Add a room</button>
            </form>
        </div>
    </div>

</body>

</html>