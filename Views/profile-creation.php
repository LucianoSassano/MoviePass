<?php require_once(VIEWS_PATH . "header.php") ?>


<body>

    <?php require_once(VIEWS_PATH . "navbar.php") ?>

    <div class="profile-creation">
        <div class="container">
            <form action="<?php echo FRONT_ROOT . "user/setProfile" ?>" method="POST">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" value="<?php if($first_name){echo $first_name;} ?>" name="first_name" placeholder="Your first name" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" value="<?php if($last_name){echo $last_name;} ?>" name="last_name" placeholder="Your last name" required>
                </div>
                <div class="form-group">
                    <label for="lastName">DNI / Id number</label>
                    <input type="text" class="form-control" name="dni" placeholder="Your dni" required>
                </div>
                <input type="text" value="<?php echo $user_email; ?>" name="user_email" hidden>
                
                <button type="submit" class="btn btn-primary">Submit Profile</button>
            </form>
        </div>
        <?php if (isset($errorMsg)) {
                echo $errorMsg;
            } ?>
    </div>

</body>

</html>