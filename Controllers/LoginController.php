<?php 

    namespace Controllers;

    use DAO\UserJSON as UserDAO;

    class LoginController{

        private $userDAO;

        function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function index(){
            require_once(VIEWS_PATH . "login.php");
        }

        public function signup(){
            require_once(VIEWS_PATH . "signup.php");
        }

        function login($email, $password)
        {
            // Valido que venga data
            if($email && $password) {

                $user = $this->userDAO->getByEmail($email);
               

                // Verificar password
                if($user->getPassword() == $password) {
                    $_SESSION['loggedUser'] = $user;
                    var_dump($_SESSION['loggedUser']->getRole());
                    if($_SESSION['loggedUser']->getRole() == 2){
                        require_once(VIEWS_PATH . "admin.php"); // Deberia redireccionar al sistema logueado
                    }
                    if($_SESSION['loggedUser']->getRole() == 1){
                        {
                            require_once(VIEWS_PATH . "index.php"); // Deberia redireccionar al sistema logueado
                        }
                    }
                }
                
            } else {
                $errorMsg = "Datos invalidos";  // Esto se envia al login.php y se muestra 
                require_once(VIEWS_PATH . "login.php");
            }            
        }
    }


?>