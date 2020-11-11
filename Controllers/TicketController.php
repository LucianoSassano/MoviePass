<?php 

 namespace Controllers;

 use Models\Ticket;
 use Models\User;
 use DAO\PDO\TicketPDO as TicketDAO;
 use DAO\PDO\ShowPDO as ShowDAO;
 use DAO\PDO\UserPDO as UserDAO;

    class TicketController{

        private $ticketDAO;
        private $showDAO;
        private $userDAO;

        function __construct()
        {
            $this->ticketDAO = new TicketDAO();
            $this->showDAO = new ShowDAO();
            $this->userDAO = NEW UserDAO();
            
        }

        public function create($show_id, $seat_number, $user_id, $cost){

            $ticket = new Ticket($seat_number, $cost);
            $ticket->setShow($this->showDAO->get($show_id));
            $ticket->setClient($this->userDAO->get($user_id));

            require_once(VIEWS_PATH . "my-shows.php");
        }

        public function showMyTickets(){

            if(isset($_SESSION['loggedUser'])){
                if($_SESSION['loggedUser']->getRole()->getId() == User::CLIENT_ROLE ){
                    $user_id = $_SESSION['loggedUser']->getId();
                    $tickets = $this->ticketDAO->getAllByUser($user_id);
                  
                    require_once(VIEWS_PATH . "my-tickets.php");

                }else if($_SESSION['loggedUser']->getRole()->getId() == User::ADMIN_ROLE ){

                    echo '<script language="javascript">';
                    echo 'alert("Action not available for admin!")';
                    echo '</script>';
                    require_once(VIEWS_PATH . "admin.php");

                }
            
            }else{
                echo '<script language="javascript">';
                echo 'alert("You must login first!")';
                echo '</script>';
                require_once(VIEWS_PATH . "index.php");
            }
        }

        public function soldTickets($theater_id, $date1, $date2){

            $tickets = $this->ticketDAO->getAllByTheater($theater_id, $date1, $date2);
            var_dump($tickets);

        }




    }



?>