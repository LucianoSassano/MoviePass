<?php 

    namespace Models;

    class Purchase{

        private $purchase_id;
        private $userEmail;
        private $theater;
        private $date;
        private $tickets;
        private $totalCost;


        function __construct($userEmail , $theater, $date, $tickets, $totalCost)
        {
         
            $this->userEmail = $userEmail;
            $this->theater = $theater;
            $this->date = $date;
            $this->tickets = $tickets;
            $this->totalCost = $totalCost;
            
        }




          /**
         * Get the value of purchase_id
         */ 
        public function getPurchase_id()
        {
                return $this->purchase_id;
        }

        /**
         * Set the value of purchase_id
         *
         * @return  self
         */ 
        public function setPurchase_id($purchase_id)
        {
                $this->purchase_id = $purchase_id;

                return $this;
        }
        


        /**
         * Get the value of userEmail
         */ 
        public function getUserEmail()
        {
                return $this->userEmail;
        }

        /**
         * Set the value of userEmail
         *
         * @return  self
         */ 
        public function setUserEmail($userEmail)
        {
                $this->userEmail = $userEmail;

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
         * Get the value of tickets
         */ 
        public function getTickets()
        {
                return $this->tickets;
        }

        /**
         * Set the value of tickets
         *
         * @return  self
         */ 
        public function setTickets($tickets)
        {
                $this->tickets = $tickets;

                return $this;
        }

        /**
         * Get the value of totalCost
         */ 
        public function getTotalCost()
        {
                return $this->totalCost;
        }

        /**
         * Set the value of totalCost
         *
         * @return  self
         */ 
        public function setTotalCost($totalCost)
        {
                $this->totalCost = $totalCost;

                return $this;
        }

    }




?>