<?php

require_once(VIEWS_PATH . "header.php");

?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="show">
        <div class="container">
            <h2>Show Creation</h2>
            <form action="<?php echo FRONT_ROOT . "theater/create" ?>" method="POST">
                <div class="form-row">
                    <div class="card mb-3">
                        <img src="" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Movie Title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.<br>
                                This content is a little bit longer.</p>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Pick a theater</label>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected>Choose a theater...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="form-group">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Pick a Room</label>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected>Choose a room...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start">Pick Show date:</label>
                    <input type="date" id="show" name="show-date" value="2020-10-20" min="2020-10-20" max="2018-12-40">
                </div>
                <button type="submit" class="btn btn-primary">Submit Show</button>
            </form>
        </div>
    </div>

</body>

</html>