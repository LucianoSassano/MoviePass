<?php 
    namespace Models;

        class Profile{

            private $id;
            private $first_name;
            private $last_name;
            private $email;
            private $dni;
            

            /**
             * Get the value of id
             */ 
            public function getId()
            {
                        return $this->id;
            }

            /**
             * Get the value of first_name
             */ 
            public function getFirst_name()
            {
                        return $this->first_name;
            }

            /**
             * Set the value of first_name
             *
             * @return  self
             */ 
            public function setFirst_name($first_name)
            {
                        $this->first_name = $first_name;

                        return $this;
            }

            /**
             * Get the value of last_name
             */ 
            public function getLast_name()
            {
                        return $this->last_name;
            }

            /**
             * Set the value of last_name
             *
             * @return  self
             */ 
            public function setLast_name($last_name)
            {
                        $this->last_name = $last_name;

                        return $this;
            }

            /**
             * Get the value of email
             */ 
            public function getEmail()
            {
                        return $this->email;
            }

            /**
             * Set the value of email
             *
             * @return  self
             */ 
            public function setEmail($email)
            {
                        $this->email = $email;

                        return $this;
            }

            /**
             * Get the value of dni
             */ 
            public function getDni()
            {
                        return $this->dni;
            }

            /**
             * Set the value of dni
             *
             * @return  self
             */ 
            public function setDni($dni)
            {
                        $this->dni = $dni;

                        return $this;
            }

           

            /**
             * Get the value of user
             */ 
            public function getUser()
            {
                        return $this->user;
            }

            /**
             * Set the value of user
             *
             * @return  self
             */ 
            public function setUser($user)
            {
                        $this->user = $user;

                        return $this;
            }
        }


?>