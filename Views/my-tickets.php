<?php require_once(VIEWS_PATH . "header.php") ?>
<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "navbar.php")?>

    <?php if(!empty($tickets)){ 
        foreach($tickets as $ticket){?>

            <hr style="background-color:blanchedalmond">
                <h3><?php echo $ticket->getShow()->getMovie()->getTitle()?></h3>
                <p>Show date: <?php echo $ticket->getShow()->getDate()?></p>
                <p>Seat: <?php echo $ticket->getSeat_number() ?></p>
                <p>Price: <?php echo $ticket->getCost() ?></p>
                <p>Ticket creation: <?php echo $ticket->getDate() ?></p>
                
            <hr>
    


    <?php } }?>
    
</body>
</html>