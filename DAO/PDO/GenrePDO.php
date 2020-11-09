<?php 

    namespace DAO\PDO;

    use Models\Genre;
    use \PDO;
    use \Exception;
    use DAO\Connection;

    class GenrePDO {

        private $genresList = array();
        private $connection;

        public function get($id) {
            
            $query= "
            SELECT * FROM genres 
            WHERE genre_id = :id ";

           $parameters['id'] = $id;

           try {

               $this->connection = Connection::GetInstance();
               $resultSet = $this->connection->Execute($query, $parameters);
               //print_r($resultSet);
           }catch(Exception $ex) {
               throw $ex;
           }

           if(!empty($resultSet)){
               return $this->map($resultSet);
               //print_r($this->map($resultSet));
           }else {
               return false;
           }
        }

        /**
         * Get by array of id's
         */
        public function getGenreList($genres = array()) {
          $genreList = array();

          if(!empty($genres)) {
              foreach($genres as $id) {
                  array_push($genreList, $this->get($id));
              }
          }
          return $genreList;
        }

        public function getAll() {

            $query = "
            SELECT * FROM genres;";

            $parameters = array();

            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){                
                return $this->map($resultSet);
                // print_r($this->map($resultSet));
            }else {
                return false;
            }
        }

        public function updateAll($genresArray) {

            foreach($genresArray as $genre) {
                $this->add($genre);
            }
            return $this->getAll();
        }


        public function add(Genre $genre){

            $query = "
            INSERT INTO genres (genre_id, name)
                SELECT :genre_id, :name
            WHERE NOT EXISTS (SELECT genre_id FROM genres WHERE genre_id = :genre_id);";

            $parameters['genre_id'] = $genre->getId();
            $parameters['name'] = $genre->getName();

            try {

                $this->connection = Connection::GetInstance();
                
                return $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }
        }

        public function getByMovieId($movie_id){

            $query = "
            SELECT * FROM genres as g
            INNER JOIN genre_x_movies as g_x_m
            ON g.genre_id = g_x_m.genre_id
            WHERE g_x_m.movie_id = :movie_id;
            ";

            $parameters['movie_id'] = $movie_id;

            try {

                $this->connection = Connection::GetInstance();
                
                $resultSet =  $this->connection->Execute($query, $parameters);
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
         * Map model
         */
        public function map($data){
            
            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){

                return new Genre($row['genre_id'], $row['name']);
                
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }
?>