<?php 

    namespace DAO\JSON;

    use Models\Show;
    use Models\Movie;

    use DAO\JSON\MovieJSON as MovieDAO;

    class ShowJSON {

        private $showList = array();
        private $fileName;
        private $movieDAO;

        public function __construct() {
            $this->fileName = ROOT . "Data/shows.json";
            $this->movieDAO = new MovieDAO();
        }

        /**
         * Get by id
         */
        public function get($id) {

            $this->RetrieveData();
            $founded = null;

            foreach($this->showList as $show) {
                if($show->getId() == $id) {
                    $founded = $show;
                }
            }
            return $founded;
        }

        /**
         * Get by array of id's
         */
        public function getShowList($shows = array()) {

            $showList = array();

            if(!empty($shows)) {
                foreach($shows as $id) {
                    array_push($showList, $this->get($id));
                }
            }
            return $showList;
        }

        /**
         * Get shows by genre_id
         */
        public function getByGenre($genre_id) {
            $this->RetrieveData();
            $showsFiltered = array();

            foreach($this->showList as $show) {
                $genres = $show->getMovie()->getGenres();
                foreach($genres as $genre) {
                    if($genre->getId() == $genre_id) {
                        array_push($showsFiltered, $show);
                    }
                }
            }

            return $showsFiltered;
        }
        
        /**
         * Get all shows
         */
        public function getAll() {
            $this->RetrieveData();
            return $this->showList;
        }

        /**
         * Edit show
         */
        public function edit(show $show) {

            $this->RetrieveData();

            foreach($this->showList as $s) {
                if($s->getId() == $show->getId()) {

                    $s->setMovie($show->getMovie());
                    $s->setDate($show->getDate());
                    $s->setPrice($show->getPrice());
                }
            }
            $this->SaveData();
        }

        /**
         * Remove show by id
         */
        public function remove($id) {

            $this->RetrieveData();

            foreach($this->showList as $show) {
                if($show->getId() == $id) {
                    $key = array_search($show, $this->showList);
                    unset($this->showList[$key]);
                }
            }
        }

        /**
         * Add a new show
         */
        public function add(Show $show) {

            $this->RetrieveData();

            $show->setId($this->getLastId());
            array_push($this->showList, $show);

            $this->SaveData();
            
            // Retorna el show con el id seteado
            return $show;
        }

        // Metodo privado que devuelve la ultima id del array +1
        private function getLastId() {
            $shows = $this->showList;
            $id = 0;

            foreach($shows as $show) {
                if($id <= $show->getId()) {
                    $id = $show->getId();
                    $id++;
                }
            }
            return $id == 0 ? 1 : $id;  // Si no hay ninguno creado, arranca con el id 1
        }

        /**
         * JSON methods
         */
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->showList as $show)
            {            
                $valuesArray["id"] = $show->getId();

                $valuesArray["movie"]["id"] = $show->getMovie()->getId();
                $valuesArray["movie"]["title"] = $show->getMovie()->getTitle();
                $valuesArray["movie"]["overview"] = $show->getMovie()->getOverview();
                $valuesArray["movie"]["poster_path"] = $show->getMovie()->getPoster_path();
                $valuesArray["movie"]["language"] = $show->getMovie()->getLanguage();
                $valuesArray["movie"]["adult"] = $show->getMovie()->getAdult();
                $valuesArray["movie"]["vote_average"] = $show->getMovie()->getVote_average();

                $valuesArray["movie"]["genres"] = $this->movieDAO->getGenreIdList($show->getMovie()->getGenres());                

                $valuesArray["date"] = $show->getDate();
                $valuesArray["time"] = $show->getTime();
                $valuesArray["price"] = $show->getPrice();

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
            file_put_contents('Data/shows.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->showList = array();

            if(file_exists('Data/shows.json'))
            {
                $jsonContent = file_get_contents('Data/shows.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $show = new Show();

                    $show->setId($valuesArray["id"]);

                    $movie = new Movie();

                    $movie->setId($valuesArray["movie"]["id"]);
                    $movie->setTitle($valuesArray["movie"]["title"]);
                    $movie->setOverview($valuesArray["movie"]["overview"]);
                    $movie->setPoster_path($valuesArray["movie"]["poster_path"]);
                    $movie->setLanguage($valuesArray["movie"]["language"]);
                    $movie->setAdult($valuesArray["movie"]["adult"]);
                    $movie->setVote_average($valuesArray["movie"]["vote_average"]);

                    $genres = $this->movieDAO->getGenreList($valuesArray["movie"]["genres"]);
                    
                    $movie->setGenres($genres);

                    $show->setMovie($movie); // TIENE Q DEVOLVER OBJ

                    $show->setDate($valuesArray["date"]);
                   
                    $show->setPrice($valuesArray["price"]);
                    
                    array_push($this->showList, $show);
                }
            }
        }
    }

?>