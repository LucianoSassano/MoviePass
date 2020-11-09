<?php 

    namespace Models;

    class Theater{

        private $theater_id;
        private $name;
        private $address;
        private $rooms;


        function __construct($theater_id="",$name="", $address="")
        {
            $this->theater_id = $theater_id;
            $this->name = $name;
            $this->address = $address;
            $this->rooms = array();
        }

        
        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($theater_id)
        {
                $this->theater_id = $theater_id;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->theater_id;
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
         * Get the value of address
         */ 
        public function getAddress()
        {
                return $this->address;
        }

        /**
         * Set the value of address
         *
         * @return  self
         */ 
        public function setAddress($address)
        {
                $this->address = $address;

                return $this;
        }

        /**
         * Get the value of rooms
         */ 
        public function getRooms()
        {
                return $this->rooms;
        }

        /**
         * Set the value of rooms
         *
         * @return  self
         */ 
        public function setRooms($rooms)
        {
                $this->rooms = $rooms;

                return $this;
        }
    }
