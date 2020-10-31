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

           //le paso el id de un genero y lo busca en la db
           // si lo encuentra lo retorna mapeado en obj
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

          //recibo un array de ids correspondientes a los generos
          // loopeo sobre el array utilizando la funcion get para
          // traerme todos los generos correspondientes a los id 
          // devuelvo un listado de obj genero en un array list

          $genreList = array();

          if(!empty($genres)) {
              foreach($genres as $id) {
                  array_push($genreList, $this->get($id));
              }
          }
          return $genreList;
        }

        public function getAll() {
            // retorno todos los generos que tengo en mi db
            // en forma de array list
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
          //guarda en la db todos los generos que me traigo de la api
          // genero consta de un name y un id

          $query = "
            INSERT INTO genre (genre_id, name) VALUES (:genre_id , :name) ";

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
           //le pega a la db y me trae los generos
           //los mapeo

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
            return $genreList = $this->map($resultSet);
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
                $genre->setId($row['user_id']);
                

                return $genre;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }
?>