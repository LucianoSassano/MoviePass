<?php 

    namespace Models;

use DateTime;

class Ticket{

            private $id;
            private $show;
            private $seat_number;
            private $client;
            private $date;
            private $cost;

            function __construct($seat_number, $cost)
            {

                
                $this->seat_number = $seat_number;
                $this->date = (new DateTime('now'))->format('Y-m-d H:i:s'); ;
                $this->cost = $cost;
                $this->show = "";
                $this->client = "";
                
                
            }


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

            /**
             * Get the value of seat_number
             */ 
            public function getSeat_number()
            {
                        return $this->seat_number;
            }

            /**
             * Set the value of seat_number
             *
             * @return  self
             */ 
            public function setSeat_number($seat_number)
            {
                        $this->seat_number = $seat_number;

                        return $this;
            }
        }
?>