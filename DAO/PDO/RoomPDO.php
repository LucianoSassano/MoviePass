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
            $this->showDAO = new ShowDAO();
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

            $values = array_map(function($row){
                $room = new Room($row['name'], $row['capacity']);
                $room->setRoom_id($row['room_id']);
                $room->setShows($this->showDAO->getByRoom($row['room_id']));
                return $room;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }

?>