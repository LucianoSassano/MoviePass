<?php 

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use DAO\PDO\MoviePDO as MovieDAO;
    use DAO\PDO\RoomPDO as RoomDAO;
    use DAO\PDO\TicketPDO as TicketDAO;

    use Models\Show;

    class ShowPDO
    {
        private $connection;
        private $movieDAO;
        private $roomDAO;
        private $ticketDAO;

        function __construct(){
            $this->movieDAO = new MovieDAO();
            $this->roomDAO = new RoomDAO();
           
          
        }

        /**
         * Get by id
         */
        public function get($id) {

            $query = "
            SELECT * FROM `shows` WHERE show_id = :id";

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

        public function getByRoom($room_id) {

            $query = "
            SELECT * FROM `shows` WHERE room_id = :room_id;";

            $parameters['room_id'] = $room_id;
            
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

        public function getByRoomAndMovie($room_id, $movie_id) {

            $query = "select * from shows 
            where room_id = :room_id 
            and movie_id = :movie_id ;";

            $parameters['room_id'] = $room_id;
            $parameters['movie_id'] = $movie_id;

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

        public function getByTheater($theater_id){

            
            $query = "
            SELECT * FROM shows as s 
            WHERE :theater_id = s.theater_id ;";

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

        

        public function getByGenre($genre_id){

            $query = 
            "SELECT * FROM `shows` AS s
            INNER JOIN `genre_x_movies` AS g_x_m
            ON s.movie_id = g_x_m.movie_id
            WHERE g_x_m.genre_id = :genre_id";

            $parameters['genre_id'] = $genre_id;

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

        public function getOccupiedSeats($show_id) {
            $this->ticketDAO = new TicketDAO();
            
            $tickets = $this->ticketDAO->getByShow($show_id);
            $seats = array();

            if($tickets)
            foreach($tickets as $ticket){
                array_push($seats, $ticket->getSeat_Number());
            }
            return $seats;
        }

        /**
         * Get all theaters
         */
        public function getAll() {

            $query = "
            SELECT * FROM `shows`;";

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

        
        //chequea la existencia de la pelicula contenida en nustro show en todos los otros teatros en la fecha del show
        public function checkMovieInOtherTheaters($show,$theater_id){
            
            //me va a traer todos los shows que tengan la movie de mi show en el mismo dia pero en otro teatro

            $query = " 
            SELECT * FROM `shows` as s WHERE s.movie_id = :movie_id
            AND s.date = :date 
            AND s.theater_id != :theater_id;";

            $parameters['movie_id'] = $show->getMovie()->getId();
            $parameters['theater_id'] = $theater_id;
            $parameters['date'] = $show->getDate();
            
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
               

            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                 
                return $this->map($resultSet);
            
            }else{
                return $resultSet;
             
            }

        }

        public function checkMovieInOtherRooms($show,$room_id){


            // seleciono todos los shows que tengan la movie especificada en la fecha y que no esten en mi sala

            $query = " 
            SELECT * FROM `shows` WHERE movie_id = :movie_id
            AND theater_id = :theater_id 
            AND date = :date
            AND room_id != :room_id;";

            $parameters['movie_id'] = $show->getMovie()->getId();
            $parameters['theater_id'] = $show->getTheater()->getId();
            $parameters['room_id'] = $room_id;
            $parameters['date'] = $show->getDate();
            
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
               

            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
             
                return $this->map($resultSet);
             
            }else{
                return $resultSet;
             
            }


        }


    

        public function checkShowDate($show){

        
            $query = " 
            SELECT * FROM `shows` as s WHERE  
            s.date = :date AND 
            s.room_id = :room_id AND
            (:startTime BETWEEN s.startTime AND  s.endTime OR :midInterval BETWEEN s.startTime AND  s.endTime OR :endTime BETWEEN s.startTime AND  s.endTime ); ";

            $parameters['date'] = $show->getDate();
            $parameters['startTime'] = $show->getStartTime();
            $parameters['midInterval'] = $show->getMidInterval();
            $parameters['endTime'] =$show->getEndTime();
            $parameters['room_id'] = $show->getRoom()->getRoom_Id();
        
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
               

            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
            
                return $this->map($resultSet);
            }else{
               
                $resultSet = array();
                return $resultSet;
            }

        }

        /**
         * Add new show
         */
        public function add(Show $show,$theater_id, $room_id) {
                  
                    $query = "
                    SET FOREIGN_KEY_CHECKS=0;
                    INSERT INTO `shows` (room_id, theater_id, movie_id, date, startTime, endTime, price, midInterval) 
                    VALUES (:room_id, :theater_id, :movie_id, :date, :startTime, :endTime, :price, :midInterval);
                    SET FOREIGN_KEY_CHECKS=1;";
        
                    $parameters['room_id'] = $room_id;
                    $parameters['theater_id'] = $theater_id;
                    $parameters['movie_id'] = $show->getMovie()->getId();
                    $parameters['date'] = $show->getDate();
                    $parameters['startTime'] = $show->getStartTime();
                    $parameters['endTime'] = $show->getEndTime();
                    $parameters['price'] = $show->getPrice();
                    $parameters['midInterval'] = $show->getMidInterval();
                
        
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
                $show = new Show($row['date'], $row['price']);
                $show->setId($row['show_id']);
                $show->setStartTime($row['startTime']);
                $show->setEndTime($row['endTime']);
                $show->setMovie($this->movieDAO->get($row['movie_id']));
                $show->setRoom($this->roomDAO->getNoShows($row['room_id']));
                
                

                return $show;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }

        public function mapUnique($data){

            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $show = new Show($row['date'], $row['price']);
                $show->setId($row['show_id']);
                $show->setStartTime($row['startTime']);
                $show->setEndTime($row['endTime']);
                
                return $show;
            }, $data);

            return $values;
        }
    }

?>