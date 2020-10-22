<?php 

    namespace Controllers;

    use Models\User;
    use DAO\UserJSON as UserDAO;

    class UserController {

        private $userDAO;

        public function __construct() {
            $this->userDAO = new UserDAO();
        }

        /**
         * Create methods
         */

        public function create($email, $password) {
            // Valido la data
            if($email && $password) {
                if($this->validate($email)){
                    $user = new User($email, $password);
                    $user->setRole(User::CLIENT_ROLE); // Seteo como cliente de manera predeterminada

                    $this->userDAO->add($user);

                    // Falta designar la session ( $_SESSION["loggedUser"] = $user )
                    require_once(VIEWS_PATH . "signup.php");    // Aca tendria que redireccionar adentro ya logueado

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
    }


?>