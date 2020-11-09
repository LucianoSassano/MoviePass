<?php require_once(VIEWS_PATH . "header.php") ?>

<body class="signup">
    <?php require_once(VIEWS_PATH . "navbar.php") ?>
    <div class="container">
        <div class="row">
            <form class="signup-form" action="<?php echo FRONT_ROOT . "user/create" ?>" method="POST">
            <?php \Utils\Helper\Helper::facebookAPI(true); ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <br>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <!-- Control de errores -->
                <p class="text-danger">
                    <?php if (isset($errorMsg)) {
                        echo $errorMsg;
                    } ?>
                </p>

                <button type="submit" class="btn btn-primary">Register</button>
                <small id="emailHelp" class="form-text ">We'll never share your email with anyone else.</small>
            </form>
        </div>
    </div>
</body>

</html>