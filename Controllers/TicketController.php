<?php 

 namespace Controllers;

 use Models\Ticket;
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

            $user_id = $_SESSION['loggedUser']->getId();
            $tickets = $this->ticketDAO->getAllByUser($user_id);
            require_once(VIEWS_PATH . "my-tickets.php");
        }




    }



?>