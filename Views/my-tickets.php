<?php require_once(VIEWS_PATH . "header.php") ?>

<body style="background-color:#3E5CB2">
    <?php require_once(VIEWS_PATH . "navbar.php") ?>

    <div class="container">
        <div class="row">
            <div class="col-12" style="color: white;">

                <?php if (!empty($tickets)) {
                    foreach ($tickets as $ticket) { ?>

                        <hr style="background-color:blanchedalmond">
                        <h3><?php echo $ticket->getShow()->getMovie()->getTitle() ?></h3>
                        <?php foreach ($theaters as $theater) { ?>
                            <?php foreach ($theater->getRooms() as $room) { ?>
                                <?php

                                if (strcmp($room->getName(),$ticket->getShow()->getRoom()->getName()) == 0) { ?>
                                    <p>Theater: <?php echo $theater->getName() ?></p>
                                <?php } ?>
                            <?php } ?>

                        <?php } ?>
                        <p>Show date: <?php echo $ticket->getShow()->getDate() ?></p>
                        <p>Seat Number: <?php echo $ticket->getSeat_number() ?></p>
                        <p>Price: $ <?php echo $ticket->getCost() ?></p>
                        <p>Ticket emission date: <?php echo $ticket->getDate() ?></p>

                        <hr>

                <?php }
                } ?>

            </div>
        </div>
    </div>

</body>

</html>