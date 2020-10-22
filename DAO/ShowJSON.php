<?php 

    namespace DAO;

    use Models\Show;

    class ShowJSON {

        private $showList = array();
        private $fileName;

        public function __construct() {
            $this->fileName = ROOT . "Data/shows.json";
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
        public function add(show $show) {

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
                $valuesArray["movie"] = $show->getMovie();
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
                    $show = new show();

                    $show->setId($valuesArray["id"]);
                    $show->setMovie($valuesArray["movie"]);
                    $show->setDate($valuesArray["date"]);
                    $show->setTime($valuesArray["time"]);
                    $show->setPrice($valuesArray["price"]);
                    
                    array_push($this->showList, $show);
                }
            }
        }
    }

?>