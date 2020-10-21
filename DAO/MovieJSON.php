<?php 

    namespace DAO;

    use Models\Movie;

    class MovieJSON {

        private $moviesList = array();
        private $fileName;

        public function __construct() {
            $this->fileName = ROOT . "Data/movies.json";
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
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["poster_path"] = $movie->getPoster_path();
                $valuesArray["language"] = $movie->getLanguage();
                $valuesArray["adult"] = $movie->getAdult();
                $valuesArray["vote_average"] = $movie->getVote_average();
                $valuesArray["genres"] = $movie->getGenres();

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

                    $movie->setTitle($valuesArray["title"]);
                    $movie->setOverview($valuesArray["overview"]);
                    $movie->setPoster_path($valuesArray["poster_path"]);
                    $movie->setLanguage($valuesArray["language"]);
                    $movie->setAdult($valuesArray["adult"]);
                    $movie->setVote_average($valuesArray["vote_average"]);
                    $movie->setGenres($valuesArray["genres"]);
                    
                    array_push($this->moviesList, $movie);
                }
            }
        }
    }

?>