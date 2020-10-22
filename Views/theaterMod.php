<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaterMod">
        <div class="container">
            <h2>Theater Modification</h2>
            <form action="<?php echo FRONT_ROOT . "theater/modify" ?>" method="POST">
            <input type="number" name="id" value="<?php echo $theater->getId(); ?>" hidden>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="previousTheaterName">Current Theater Name</label>
                        <input type="text" class="form-control" id="previousTheaterName" value="<?php echo $theater->getName(); ?>"  readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="theaterName">New Theater Name</label>
                        <input type="text" class="form-control" id="theaterName"  name="name" placeholder="Enter a new theater name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="previousAddress">Current Address</label>
                    <input type="text" class="form-control" id="previousAddress" value="<?php echo $theater->getAddress(); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputAddress">New Address</label>
                    <input type="text" class="form-control" id="inputAddress"  name="address" placeholder="Enter a new theater address" >
                </div>
                <p class="text-danger">
                    <?php if (isset($errorMsg)) {
                        echo $errorMsg;
                    } ?>
                </p>
                <button type="submit" class="btn btn-primary">Submit Change</button>
            </form>
            <br>
            <form action="<?php echo FRONT_ROOT . "room/createView" ?>" method="POST">
                <input type="number" name="theater_id" value=<?php echo $theater->getId() ?> hidden>
                <button type="submit" class="btn btn-primary">Add a room</button>
            </form>
        </div>
    </div>

</body>

</html>