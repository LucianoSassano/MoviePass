<?php require_once(VIEWS_PATH . "header.php") ?>

<body >
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaters">
        <div class="container mt-4">
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card btn-round " >
                        <div class="card-header">
                            <h3 class="mt-1" style=" margin-bottom: 0px;">Room Creation</h3><hr>
                        </div>

                        <form action="<?php echo FRONT_ROOT . "room/create" ?>" method="POST">
                            <div class="form-group">
                                <label for="roomName">Room Name</label>
                                <input type="text" class="form-control" id="roomName" name="name">
                            </div>
                            <div class="form-group">
                                <label for="roomCapacity">Room Capacity</label>
                                <input type="number" class="form-control" id="roomCapacity" name="capacity">
                            </div>
                            <input type="number" value="<?php echo $theater->getId(); ?>" name="theater_id" hidden>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-round">Create Room</button>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        
        </div>
    </div>
</body>

</html>