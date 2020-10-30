<?php 

    namespace Controllers;

    use Models\User;
    use DAO\PDO\UserPDO as UserDAO;
    use DAO\PDO\ProfilePDO as ProfileDAO;
    use Models\Profile;
    use Models\Role;

class UserController {

        private $userDAO;

        public function __construct() {
            $this->userDAO = new UserDAO();
            $this->profileDAO = new ProfileDAO();
        }

        /**
         * Create methods
         */

        public function create($email, $password) {
            // Valido la data
            if($email && $password) {
                if($this->validate($email)){
                    $user = new User($email, $password);
                    $role = new Role(2,"Client");
                    $user->setRole($role); // Seteo como cliente de manera predeterminada

                    $this->userDAO->add($user);

                    // Falta designar la session ( $_SESSION["loggedUser"] = $user )
                    
                    $user_email = $email;
                    require_once(VIEWS_PATH . "profile-creation.php");    // Aca tendria que redireccionar adentro ya logueado

                }else {
                    $errorMsg = "El email ya se encuentra en uso";  // Esto se envia al signup.php y se muestra 
                    require_once(VIEWS_PATH . "signup.php");
                }
            }else {
                $errorMsg = "Complete todos los campos";  // Esto se envia al signup.php y se muestra 
                require_once(VIEWS_PATH . "signup.php");
            } 
        }

        public function validate($email){
            return $this->userDAO->getByEmail($email) ? false : true;
        }

        public function setProfile($first_name, $last_name, $dni,$user_email){

            if($user_email) 
            {   

                $user = $this->userDAO->getByEmailNoProfile($user_email);
               
                $user_id = $user->getId();
                $profile = new Profile($first_name, $last_name, $dni);

                $this->profileDAO->add($profile, $user_id);

                require_once(VIEWS_PATH . "index.php");
            }
            else{
                $errorMsg = "El email ya se encuentra en uso";  // Esto se envia al profile-creation.php y se muestra 
                require_once(VIEWS_PATH . "profile-creation.php");
            }
        }
    }


?>