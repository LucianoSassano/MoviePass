<?php 

    namespace Models;

    class Room{

        private $room_id;
        private $name;
        private $capacity;
        private $shows;
        private $theater;


        function __construct($name="", $capacity="")
        {
            $this->name = $name;
            $this->capacity = $capacity;
            $this->shows = array();
            $this->theater = "";
        }

    

        /**
         * Get the value of room_id
         */ 
        public function getRoom_id()
        {
                return $this->room_id;
        }

        /**
         * Set the value of room_id
         *
         * @return  self
         */ 
        public function setRoom_id($room_id)
        {
                $this->room_id = $room_id;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of capacity
         */ 
        public function getCapacity()
        {
                return $this->capacity;
        }

        /**
         * Set the value of capacity
         *
         * @return  self
         */ 
        public function setCapacity($capacity)
        {
                $this->capacity = $capacity;

                return $this;
        }

        /**
         * Get the value of shows
         */ 
        public function getShows()
        {
                return $this->shows;
        }

        /**
         * Set the value of shows
         *
         * @return  self
         */ 
        public function setShows($shows)
        {
                $this->shows = $shows;

                return $this;
        }

        /**
         * Get the value of theater
         */ 
        public function getTheater()
        {
                return $this->theater;
        }

        /**
         * Set the value of theater
         *
         * @return  self
         */ 
        public function setTheater($theater)
        {
                $this->theater = $theater;

                return $this;
        }
    }


?>