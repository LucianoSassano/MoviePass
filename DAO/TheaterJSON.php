<?php 

    namespace DAO;

    use Models\Theater;
    use Models\Room;
    use DAO\RoomJSON as RoomDAO;

    class TheaterJSON {

        private $theatersList = array();
        private $fileName;
        private $roomDAO;

        public function __construct() {
            $this->fileName = ROOT . "Data/theaters.json";
        }

        /**
         * Get by id
         */
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

        /**
         * Get all theaters
         */
        public function getAll() {
            $this->RetrieveData();
            return $this->theatersList;
        }

        /**
         * Get by address
         */
        public function getByAddress($address){
            $this->RetrieveData();
            $theaterFound = null;
            
            if(!empty($this->theaterList)){
                foreach($this->theaterList as $theater){
                    if($theater->getAddress() == $address){
                        $theaterFound = $theater; 
                    }
                }
            }
            return $theaterFound;
        }

        /**
         * Edit theater
         */
        public function edit(Theater $theater) {
            $this->RetrieveData();
            foreach($this->theatersList as $t) {
                if($t->getId() == $theater->getId()) {
                    $t->setName($theater->getName());
                    $t->setAddress($theater->getAddress());
                }
            }
            $this->SaveData();
        }

        /**
         * Remove by id
         */
        public function remove($id) {
            $this->RetrieveData();

            foreach($this->theatersList as $theater) {
                if($theater->getId() == $id) {
                    $key = array_search($theater, $this->theatersList);
                    unset($this->theatersList[$key]);
                }
            }
        }

        /**
         * Add new theater
         */
        public function add(Theater $theater) {
            $this->RetrieveData();

            $theater->setId($this->getLastId());
            $theater->setRooms(array());        // seteo los rooms como un array vacio
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

        /**
         * Add a room to the theater
         */
        public function addRoom($theater_id, $room) {
            $this->RetrieveData();

            foreach($this->theatersList as $theater) {
                if($theater->getId() == $theater_id) {
                    $rooms = $theater->getRooms();
                    array_push($rooms, $room);
                    $theater->setRooms($rooms);
                }
            }
            $this->SaveData();
        }

        /**
         * JSON methods
         */
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->theatersList as $theater)
            {            
                $valuesArray["id"] = $theater->getId();
                $valuesArray["name"] = $theater->getName();
                $valuesArray["address"] = $theater->getAddress();
                $valuesArray["rooms"] = $this->getRoomIdList($theater->getRooms());

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
            file_put_contents('Data/theaters.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->theatersList = array();

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

                    $rooms = $this->getRoomList($valuesArray["rooms"]);

                    $theater->setRooms($rooms);
                    
                    array_push($this->theatersList, $theater);
                }
            }
        }

        /**
         * Get rooms from theater
         */
        private function getRoomList($rooms = array()) {

            //print_r($rooms);

            $this->roomDAO = new RoomDAO(); // instancio el dao de rooms

            $roomObjs = $this->roomDAO->getRoomList($rooms);   // $rooms es un array con las id de los room que le corresponden al cine
            
            // retrona el arreglo cargado con los obj room
            return $roomObjs;
        }

        /**
         * Get an array of id's from an array of Rooms
         */
        public function getRoomIdList($rooms = array()) {

            $roomsIdsList = array();
            foreach($rooms as $room) {
                array_push($roomsIdsList, $room->getId());
            }

            return $roomsIdsList;
        }
    }

?>
