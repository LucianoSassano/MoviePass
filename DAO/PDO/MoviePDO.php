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
            $this->fileName = ROOT . "Data/movies.json";
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
            $arrayToEncode = array();

            foreach($this->moviesList as $movie)
            {   
                $valuesArray["id"] = $movie->getId();         
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["poster_path"] = $movie->getPoster_path();
                $valuesArray["language"] = $movie->getLanguage();
                $valuesArray["adult"] = $movie->getAdult();
                $valuesArray["vote_average"] = $movie->getVote_average();
                $valuesArray["genres"] = $this->getGenreIdList($movie->getGenres());

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
            file_put_contents('Data/movies.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/movies.json'))
            {
                $jsonContent = file_get_contents('Data/movies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new Movie();

                    $movie->setId($valuesArray["id"]);
                    $movie->setTitle($valuesArray["title"]);
                    $movie->setOverview($valuesArray["overview"]);
                    $movie->setPoster_path($valuesArray["poster_path"]);
                    $movie->setLanguage($valuesArray["language"]);
                    $movie->setAdult($valuesArray["adult"]);
                    $movie->setVote_average($valuesArray["vote_average"]);

                    $genres = $this->getGenreList($valuesArray["genres"]);

                    $movie->setGenres($genres);
                    
                    array_push($this->moviesList, $movie);
                }
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
    }
    

?>