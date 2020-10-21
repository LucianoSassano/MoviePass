<?php 

    namespace Models;

        class Ticket{

            private $id;
            private $show;
            private $seat;
            private $client;
            private $date;
            private $cost;


            /**
             * Get the value of id
             */ 
            public function getId()
            {
                        return $this->id;
            }

            /**
             * Get the value of show
             */ 
            public function getShow()
            {
                        return $this->show;
            }

            /**
             * Set the value of show
             *
             * @return  self
             */ 
            public function setShow($show)
            {
                        $this->show = $show;

                        return $this;
            }

            /**
             * Get the value of seat
             */ 
            public function getSeat()
            {
                        return $this->seat;
            }

            /**
             * Set the value of seat
             *
             * @return  self
             */ 
            public function setSeat($seat)
            {
                        $this->seat = $seat;

                        return $this;
            }

            /**
             * Get the value of client
             */ 
            public function getClient()
            {
                        return $this->client;
            }

            /**
             * Set the value of client
             *
             * @return  self
             */ 
            public function setClient($client)
            {
                        $this->client = $client;

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
             * Get the value of cost
             */ 
            public function getCost()
            {
                        return $this->cost;
            }

            /**
             * Set the value of cost
             *
             * @return  self
             */ 
            public function setCost($cost)
            {
                        $this->cost = $cost;

                        return $this;
            }
        }
?>