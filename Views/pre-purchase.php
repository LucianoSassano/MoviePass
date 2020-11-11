<?php require_once(VIEWS_PATH . "header.php") ?>

<body>

    <?php require_once(VIEWS_PATH . "navbar.php") ?>
    <div class="container">
        <div class="row">

            <div class="col-6">

                <div class="card">
                    <div class="card-header">
                        <p class="alert"> Purchase Confirmation </p>
                    </div>

                    <div class="card-body">
                        <p>Email: <?php echo $user->getEmail() ?></p>
                        <p>Date of transaction: <?php echo $date ?></p>
                        <p>Subtotal: <?php echo $subtotal ?></p>
                        <p>Discount: <?php echo $discount ?></p>
                        <p>Total: <?php echo $total ?></p>
                        <hr>
                        <p>Tickets: </p>
                        <?php foreach ($purchase->getTickets() as $ticket) { ?>

                            <small>Seat: <?php echo $ticket->getSeat_number() ?></small>
                            <br>
                            <small>Price: <?php echo $ticket->getCost() ?></small>
                            <br>

                            <hr>
                            <br>
                        <?php } ?>
                    </div>

                </div>

            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Payment Method</div>
                    <br>

                    <div class="form-group">
                        <form  action="<?php echo FRONT_ROOT . "purchase/confirm" ?>" method="POST">
                            <input name="show_id" value="<?php echo $show_id ?>" hidden>
                            <?php 
                                foreach($seats as $seat){
                                    echo '<input type="hidden" name="seats[]" value="' . $seat.'" >';
                                }
                            ?>
                            <input name="total" value="<?php echo $total ?>" hidden>

                            <select name="ccc" class="form-control">
                                <option value="NULL">Select Your Card Company</option>
                                <option value="mastercard">MasterCard</option>
                                <option value="visa">Visa</option>
                            </select>
                            <hr>
                            <label for="ccn">Credit Card Number:</label>
                            <input id="ccn" name="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx">
                            <br>
                            <small>Your personal infromation is confidential an will never we shared</small>
                            <hr>
                            <button type="submit" class="btn btn-primary">Confirm Reservation</button>
                      

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

</body>

</html>