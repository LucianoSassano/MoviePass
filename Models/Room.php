<?php 

    namespace Models;

    class Room{

        private $id;
        private $name;
        private $capacity;
        private $shows;


        function __construct($name="", $capacity="")
        {
            $this->name = $name;
            $this->capacity = $capacity;
            $this->shows = array();
        }

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

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

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
    }


?>