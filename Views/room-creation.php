<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="room-creation">
        <div class="container">
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
                <button type="submit" class="btn btn-primary">Create Room</button>
            </form>
        </div>
    </div>
</body>

</html>