<?php require_once(VIEWS_PATH . "header.php") ?>


<body class="bg-light">

    <?php require_once(VIEWS_PATH . "navbar.php") ?>

    

    <div class="container mt-3">
    
        <div class="card">
            <div class="card-header">
                <p class="alert"> <?php echo $msg ?> </p>
            </div>
            <?php if(!$seatError){ ?> 
            <div class="card-body">
                <p>Email: <?php echo $purchase->getUserEmail() ?></p>
                <p>Date: <?php echo $purchase->getDate() ?></p>
                <p>Total: <?php echo $purchase->getTotalCost() ?></p>
                <hr>
                <p>Tickets: </p>
                <?php foreach($purchase->getTickets() as $ticket){ ?>
                    
                    <small>Price: <?php echo $ticket->getCost() ?></small>
                    <br>
                    <small>Seat: <?php echo $ticket->getSeat_number() ?></small>
                    <hr>
                    <br>
                <?php } ?>
            </div>
                <?php }?>
        </div>

    </div>

    

</body>

</html>