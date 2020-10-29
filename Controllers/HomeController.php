<?php 
namespace Controllers;




    use DAO\JSON\GenreJSON as GenreDAO;
    use DAO\JSON\ShowJSON as ShowDAO;

    
    

    class HomeController{

        private $showDAO;
        private $genreDAO;

        function __construct()
        {
            $this->showDAO = new ShowDAO();
            $this->genreDAO = new GenreDAO();
        }
    

       public function index(){
           
            $shows = $this->showDAO->getAll();
            $genres = $this->genreDAO->getAll();
            require_once(VIEWS_PATH . "index.php");

        }
    }


?>