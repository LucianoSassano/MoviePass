<?php

namespace Controllers;

use Models\Purchase;
use Models\Ticket;
use Models\User;

use DAO\PDO\PurchasePDO as PurchaseDAO;
use DAO\PDO\RoomPDO as RoomDAO;
use DAO\PDO\ShowPDO as ShowDAO;
use DAO\PDO\TicketPDO as TicketDAO;
use DAO\PDO\UserPDO as UserDAO;
use DAO\PDO\TheaterPDO as TheaterDAO;
use DAO\PDO\MoviePDO as MovieDAO;
use DAO\PDO\GenrePDO as GenreDAO;

use DateTime;
use DateTimeZone;
use Utils\Helper\Helper;


class PurchaseController
{
    private $purchaseDAO;
    private $roomDAO;
    private $showDAO;
    private $ticketDAO;
    private $userDAO;
    private $theaterDAO;
    private $movieDAO;
    private $genreDAO;

    function __construct()
    {
        $this->roomDAO = new RoomDAO();
        $this->showDAO = new ShowDAO();
        $this->userDAO = new UserDAO();
        $this->ticketDAO = new TicketDAO();
        $this->theaterDAO = new TheaterDAO();
        $this->purchaseDAO = new PurchaseDAO();
        $this->movieDAO = new MovieDAO();
        $this->genreDAO = new GenreDAO();
    }

    public function seats($room_id, $show_id)
    {


      if(isset($_SESSION['loggedUser'])){

        if ($_SESSION['loggedUser']->getRole()->getId() == User::ADMIN_ROLE ) {

            echo '<script>alert("Action not available for admin")</script>';
            require_once(VIEWS_PATH . "admin.php");

        }else if($_SESSION['loggedUser']->getRole()->getId() == User::CLIENT_ROLE) {

            $room = $this->roomDAO->getWithShow($room_id, $show_id);
        
            $seatsOccupied = $this->showDAO->getOccupiedSeats($show_id);

            require_once(VIEWS_PATH . "chooseSeats.php");
        }
      }else {

        $shows = $this->movieDAO->getMoviesDistinct();
        $genres = $this->genreDAO->getAll();
        echo '<script>alert("You must login to make a reservation")</script>';
        require_once(VIEWS_PATH . "index.php");
      }

    }

    public function reservation($show_id, $seats){

        $show = $this->showDAO->get($show_id);
        $user = $this->userDAO->get($_SESSION['loggedUser']->getId());

        $subtotal = 0;
        $discount = 0;
        $total = 0;

        $ticketList = array();

        $seatsOccupied = $this->showDAO->getOccupiedSeats($show_id);

        $seatError = false;
       
        $dayOfShow = date("w", strtotime($show->getDate()));
      
        $dayOfShow = (int) $dayOfShow;
        
        foreach ($seats as $seat) {
            if (in_array($seat, $seatsOccupied)) {
                $seatError = true;
            } else {
                if(count($seats) < 2){
                    $total += $show->getPrice();
                    $ticket = new Ticket($seat, $show->getPrice());
                    $ticket->setShow($show);
                    $ticket->setClient($user);
                    array_push($ticketList, $ticket);
                
                }else{
                    if($dayOfShow == 3 || $dayOfShow == 4){
                        $subtotal += $show->getPrice();
                        $discount += (int) ($show->getPrice() * 0.25);
                        $total = (int) ($subtotal - $discount);
                        $ticket = new Ticket($seat, ($show->getPrice() * 0.75)  );
                        $ticket->setShow($show);
                        $ticket->setClient($user);
                        array_push($ticketList, $ticket);

                    }
                }
            }
        }

        if (!$seatError) {
            $theater = $this->theaterDAO->getbyMovie($show->getMovie()->getId());

            $purchase = new Purchase(
                $user->getEmail(),
                $theater['0'],
                (new DateTime('now'))->format('Y-m-d H:i:s'),
                $ticketList,
                $total
            );


        } else {
            $msg = "Seats already occupied !";
        }
            
   
        $date = (new DateTime('now'))->format('Y-m-d H:i:s');
        
    
        require_once(VIEWS_PATH . "pre-purchase.php");


    }

    public function confirm($show_id, $seats, $total, $ccc , $ccn)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');

        $creditCard = 0;
       
