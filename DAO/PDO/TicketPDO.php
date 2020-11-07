<?php

namespace DAO\PDO;

use \PDO;
use \Exception;
use DAO\Connection;



use DAO\PDO\ShowPDO as ShowDAO;
use DAO\PDO\UserPDO as UserDAO;

use Models\Ticket;

    class TicketPDO{

        private $connection;
        private $showDAO;
        private $userDAO;

        function __construct(){
            $this->showDAO = new ShowDAO();
            $this->userDAO = new UserDAO();
        }

           /**
         * Get by id
         */
        public function get($id) {

            $query = "
            SELECT * FROM `ticket` WHERE ticket_id = :id";

            $parameters['id'] = $id;

            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return false;
            }

        }

        public function getAllByUser($user_id){

            $query = "
            SELECT * FROM `ticket` WHERE user_id = :id";

            $parameters['id'] = $user_id;

            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return false;
            }

            
        }

        /**
         * Get all tickets
         */
        public function getAll() {

            $query = "
            SELECT * FROM `tickets`;";

            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            }catch (Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return false;
            }
        }

        public function add(Ticket $ticket){

            $query = "
            SET FOREIGN_KEY_CHECKS=0;
            INSERT INTO `ticket` (show_id, seat_number, movie_id, user_id, cost, date) 
            VALUES (:show_id, :seat_number, :movie_id, :user_id, :cost, :date);
            SET FOREIGN_KEY_CHECKS=1;";

            $parameters['show_id'] = $ticket->getShow()->getId();
            $parameters['seat_number'] = $ticket->getSeat_number();
            $parameters['movie_id'] = $ticket->getShow()->getMovie()->getId();
            $parameters['user_id'] = $ticket->getClient()->getId();
            $parameters['cost'] = $ticket->getCost();
            $parameters['date'] = $ticket->getDate();
           
        

            try {

                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex) {
                throw $ex;
            }
        }

           /**
         * Map model
         */
        public function map($data){

            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $show = new Ticket($row['seat'], $row['cost']);
                $show->setShow($this->showDAO->get($row['show_id']));
                $show->setClient($this->userDAO->get($row['user_id']));
                $show->setDate( $row['date']);
               

                return $show;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    
    }


?>