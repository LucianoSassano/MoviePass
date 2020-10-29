<?php 
    namespace Models;

    class User
    {
        private $id;    
        private $email;
        private $password;
        private $role;          // 1 = Client | 2 = Admin
        private $profile;

        const CLIENT_ROLE = 1;
        const ADMIN_ROLE = 2;

        function __construct($email="", $password="")
        {
            $this->email = $email;
            $this->password = $password;
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
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }


        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
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
         * Get the value of profile
         */ 
        public function getProfile()
        {
                return $this->profile;
        }

        /**
         * Set the value of profile
         *
         * @return  self
         */ 
        public function setProfile($profile)
        {
                $this->profile = $profile;

                return $this;
        }
    }

?>