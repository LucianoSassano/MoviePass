<?php 

    namespace Controllers;

    use DAO\PDO\UserPDO as UserDAO;
    use DAO\PDO\MoviePDO as MovieDAO;
    use DAO\PDO\GenrePDO AS GenreDAO;
    use Models\User;

    use Utils\Helper\Helper;

    class LoginController{

        private $userDAO;
        private $movieDAO;
        private $genreDAO;

        function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
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
                
                     
                        $_SESSION['loggedUser'] = $user;    // almacena el usuario en la session
                       
                        if($user->getRole()->getId() == User::ADMIN_ROLE){
                        
                            
                            
                            $movies = $this->movieDAO->getAll();
                            require_once(VIEWS_PATH . "admin.php"); // Redirecciona al sistema logueado como admin
                        }else {
                            $shows = $this->movieDAO->getMoviesDistinct();
                            $genres = $this->genreDAO->getAll();
                            require_once(VIEWS_PATH . "index.php"); // Redirecciona al sistema logueado como user
                        }
                    }else{
                        $errorMsg = "Usuario no encontrado";  // Esto se envia al login.php y se muestra 
                        require_once(VIEWS_PATH . "login.php");

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

        public function FacebookLogin(){

            $user = Helper::facebookAPI();

            $email = (string)$user['email'];
            $pass = (string)$user['id'];

            if($user){
                $this->login($email, $pass);
            }
        }

        function logout() {
            session_destroy();
            session_start();

            $shows = $this->movieDAO->getMoviesDistinct();
            $genres = $this->genreDAO->getAll();
            require_once(VIEWS_PATH . "index.php");
        }
    }
?>