<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="room-creation">
        <div class="container mt-3">
        <h2>Confirm new show</h2><hr>
            <form action="<?php echo FRONT_ROOT . "show/add" ?>" method="POST">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="roomName">Show date</label>
                            <input type="date" class="form-control" id="roomName" name="date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="roomCapacity">Show time</label>
                            <input type="time" class="form-control" id="roomCapacity" name="time">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="roomCapacity">Price</label>
                            <input type="number" class="form-control" id="roomCapacity" name="price">
                        </div>
                    </div>
                    
                </div>
               
                <div class="float-right mt-2">
                    <input type="number" value="<?php echo $room->getId(); ?>" name="room_id" hidden>
                    <input type="number" value="<?php echo $movie->getId(); ?>" name="movie_id" hidden>
                    <button type="submit" class="btn btn-primary">Create show</button>
                </div>
                    
            
                
            </form>
        </div>
    </div>
</body>

</html>