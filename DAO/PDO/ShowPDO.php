<?php 

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use DAO\PDO\MoviePDO as MovieDAO;

    use Models\Show;

    class ShowPDO
    {
        private $connection;
        private $movieDAO;

        function __construct(){
            $this->movieDAO = new MovieDAO();
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

        /**
         * Edit show
         */
        // public function edit(Show $show) {

        //     $query = "";

        //     $parameters[''] = $;

        //     try {

        //         $this->connection = Connection::GetInstance();
        //         return $this->connection->ExecuteNonQuery($query, $parameters);

        //     }catch(Exception $ex) {
        //         throw $ex;
        //     }
        // }
        
        //chequea la existencia de la pelicula contenida en nustro show en todos los otros teatros en la fecha del show
        public function checkMovieInOtherTheaters($show){
            
            //me va a traer todos los shows que tengan la movie de mi show en el mismo dia pero en otro teatro

            $query = " 
            SELECT * FROM `shows` as s WHERE s.movie_id ='".$show->getMovie()->getId()."'
            AND s.theater_id != :theater_id
            AND s.date = :date ";

           // $parameters['movie_id'] = $show->getMovie()->getId();
            $parameters['theater_id'] = $show->getTheater()->getId();
            $parameters['date'] = $show->getDate();
            
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
               

            }catch(Exception $ex) {
                throw $ex;
            }

            if(empty($resultSet)){
                return true;
                // si retorna vacio la movie no se encuentra en otro teatro en la fecha especificada , se puede insertar el registro
            }else{
                return false;
                // ya existe la movie en otro teatro en la fecha especificada , no se puede instertar el show
            }

        }

        public function checkMovieInOtherRooms($show){


            // seleciono todos los shows que tengan la movie especificada en la fecha y que no esten en mi sala

            $query = " 
            SELECT * FROM `shows` WHERE movie_id = '".$show->getMovie()->getId()."'
            AND theater_id = :theater_id 
            AND room_id != :room_id
            AND date = :date  ;";

            $parameters['theater_id'] = $show->getTheater()->getId();
            $parameters['room_id'] = $show->getRoom()->getRoom_id();
            $parameters['date'] = $show->getDate();
            
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
               

            }catch(Exception $ex) {
                throw $ex;
            }

            if(empty($resultSet)){
                return true;
                // si retorna vacio la movie no se encuentra en otro room en la fecha especificada , se puede insertar el registro
            }else{
                return false;
                // ya existe la movie en otro room en la fecha especificada , no se puede instertar el show
            }


        }


    

        public function checkShowDate($show){

        
            $query = " 
            SELECT * FROM `shows` WHERE  
            date = :date
            and startTime = :startTime ;";

            $parameters['date'] = $show->getDate();
            $parameters['startTime'] = $show->getStartTime();            
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
               

            }catch(Exception $ex) {
                throw $ex;
            }

            if(empty($resultSet)){
                // si retorna vacio quiere decir que el horario y la fecha seleccionada se encuentran libres por lo que se puede insertar el show
                return true;
            }else{
                return false;
            }

        }

        /**
         * Add new show
         */
        public function add(Show $show,$theater_id, $room_id) {


            if($this->checkMovieInOtherTheaters($show)){
               
            if($this->checkMovieInOtherRooms($show)){

                if($this->checkShowDate($show)){
                    $query = "
                    SET FOREIGN_KEY_CHECKS=0;
                    INSERT INTO `shows` (room_id, theater_id, movie_id, date, startTime, endTime, price) 
                    VALUES (:room_id, :theater_id, :movie_id, :date, :startTime, :endTime, :price);
                    SET FOREIGN_KEY_CHECKS=1;";
        
                    $parameters['room_id'] = $room_id;
                    $parameters['theater_id'] = $theater_id;
                    $parameters['movie_id'] = $show->getMovie()->getId();
                    $parameters['date'] = $show->getDate();
                    $parameters['startTime'] = $show->getStartTime();
                    $parameters['endTime'] = $show->getEndTime();
                    $parameters['price'] = $show->getPrice();
                
        
                    try {
        
                        $this->connection = Connection::GetInstance();
                        return $this->connection->ExecuteNonQuery($query, $parameters);
        
                    }catch(Exception $ex) {
                        throw $ex;
                    }
                }
                
            }else{
                echo "ERROR";
            }
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

                return $show;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }

?>