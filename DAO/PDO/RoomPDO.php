<?php 

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use DAO\PDO\ShowPDO as ShowDAO;

    use Models\Room;

    class RoomPDO
    {
        private $connection;

        private $showDAO;

        function __construct() {
          
        }

        /**
         * Get by id
         */
        public function get($id) {

            $query = "SELECT * FROM rooms WHERE room_id = :id";

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

          /**
         * Get by id
         */
        public function getNoShows($id) {

            $query = "SELECT * FROM rooms WHERE room_id = :id";

            $parameters['id'] = $id;

            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->mapNoShows($resultSet);
            }else {
                return false;
            }

        }

        public function getByTheater($theater_id) {

            $query = "SELECT * FROM rooms WHERE theater_id = :theater_id;";

            $parameters['theater_id'] = $theater_id;
            
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

        public function getByTheaterAndMovie($theater_id, $movie_id) {

            $query = "select distinct r.room_id, r.capacity, r.name 
            from rooms as r 
            inner join shows as s 
            on r.room_id = s.room_id 
            where r.theater_id = :theater_id 
            and s.movie_id = :movie_id ;";

            $parameters['theater_id'] = $theater_id;
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

        public function getWithShow($room_id, $show_id){
            $this->showDAO = new ShowDAO();

            $query = "
            select r.room_id, r.capacity, r.name 
            from rooms as r 
            inner join shows as s 
            on r.room_id = s.room_id 
            where r.room_id = :room_id 
            and s.show_id = :show_id ;";

            $parameters['room_id'] = $room_id;
            $parameters['show_id'] = $show_id;

            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }


            if(!empty($resultSet)){

                $room = new Room($resultSet['0']['name'], $resultSet['0']['capacity']);
                $room->setRoom_id($resultSet['0']['room_id']);
                $room->setShows($this->showDAO->get($show_id));
                
            }else {
                return false;
            }
            
            
           
            return $room;
        }

        /**
         * Get all theaters
         */
        public function getAll() {

            $query = "SELECT * FROM rooms;";

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
         * Edit room
         */
        // public function edit(Room $room) {

        //     $query = "";

        //     $parameters[''] = $;

        //     try {

        //         $this->connection = Connection::GetInstance();
        //         return $this->connection->ExecuteNonQuery($query, $parameters);

        //     }catch(Exception $ex) {
        //         throw $ex;
        //     }
        // }


        /**
         * Add new user
         */
        public function add(Room $room, $theater_id) {
            
            $query = "
            INSERT INTO rooms (theater_id, capacity, name) VALUES (:theater_id, :capacity, :name);";

            $parameters['theater_id'] = $theater_id;
            $parameters['capacity'] = $room->getCapacity();
            $parameters['name'] = $room->getName();

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
                $room = new Room($row['name'], $row['capacity']);
                $room->setRoom_id($row['room_id']);
                $room->setShows($this->showDAO->getByRoom($row['room_id']));
                return $room;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
        /**
         * Map model
         */
        public function mapNoShows($data){
            $data = is_array($data) ? $data : [];

          

            $values = array_map(function($row){
                $room = new Room($row['name'], $row['capacity']);
                $room->setRoom_id($row['room_id']);
            
                return $room;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }

        public function mapByMovie($data, $movie_id){
            $data = is_array($data) ? $data : [];

            $this->showDAO = new ShowDAO();

            $values = array_map(function($row){
                $room = new Room($row['name'], $row['capacity']);
                $room->setRoom_id($row['room_id']);
                //$room->setShows($this->showDAO->getByRoomAndMovie($row['room_id'], $movie_id));
                return $room;
            }, $data);

            foreach($values as $room) {
                $room->setShows($this->showDAO->getByRoomAndMovie($room->getRoom_id(), $movie_id));
            }

            return $values;
        }

    }

?>