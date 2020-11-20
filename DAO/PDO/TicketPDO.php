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
           
            $this->userDAO = new UserDAO();
        }

           /**
         * Get by id
         */
        public function get($id) {

            $query = "
            SELECT * FROM `tickets` WHERE ticket_id = :id";

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
            SELECT * FROM `tickets` WHERE user_id = :id ;";

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

        public function getByShow($show_id){

            $query = "
            SELECT * FROM tickets where show_id = :show_id ;";

            $parameters['show_id'] = $show_id;

            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->mapUnique($resultSet);
            }else {
                return false;
            }
        }

        public function getSoldByShow($show_id){

            $query = "
            SELECT * FROM tickets where show_id = :show_id ;";

            $parameters['show_id'] = $show_id;

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


         /**
         * Get all tickets that belongs to a theater between two specific dates
         */
        public function getAllByTheater($theater_id, $date1, $date2) {

            $query = "
            SELECT * FROM `tickets` as t 
            INNER JOIN shows as s
            ON t.show_id = s.show_id
            WHERE s.theater_id = :theater_id
            AND t.date BETWEEN :date1 AND :date2; 
            ;";

            $parameters['theater_id'] = $theater_id;
            $parameters['date1'] = $date1;
            $parameters['date2'] = $date2;


            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
            }catch (Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return false;
            }
        }

    

     
        public function getSoldAndRemanent($theater_id) {

            $query = "
            SELECT * FROM `tickets` as t 
            INNER JOIN shows as s
            ON t.show_id = s.show_id
            WHERE s.theater_id = :theater_id 
            ;";

            $parameters['theater_id'] = $theater_id;
   


            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
            }catch (Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return false;
            }
        }




        public function add(Ticket $ticket, $purchase_id){

            $query = "
            INSERT INTO `tickets` (show_id, purchase_id, seat_number, user_id, cost, date) 
            VALUES (:show_id, :purchase_id, :seat_number, :user_id, :cost, '".$ticket->getDate()."');";

            $parameters['show_id'] = $ticket->getShow()->getId();
            $parameters['purchase_id'] = $purchase_id;
            $parameters['seat_number'] = $ticket->getSeat_number();
            $parameters['user_id'] = $ticket->getClient()->getId();
            $parameters['cost'] = $ticket->getCost();
            
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
            $this->showDAO = new ShowDAO();

            $values = array_map(function($row){
                $ticket = new Ticket($row['seat_number'], $row['cost']);
                $ticket->setShow($this->showDAO->get($row['show_id']));
                $ticket->setClient($this->userDAO->get($row['user_id']));
                $ticket->setDate( $row['date']);
               

                return $ticket;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }

        public function mapUnique($data){

            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $ticket = new Ticket($row['seat_number'], $row['cost']);
                $ticket->setDate( $row['date']);
               

                return $ticket;
            }, $data);

            return $values;
        }
    
    }


?>