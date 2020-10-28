<?php 

    namespace DAO;

    use Models\User;

    class UserJSON {

        private $userList = array();
        private $fileName;

        public function __construct() {
            $this->fileName = ROOT . "Data/users.json";
        }

        /**
         * Get by id
         */
        public function get($id) {

            $this->RetrieveData();
            $founded = null;

            foreach($this->userList as $user) {
                if($user->getId() == $id) {
                    $founded = $user;
                }
            }
            return $founded;
        }

        /**
         * Get by email
         */
        public function getByEmail($email){
            $this->RetrieveData();
            $userFounded = null;
            
            if(!empty($this->userList)){
                foreach($this->userList as $user){
                    if($user->getEmail() == $email){
                        $userFounded = $user; 
                    }
                }
            }
            return $userFounded;
        }

        /**
         * Add new user
         */
        public function add(User $user) {

            $this->RetrieveData();

            $user->setId($this->getLastId());
            array_push($this->userList, $user);

            $this->SaveData();

            // Retorna el user con el id seteado
            return $user;
        }

        // Metodo privado que devuelve la ultima id del array +1
        private function getLastId() {
            $users = $this->userList;
            $id = 0;

            foreach($users as $user) {
                if($id <= $user->getId()) {
                    $id = $user->getId();
                    $id++;
                }
            }
            return $id == 0 ? 1 : $id;  // Si no hay ninguno creado, arranca con el id 1
        }

        /**
         * JSON methods
         */
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {            
                $valuesArray["id"] = $user->getId();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["role"] = $user->getRole();

                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
            file_put_contents('Data/users.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();

                    $user->setId($valuesArray["id"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);
                    $user->setRole($valuesArray["role"]);

                    array_push($this->userList, $user);
                }
            }
        }
    }

?>