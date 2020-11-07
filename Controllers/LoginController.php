<?php 

    namespace Controllers;

    use DAO\PDO\UserPDO as UserDAO;
    use DAO\JSON\MovieJSON as MovieDAO;
    use Models\User;

    class LoginController{

        private $userDAO;
        private $movieDAO;

        function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->movieDAO = new MovieDAO();
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
               
                if($user){  // Si el usuario existe
                    
                    // Verificar password
                    if($user->getPassword() == $password) {
                        $pass = "entro en pass";
                     
                        $_SESSION['loggedUser'] = $user;    // almacena el usuario en la session

                        if($user->getRole()->getId() == User::ADMIN_ROLE){
                            $prole = "role de admin entro";
                            
                            $movies = $this->movieDAO->getAll();
                            require_once(VIEWS_PATH . "admin.php"); // Redirecciona al sistema logueado como admin
                        } else {
                            require_once(VIEWS_PATH . "index.php"); // Redirecciona al sistema logueado como user
                        }
                    }
                }else {
                    $errorMsg = "Usuario no encontrado";  // Esto se envia al login.php y se muestra 
                    require_once(VIEWS_PATH . "login.php");
                }
               
            }else {
                $errorMsg = "Datos invalidos";  // Esto se envia al login.php y se muestra 
                require_once(VIEWS_PATH . "login.php");
            }            
        }

        function logout() {
            session_destroy();
            session_start();
            require_once(VIEWS_PATH . "index.php");
        }
    }


?>