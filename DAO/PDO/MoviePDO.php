<?php 

    namespace DAO\PDO;

    use DAO\PDO\GenrePDO as GenreDAO;
    use DAO\PDO\MovieGenrePDO as MovieGenreDAO;
    use Models\Movie;
    use \PDO;
    use \Exception;
    use DAO\Connection;

    class MoviePDO {

        private $moviesList = array();
        private $connection;
        private $movieGenreDAO;

        public function __construct() {
            $this->movieGenreDAO = new MovieGenreDAO();
            $this->genreDAO = new GenreDAO();
        }

        public function get($id) {

            $query= "
            SELECT * FROM movies as m 
             WHERE m.movie_id = :id ";

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

        public function getAll() {

            $query = "
            SELECT * FROM movies;";

            $parameters = array();

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

        public function updateAll($moviesArray) {

            foreach($moviesArray as $movie) {
                $this->add($movie);
            }
            return $this->getAll();
        }

        public function add(Movie $movie) {

            // Inserta si o solo si la pelicula no existe ya en la base de datos, agrega solo las nuevas de la api
            $query= "
            INSERT INTO movies (movie_id, duration, title, language, poster_path, adult, overview, vote_average)
                SELECT :movie_id, :duration, :title, :language, :poster_path, :adult, :overview, :vote_average
            WHERE NOT EXISTS (SELECT movie_id FROM movies WHERE movie_id = :movie_id);";

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
                $rows = $this->connection->ExecuteNonQuery($query, $parameters);

                if(!empty($movie->getGenres())){
                    foreach ($movie->getGenres() as $genre) {
                        if($genre){
                            $this->movieGenreDAO->add($movie->getId(), $genre->getId());
                        }
                    }
                }
                return $rows;
            }catch (Exception $ex) {
                throw $ex;
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

        
         /**
         * Map model
         */
        public function map($data){
            
            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $movie = new Movie($row['movie_id'], $row['title'], $row['overview'], $row['poster_path'], $row['language'], $row['adult'], $row['vote_average'], $row['duration']) ;
                $movie->setGenres($this->genreDAO->getByMovieId($row['movie_id']));
                return $movie;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }
    

?>