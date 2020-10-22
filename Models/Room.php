<?php 

    namespace Models;

    class Room{

        private $id;
        private $capacity;
        private $shows;


        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
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
         * Get the value of theather
         */ 
        public function getShows()
        {
                return $this->shows;
        }

        /**
         * Set the value of theather
         *
         * @return  self
         */ 
        public function setShows($shows)
        {
                $this->shows = $shows;

                return $this;
        }
    }


?>