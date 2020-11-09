<?php 

    namespace DAO\JSON;

    use Models\Genre;

    class GenreJSON {

        private $genresList = array();
        private $fileName;

        public function __construct() {
            $this->fileName = ROOT . "Data/genres.json";
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
            $arrayToEncode = array();

            foreach($this->genresList as $genre)
            {   
                $valuesArray["id"] = $genre->getId();         
                $valuesArray["name"] = $genre->getName();

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
            file_put_contents('Data/genres.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/genres.json'))
            {
                $jsonContent = file_get_contents('Data/genres.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $genre = new Genre();

                    $genre->setId($valuesArray["id"]);
                    $genre->setName($valuesArray["name"]);
                    
                    array_push($this->genresList, $genre);
                }
            }
        }
    }

?>