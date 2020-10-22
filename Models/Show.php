<?php 

    namespace Models;

        class Show{

            private $id;
            private $movie;
            private $date;
            private $time;
            private $price;

            function __construct($date="", $time="", $price="")
        {
            $this->date = $date;
            $this->time = $time;
            $this->price = $price;
            $this->movie = "";
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
             * Get the value of time
             */ 
            public function getTime()
            {
                        return $this->time;
            }

            /**
             * Set the value of time
             *
             * @return  self
             */ 
            public function setTime($time)
            {
                        $this->time = $time;

                        return $this;
            }
        }



?>