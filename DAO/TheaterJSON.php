<?php 

    namespace DAO;

    use Models\Theater;

    class TheaterJSON {

        private $theatersList = array();
        private $fileName;

        public function __construct() {
            $this->fileName = ROOT . "Data/theaters.json";
        }

        public function get($id) {
            $this->RetrieveData();
            $founded = null;

            foreach($this->theatersList as $theater) {
                if($theater->getId() == $id) {
                    $founded = $theater;
                }
            }
            return $founded;
        }

        public function getAll() {
            $this->RetrieveData();
            return $this->theatersList;
        }

        public function getByAddress($address){
            $this->RetrieveData();
            $theaterFounded = null;
            
            if(!empty($this->theaterList)){
                foreach($this->theaterList as $theater){
                    if($theater->getAddress() == $address){
                        $theaterFounded = $theater; 
                    }
                }
            }
            return $theaterFounded;
        }

        public function edit(Theater $theater) {
            $this->RetrieveData();

            foreach($this->theatersList as $t) {
                if($t->getId() == $theater->getId()) {
                    $t = $theater;
                }
            }
            $this->SaveData();
        }

        public function remove($id) {
            $this->RetrieveData();

            foreach($this->theatersList as $theater) {
                if($theater->getId() == $id) {
                    $key = array_search($theater, $this->theatersList);
                    unset($this->theatersList[$key]);
                }
            }
        }

        public function add(Theater $theater) {
            $this->RetrieveData();

            $theater->setId($this->getLastId());
            array_push($this->theatersList, $theater);

            $this->SaveData();
            
            // Retorna el cine con el id seteado
            return $theater;
        }

        // Metodo privado que devuelve la ultima id del array +1
        private function getLastId() {
            $theaters = $this->theatersList;
            $id = 0;

            foreach($theaters as $theater) {
                if($id <= $theater->getId()) {
                    $id = $theater->getId();
                    $id++;
                }
            }
            return $id == 0 ? 1 : $id;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->theatersList as $theater)
            {            
                $valuesArray["id"] = $theater->getId();
                $valuesArray["name"] = $theater->getName();
                $valuesArray["address"] = $theater->getAddress();

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
            file_put_contents('Data/theaters.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/theaters.json'))
            {
                $jsonContent = file_get_contents('Data/theaters.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $theater = new Theater();

                    $theater->setId($valuesArray["id"]);
                    $theater->setName($valuesArray["name"]);
                    $theater->setAddress($valuesArray["address"]);
                    
                    array_push($this->theatersList, $theater);
                }
            }
        }
    }
