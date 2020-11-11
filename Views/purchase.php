<?php require_once(VIEWS_PATH . "header.php") ?>


<body class="bg-light">

    <?php require_once(VIEWS_PATH . "navbar.php") ?>

    

    <div class="container mt-3">
    
        <div class="card">
            <div class="card-header">
                <p class="alert" style="color: black;"> <?php echo $msg ?> </p>
            </div>
            <?php if(!$seatError){ ?> 
            <div class="card-body">
                <p>Email: <?php echo $purchase->getUserEmail() ?></p>
                <p>Transaction Date: <?php echo $purchase->getDate() ?></p>
                <p>Payed with: <?php echo $creditCard ?> </p>
                <p>Total: <?php echo $purchase->getTotalCost() ?></p>
                <hr>
             
            </div>
                <?php }?>
        </div>

    </div>

    

</body>

</html>