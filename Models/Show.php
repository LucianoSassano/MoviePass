<?php 

    namespace Models;

        class Show{

            private $id;
            private $room;
            private $movie;
            private $date;


            /**
             * Get the value of id
             */ 
            public function getId()
            {
                        return $this->id;
            }

            /**
             * Get the value of room
             */ 
            public function getRoom()
            {
                        return $this->room;
            }

            /**
             * Set the value of room
             *
             * @return  self
             */ 
            public function setRoom($room)
            {
                        $this->room = $room;

                        return $this;
            }

            /**
             * Get the value of movie
             */ 
            public function getMovie()
            {
                        return $this->movie;
            }

            /**
             * Set the value of movie
             *
             * @return  self
             */ 
            public function setMovie($movie)
            {
                        $this->movie = $movie;

                        return $this;
            }

            /**
             * Get the value of date
             */ 
            public function getDate()
            {
                        return $this->date;
            }

            /**
             * Set the value of date
             *
             * @return  self
             */ 
            public function setDate($date)
            {
                        $this->date = $date;

                        return $this;
            }
        }



?>