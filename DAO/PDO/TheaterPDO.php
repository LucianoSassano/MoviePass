<?php 

    namespace DAO\PDO;

    use DAO\PDO\RoomPDO as RoomDAO;
    use \PDO;
    use \Exception;
    use DAO\Connection;
    

    use Models\Theater;

    class TheaterPDO
    {
        private $connection;

        private $roomDAO;

        function __construct()
        {
            $this->roomDAO = new RoomDAO();
        }

        /**
         * Get by id
         */
        public function get($id) {
           
            $query = "
            SELECT * FROM `theaters` WHERE theater_id = :id
            ";

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

        public function getByMovie($movie_id) {

            $query = " select distinct t.theater_id as theater_id, t.name as name, t.address as address 
            from theaters as t 
            inner join rooms as r 
            on t.theater_id = r.theater_id 
            inner join shows as s 
            on r.room_id = s.room_id 
            where movie_id = :movie_id ;";

            $parameters['movie_id'] = $movie_id;

            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->mapByMovie($resultSet, $movie_id);
            }else {
                return false;
            }

        }

        /**
         * Get all theaters
         */
        public function getAll() {

            $query = "
            SELECT * FROM `theaters`;";

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
         * Edit theater
         */
        public function edit(Theater $theater) {

            $query = "
            UPDATE theaters SET name = :name, address = :address
            WHERE theater_id = :id";

            $parameters['name'] = $theater->getName();
            $parameters['address'] = $theater->getAddress();
            $parameters['id'] = $theater->getId();

            try {

                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex) {
                throw $ex;
            }
        }


        /**
         * Add new user
         */
        public function add(Theater $theater) {
            
            $query = "
            INSERT INTO theaters (name, address) VALUES (:name, :address);";

            $parameters['name'] = $theater->getName();
            $parameters['address'] = $theater->getAddress();

            try {

                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex) {
                throw $ex;
            }
        }

        public function getByName($name) {

            $query = "
            SELECT * FROM `theaters` WHERE name = :name";

            $parameters['name'] = $name;

            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
            }catch (Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return null;
            }

        }


        public function getByAddress($address) {

            $query = "
            SELECT * FROM `theaters` WHERE address = :address";

            $parameters['address'] = $address;

            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
            }catch (Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return null;
            }

        }

        /**
         * Map model
         */
        public function map($data){

            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $theater = new Theater($row['theater_id'], $row['name'], $row['address']);
                $theater->setRooms($this->roomDAO->getByTheater($row['theater_id']));
                return $theater;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }


        public function mapByMovie($data, $movie_id){

            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $theater = new Theater($row['theater_id'], $row['name'], $row['address']);
                // $theater->setRooms($this->roomDAO->getByTheaterAndMovie($row['theater_id'], $movie_id));
                return $theater;
            }, $data);

            foreach($values as $theater){
                // print_r($theater);
                $theater->setRooms($this->roomDAO->getByTheaterAndMovie($theater->getId(), $movie_id));
            }

            return $values;
        }
    }

?>