<?php 

    namespace Controllers;

    use DAO\MovieJSON as MovieDAO;
    use DAO\TheaterJSON as TheaterDao;
use Models\Theater;

class AdminController{

        private $movieDAO;
        private $theaterDao;

        function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->theaterDao = new TheaterDAO();
        }

        function dashboard(){
            $movies = $this->movieDAO->getAll();
            require_once(VIEWS_PATH . "admin.php");
        }

        function showTheaters(){
            $theaters = $this->theaterDao->getAll();
            require_once(VIEWS_PATH . "theaters.php");
        }

        function createTheater($name,$address){
            if($name && $address){
                if($this->validate($address)){
                    $theater = new Theater($name, $address);

                    $this->theaterDao->add($theater);
                    require_once(VIEWS_PATH . "theaters.php");    // Aca tendria que redireccionar a el listado de cines 

                }else {
                    $errorMsg = "Theater already exists";  // Esto se envia al signup.php y se muestra 
                    require_once(VIEWS_PATH . "creation.php");
                }

            }
        }
        public function validate($address){
            return $this->theaterDao->getByAddress($address) ? false : true;
        }

        function createTheaterForm(){
            require_once(VIEWS_PATH . "creation.php");
        }

        function createShow(){
            require_once(VIEWS_PATH . "show.php");

        }
    }
