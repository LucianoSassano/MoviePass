<?php 

    namespace DAO\JSON;

    use Models\Room;
    use DAO\JSON\ShowJSON as ShowDAO;

    class RoomJSON {

        private $roomsList = array();
        private $fileName;
        private $showDAO;

        public function __construct() {
            $this->fileName = ROOT . "Data/rooms.json";
        }

        /**
         * Get by id
         */
        public function get($id) {

            $this->RetrieveData();
            $founded = null;

            foreach($this->roomsList as $room) {
                if($room->getId() == $id) {
                    $founded = $room;
                }
            }
            return $founded;
        }

        /**
         * Get all rooms
         */
        public function getAll() {
            $this->RetrieveData();
            return $this->roomsList;
        }

        /**
         * Get by array of id's
         */
        public function getRoomList($rooms = array()) {

            $roomList = array();

            if(!empty($rooms)) {
                foreach($rooms as $id) {
                    array_push($roomList, $this->get($id));
                }
            }
            return $roomList;
        }

        /**
         * Edit room
         */
        public function edit(Room $room) {

            $this->RetrieveData();

            foreach($this->roomsList as $r) {
                if($r->getId() == $room->getId()) {
                    $r->setCapacity($room->getCapacity());
                    $r->setShows($room->getShows());
                }
            }
            $this->SaveData();
        }

        /**
         * Remove room by id
         */
        public function remove($id) {

            $this->RetrieveData();

            foreach($this->roomsList as $room) {
                if($room->getId() == $id) {
                    $key = array_search($room, $this->roomsList);
                    unset($this->roomsList[$key]);
                }
            }
        }

        /**
         * Add a new room
         */
        public function add(Room $room) {

            $this->RetrieveData();

            $room->setId($this->getLastId());
            array_push($this->roomsList, $room);

            $this->SaveData();
            
            // Retorna el room con el id seteado
            return $room;
        }

        // Metodo privado que devuelve la ultima id del array +1
        private function getLastId() {
            $rooms = $this->roomsList;
            $id = 0;

            foreach($rooms as $room) {
                if($id <= $room->getId()) {
                    $id = $room->getId();
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

            foreach($this->roomsList as $room)
            {            
                $valuesArray["id"] = $room->getId();
                $valuesArray["name"] = $room->getName();
                $valuesArray["capacity"] = $room->getCapacity();
                $valuesArray["shows"] = $room->getShows();

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
            file_put_contents('Data/rooms.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->roomsList = array();

            if(file_exists('Data/rooms.json'))
            {
                $jsonContent = file_get_contents('Data/rooms.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $room = new Room();

                    $room->setId($valuesArray["id"]);
                    $room->setName($valuesArray["name"]);
                    $room->setCapacity($valuesArray["capacity"]);

                    $shows = $this->getShowList($valuesArray["shows"]);

                    $room->setShows($shows);
                    
                    array_push($this->roomsList, $room);
                }
            }
        }

        /**
         * Get shows from theater
         */
        private function getShowList($shows = array()) {

            $this->showDAO = new ShowDAO(); // instancio el dao de rooms

            $showObjs = $this->showDAO->getShowList($shows);   // $rooms es un array con las id de los room que le corresponden al cine

            return $showObjs;
        }

        /**
         * Get an array of id's from an array of Shows
         */
        public function getShowIdList($shows = array()) {

            $showsIdsList = array();
            foreach($shows as $show) {
                array_push($showsIdsList, $show->getId());
            }

            return $showsIdsList;
        }
    }

?>