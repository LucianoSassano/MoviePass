<?php 

    namespace DAO;

    use Models\User;

    class UserJSON {

        private $userList = array();
        private $fileName;

        public function __construct() {
            $this->fileName = ROOT . "Data/users.json";
        }

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

        public function add(User $user) {
            $this->RetrieveData();
            array_push($this->userList, $user);
            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {            
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

                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);

                    array_push($this->userList, $user);
                }
            }
        }
    }

?>