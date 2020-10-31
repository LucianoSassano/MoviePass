<?php 

    namespace DAO\PDO;

    use Models\Genre;
    use \PDO;
    use \Exception;
    use DAO\Connection;

    class GenrePDO {

        private $genresList = array();
        private $connection;

        public function __construct() {
            
        }

        public function get($id) {
           $this->RetrieveData();
           $founded = null;

           foreach($this->genresList as $genre) {
               if($genre->getId() == $id) {
                   $founded = $genre;
               }
           }
           return $founded;
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
            $this->RetrieveData();
            return $this->genresList;
        }

        public function updateAll($genresArray) {
            $this->genresList = $genresArray;
            $this->SaveData();

            return $this->genresList;
        }

        private function SaveData()
        {


          foreach($this->genresList as $genre)
          {   
              $this->add($genre);
          }
      
        }

        public function add(Genre $genre){

            $query = "
            INSERT INTO genre (genre_id, name) VALUES (:genre_id, :name) ";

            $parameters['genre_id'] = $genre->getId();
            $parameters['name'] = $genre->getName();

            try {

                $this->connection = Connection::GetInstance();
                
                return $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }

        }

        private function RetrieveData()
        {

           $query = "
           SELECT * FROM genre ";

           $parameters = array();

           try {
                
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            

            }catch(Exception $ex) {
            throw $ex;
            }

            if(!empty($resultSet)){
             $this->genreList = $this->map($resultSet);
             return $this->genresList;
            // deberia hacer un foreach y mapear uno a uno ?
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
                $genre = new Genre($row['name']);
                $genre->setId($row['genre_id']);
                

                return $genre;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }
?>