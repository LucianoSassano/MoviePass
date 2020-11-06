<?php 
namespace Controllers;




    use DAO\PDO\GenrePDO as GenreDAO;
    use DAO\PDO\ShowPDO as ShowDAO;

    
    

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

        public function reserve($show_id){
            $show = $this->showDAO->get($show_id);

        }
    }


?>