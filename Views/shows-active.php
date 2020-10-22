<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <div class="shows-active">
        <div class="container mt-3">
            
            <h2>Shows list</h2>
            <hr>

            <?php 
            if(!empty($shows)){
                foreach($shows as $show){ ?>
                    <div class="lead">
                        <img src="<?php echo "https://image.tmdb.org/t/p/original/" . $show->getMovie()->getPoster_path(); ?>" class="card-img-top" alt="...">
                        <p>Date: <strong class="text-bold"> <?php echo $show->getDate(); ?> </strong></p>
                        <p>Time:  <strong><?php echo $show->getTime(); ?> </strong></p>
                        <p>Price:  <strong><?php echo $show->getPrice(); ?> </strong></p>
                        
                        
                        <hr>
                    </div>
                <?php }?>
            <?php }else {echo "No shows here ...";} ?>
            </form>
        </div>
    </div>

</body>

</html>