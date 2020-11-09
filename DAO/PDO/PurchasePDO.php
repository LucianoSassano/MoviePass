<?php

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use Models\Purchase;

    use DAO\PDO\TicketPDO as TicketDAO;

    class PurchasePDO{

  
        private $connection;

        private $ticketDAO;

        public function __construct() {
            $this->ticketDAO = new TicketDAO();
        }


        public function get($purchase_id){

            $query= "
            SELECT * FROM purchases as p 
             WHERE p.purchase_id  = :id ";

            $parameters['id'] = $purchase_id;

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

        public function getAll(){

            $query= "
            SELECT * FROM purchases ";


            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
          
            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);

            }else {
                return false;
            }

        
        }

        public function add(Purchase $purchase) {
            
            $query = "
            INSERT INTO purchases (theater_id, userEmail , date, totalCost) 
            VALUES (:theater_id , :userEmail, :date, :totalCost) ";

            $parameters['theater_id'] = $purchase->getTheater()->getId();
            $parameters['userEmail'] = $purchase->getUserEmail();
            $parameters['date'] = $purchase->getDate();
            $parameters['totalCost'] = $purchase->getTotalCost(); 
        
            try {

                $this->connection = Connection::GetInstance();
                
                $rows = $this->connection->ExecuteNonQuery($query, $parameters);
                $this->addTickets($purchase);

            }catch(Exception $ex) {
                throw $ex;
            }
          return $rows;            
        }

        public function getLastId(){

            $query = "SELECT MAX(purchase_id) as id FROM purchases";
            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            }catch(Exception $ex) {
                throw $ex;
            }

            return $resultSet['0']['id'];
        }

        public function addTickets(Purchase $purchase){

            $purchase_id = $this->getLastId();

            foreach($purchase->getTickets() as $ticket){
                $this->ticketDAO->add($ticket, $purchase_id);
            }
        }


          /**
         * Map model
         */
        public function map($data){
            
            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $purchase = new Purchase($row['userEmail'], $this->theaterDAO->get($row['theater_id']), $row['date'], $row['tickets'], $row['totalCost']  );
                return $purchase;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }




    }

?>