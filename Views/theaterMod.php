<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="theaterMod">
        <div class="container">
            <h2>Theater Modification</h2>
            <form action="<?php echo FRONT_ROOT . "admin/createTheater" ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="previousTheaterName">Current Theater Name</label>
                        <input type="text" class="form-control" id="previousTheaterName" name="previousName" placeholder="Current Theater Name" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="theaterName">New Theater Name</label>
                        <input type="text" class="form-control" id="theaterName" name="name" placeholder="Enter a new theater name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="previousAddress">Current Address</label>
                    <input type="text" class="form-control" id="previousAddress" name="previousAddress" placeholder="Current Theater Address" readonly>
                </div>
                <div class="form-group">
                    <label for="inputAddress">New Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Enter a new theater address" >
                </div>
                <p class="text-danger">
                    <?php if (isset($errorMsg)) {
                        echo $errorMsg;
                    } ?>
                </p>
                <button type="submit" class="btn btn-primary">Submit Change</button>
            </form>

        </div>
    </div>

</body>

</html>