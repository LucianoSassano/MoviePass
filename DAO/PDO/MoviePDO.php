<?php 

    namespace DAO\PDO;

    use DAO\PDO\GenrePDO as GenreDAO;
    use Models\Movie;
    use \PDO;
    use \Exception;
    use DAO\Connection;

    class MoviePDO {

        private $moviesList = array();
        private $connection;
        private $genreDAO;

        public function __construct() {
            $this->genreDAO = new GenreDAO();
        }

        public function get($id) {

            $this->RetrieveData();
            $founded = null;

            foreach($this->moviesList as $movie) {
                if($movie->getId() == $id) {
                    $founded = $movie;
                }
            }
            return $founded;
        }

        public function getAll() {
            $this->RetrieveData();
            return $this->moviesList;
        }

        public function updateAll($moviesArray) {
            $this->moviesList = $moviesArray;
            $this->SaveData();
            

            return $this->moviesList;
        }

        private function SaveData()
        {

             foreach($this->moviesList as $movie)
             {   
              $this->add($movie);
             }
            
        }

        private function RetrieveData()
        {
            $query = "
            SELECT * FROM movie ";
 
            $parameters = array();
 
            try {
                 
             $this->connection = Connection::GetInstance();
             $resultSet = $this->connection->Execute($query, $parameters);
             
 
             }catch(Exception $ex) {
             throw $ex;
             }
 
             if(!empty($resultSet)){
             $this->moviesList = $this->map($resultSet);
             return $this->moviesList;
             // deberia hacer un foreach y mapear uno a uno ?
           }else {
             return false;
          }
        }


        /**
         * Get genres from movie
         */
        public function getGenreList($genres = array()) {

            $this->genreDAO = new GenreDAO(); // instancio el dao de genres

            $genreObjs = $this->genreDAO->getGenreList($genres);   // $genres es un array con las id de los generos que le corresponden a la movie
            
            // retrona el arreglo cargado con los obj genre
            return $genreObjs;
        }

        /**
         * Get an array of id's from an array of Genres
         */
        public function getGenreIdList($genres = array()) {

            $genresIdsList = array();
            foreach($genres as $genre) {
                array_push($genresIdsList, $genre->getId());
            }

            return $genresIdsList;
        }

        public function add(Movie $movie){

            $query = "
            INSERT INTO movie (movie_id, duration, title, language, poster_path, adult, overview, vote_average) VALUES (:movie_id, :duration, :title, :language, :poster_path, :adult, :overview, :vote_average) ";

            $parameters['movie_id'] = $movie->getId();
            $parameters['duration'] = $movie->getDuration();
            $parameters['title'] = $movie->getTitle();
            $parameters['language'] = $movie->getLanguage();
            $parameters['poster_path'] = $movie->getPoster_path();
            $parameters['adult'] = $movie->getAdult();
            $parameters['overview'] = $movie->getOverview();
            $parameters['vote_average'] = $movie->getVote_average();

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
                $movie = new Movie($row['id'], $row['title'], $row['overview'], $row['poster_path'], $row['language'], $row['adult'], $row['vote_average'], $row['genres']);

                return $movie;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }
    

?>