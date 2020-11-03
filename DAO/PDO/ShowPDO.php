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


        public function checkShow($show){

            //validar si la movie existe en otro cine y si existe en el cine que se ecuentre en otra sala 
            $query = " 
            SELECT * FROM `shows` WHERE NOT movie_id = '".$show->getMovie()->getId()."' AND
             ('".$show->getDate()."' NOT BETWEEN date AND endTime)
             AND ('".$show->getEndTime()."' NOT BETWEEN date AND endTime);";
            
            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                //var_dump($resultSet);

            }catch(Exception $ex) {
                throw $ex;
            }

            if(empty($resultSet)){
                return false;
            }else{
                return true;
            }

        }

        /**
         * Add new show
         */
        public function add(Show $show, $room_id) {


            //si esta vacio quiere decir que ya no existe esa pelicual con anterioridad por lo que podemos insertarla
            if($this->checkShow($show)){


                    $query = "
                    SET FOREIGN_KEY_CHECKS=0;
                    INSERT INTO `shows` (room_id, movie_id, date, price, endTime) 
                    VALUES (:room_id, :movie_id, '".$show->getDate()."', :price, '".$show->getEndTime()."');
                    SET FOREIGN_KEY_CHECKS=1;";
        
                    $parameters['room_id'] = $room_id;
                    $parameters['movie_id'] = $show->getMovie()->getId();
                    $parameters['price'] = $show->getPrice();
                
        
                    try {
        
                        $this->connection = Connection::GetInstance();
                        return $this->connection->ExecuteNonQuery($query, $parameters);
        
                    }catch(Exception $ex) {
                        throw $ex;
                    }
                    
                }else{
                    echo "ERROR";
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
                $show->setEndTime($row['endTime']);
                $show->setMovie($this->movieDAO->get($row['movie_id']));

                return $show;
            }, $data);

            return count($values) > 0 ? $values : $values['0'];
        }
    }

?>