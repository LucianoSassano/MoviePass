<?php 

    namespace Models;

        class Show{

            private $id;
            private $movie;
            private $date;
            private $price;
            private $startTime;
            private $endTime;
            private $room;
            private $theater;

            function __construct($date="", $price="")
        {
            $this->date = $date;
            $this->price = $price;
            $this->movie = "";
            $this->startTime = "";
            $this->endTime = "";
            $this->room = "";
            $this->theater = "";
            
    
        }

            /**
             * Get the value of id
             */ 
            public function getId()
            {
                        return $this->id;
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

            

            /**
             * Get the value of price
             */ 
            public function getPrice()
            {
                        return $this->price;
            }

            /**
             * Set the value of price
             *
             * @return  self
             */ 
            public function setPrice($price)
            {
                        $this->price = $price;

                        return $this;
            }


            /**
             * Get the value of endTime
             */ 
            public function getEndTime()
            {
                        return $this->endTime;
            }

            /**
             * Set the value of endTime
             *
             * @return  self
             */ 
            public function setEndTime($endTime)
            {
                        $this->endTime = $endTime;

                        return $this;
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
             * Get the value of startTime
             */ 
            public function getStartTime()
            {
                        return $this->startTime;
            }

            /**
             * Set the value of startTime
             *
             * @return  self
             */ 
            public function setStartTime($startTime)
            {
                        $this->startTime = $startTime;

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