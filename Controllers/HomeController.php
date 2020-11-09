<?php 
namespace Controllers;

    use DAO\PDO\GenrePDO as GenreDAO;
    use DAO\PDO\ShowPDO as ShowDAO;
    use DAO\PDO\MoviePDO as MovieDAO;

    class HomeController{

        private $showDAO;
        private $genreDAO;
        private $movieDAO;

        function __construct()
        {
            $this->showDAO = new ShowDAO();
            $this->genreDAO = new GenreDAO();
            $this->movieDAO = new MovieDAO();
        }
    

       public function index(){
           
            $shows = $this->movieDAO->getMoviesDistinct();
            //var_dump($shows);
            $genres = $this->genreDAO->getAll();
            require_once(VIEWS_PATH . "index.php");

        }

        public function reserve($show_id){
            $show = $this->showDAO->get($show_id);

        }
    }


?>