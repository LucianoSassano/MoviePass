<?php

require_once(VIEWS_PATH . "header.php");
?>

<body>
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>

    <div class="theaters" >
        <div class="container mt-4">
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card btn-round " >
                        <div class="card-header">
                            <h3 class="mt-1" style=" margin-bottom: 0px;">Theater Creation</h3><hr>
                        </div>
                        
                        <form action="<?php echo FRONT_ROOT . "theater/create" ?>" method="POST">
                            
                            <div class="form-group col-md-12">
                                <label for="theaterName">Theater Name</label>
                                <input type="text" class="form-control" id="theaterName" name="name" placeholder="Theater Name">
                            </div>
                            <div class="form-group col-md-12">
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

                            <div class="text-right mr-3">
                                <button type="submit" class="btn btn-primary btn-round">Create</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>