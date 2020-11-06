<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="room-creation">
        <div class="container mt-3">
            <h2>Confirm new show</h2>
            <hr>
            <form action="<?php echo FRONT_ROOT . "show/add" ?>" method="POST">

                <!-- AGERGAR FICHA DE LA PELICULA POSIBLEMENTE, SE TIENE TODA LA DATA -->

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
                            <select name="time" class="form-control" >
                                <option value="NULL">Select an hour</option>
                                <option value="00:00">00:00</option>
                                <option value="01:00">01:00</option>
                                <option value="02:00">02:00</option>
                                <option value="03:00">03:00</option>
                                <option value="04:00">04:00</option>
                                <option value="05:00">05:00</option>
                                <option value="06:00">06:00</option>
                                <option value="07:00">07:00</option>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                                <option value="23:00">23:00</option>
                            </select>
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
                    <input type="number" value="<?php echo $room->getRoom_id(); ?>" name="room_id" hidden>
                    <input type="number" value="<?php echo $movie->getId(); ?>" name="movie_id" hidden>
                    <input type="number" value="<?php echo $theater->getId(); ?>" name="theater_id" hidden>

                    <button type="submit" class="btn btn-primary">Create show</button>
                </div>



            </form>
        </div>
    </div>
</body>

</html>