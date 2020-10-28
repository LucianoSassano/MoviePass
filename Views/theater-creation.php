<?php

require_once(VIEWS_PATH . "header.php");
?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>

    <div class="theater-creation">
        <div class="container">
            <h2>Theater Creation</h2>
            <form action="<?php echo FRONT_ROOT . "theater/create" ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="theaterName">Theater Name</label>
                        <input type="text" class="form-control" id="theaterName" name="name" placeholder="Theater Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Theater Address">
                </div>
                <p class="text-danger">
                <?php if (isset($errorMsg)) {
                    echo $errorMsg;
                } ?>
                </p>
                <p class="text-success">
                    <?php if(isset($successMsg)){ echo $successMsg; } ?>
                </p>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</body>

</html>