        if($this->ValidCreditcard($ccn ,$ccc)){

            $creditCard = $ccn;
             
        $show = $this->showDAO->get($show_id);

        $user = $this->userDAO->get($_SESSION['loggedUser']->getId());

        $total = 0;

        $ticketList = array();

        $seatsOccupied = $this->showDAO->getOccupiedSeats($show_id);

        $seatError = false;

        foreach($seats as $seat){
            if(in_array($seat, $seatsOccupied)){
                $seatError = true;
            } else {
                $total += $show->getPrice();
                $ticket = new Ticket($seat, $show->getPrice());
                $ticket->setShow($show);
                $ticket->setClient($user);
                $ticket->setDate((new DateTime('now'))->format('Y-m-d H:i:s'));
                array_push($ticketList, $ticket);
            }
        }

        if(!$seatError){
            $theater = $this->theaterDAO->getbyMovie($show->getMovie()->getId());

            $purchase = new Purchase($user->getEmail(), 
                                    $theater['0'], 
                                    (new DateTime('now',new DateTimeZone('America/Argentina/Buenos_Aires')))->format('Y-m-d H:i:s'),
                                    $ticketList, 
                                    $total);
            
            
            $rows = $this->purchaseDAO->add($purchase);
            
            if($rows){
                $msg = "Purchase successfully created !";
                Helper::sendMail($purchase);
            } else {
                $msg = "An error ocurred";
            }
        }else {
            $msg = "Seats already occupied !";
        }
        

        require_once(VIEWS_PATH . "purchase.php");
        }else{
            
            echo '<script language="javascript">';
            echo 'alert("Invalid Credit Card Data, transaction aborted")';
            echo '</script>';
            $shows = $this->movieDAO->getMoviesDistinct();
            $genres = $this->genreDAO->getAll();
            require_once(VIEWS_PATH . "index.php");
        }
       

      

    }


    /**
     * Algoritmos validacion tarjeta de credito
     */

    private function luhn($number)
    {
        //Force the value to be a string as this method uses string functions.
        //Converting to an integer may pass PHP_INT_MAX and result in an error!
        $number = (string)$number;

        if (!ctype_digit($number)) {
            //Luhn can only be used on numbers!
            return FALSE;
        }

        //Check number length
        $length = strlen($number);

        //Checksum of the card number
        $checksum = 0;

        for ($i = $length - 1; $i >= 0; $i -= 2) {
            //Add up every 2nd digit, starting from the right
            $checksum += substr($number, $i, 1);
        }

        for ($i = $length - 2; $i >= 0; $i -= 2) {
            //Add up every 2nd digit doubled, starting from the right
            $double = substr($number, $i, 1) * 2;

            //Subtract 9 from the double where value is greater than 10
            $checksum += ($double >= 10) ? ($double - 9) : $double;
        }

        //If the checksum is a multiple of 10, the number is valid
        return ($checksum % 10 === 0);
    }

    private function ValidCreditcard($number, $type)
    {
        $card_array = array(
            'default' => array(
                'length' => '13,14,15,16,17,18,19',
                'prefix' => '',
                'luhn' => TRUE,
            ),
            'american express' => array(
                'length' => '15',
                'prefix' => '3[47]',
                'luhn' => TRUE,
            ),
            'diners club' => array(
                'length' => '14,16',
                'prefix' => '36|55|30[0-5]',
                'luhn' => TRUE,
            ),
            'discover' => array(
                'length' => '16',
                'prefix' => '6(?:5|011)',
                'luhn' => TRUE,
            ),
            'jcb' => array(
                'length' => '15,16',
                'prefix' => '3|1800|2131',
                'luhn' => TRUE,
            ),
            'maestro' => array(
                'length' => '16,18',
                'prefix' => '50(?:20|38)|6(?:304|759)',
                'luhn' => TRUE,
            ),
            'mastercard' => array(
                'length' => '16',
                'prefix' => '5[1-5]',
                'luhn' => TRUE,
            ),
            'visa' => array(
                'length' => '13,16',
                'prefix' => '4',
                'luhn' => TRUE,
            ),
        );

        //Remove all non-digit characters from the number
        if (($number = preg_replace('/\D+/', '', $number)) === '')
            return FALSE;


        $cards = $card_array;

        //Check card type
        $type = strtolower($type);

        if (!isset($cards[$type]))
            return FALSE;

        //Check card number length
        $length = strlen($number);

        //Validate the card length by the card type
        if (!in_array($length, preg_split('/\D+/', $cards[$type]['length'])))
            return FALSE;

        //Check card number prefix
        if (!preg_match('/^' . $cards[$type]['prefix'] . '/', $number))
            return FALSE;

        //No Luhn check required
        if ($cards[$type]['luhn'] == FALSE)
            return TRUE;

        return $this->luhn($number);
    }
}
?>