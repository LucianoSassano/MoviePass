<?php 
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    use DAO\PDO\MoviePDO as MovieDAO;
    use DAO\PDO\GenrePDO as GenreDAO;
    use DAO\PDO\ApiPDO as ApiDAO;
    
    class MovieController{

        private $movieDAO;
        private $genreDAO;

        function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
            $this->apiDAO = new ApiDAO();
        }


        public function getAll() {
            $movies = $this->movieDAO->getAll();
            require_once(VIEWS_PATH . "admin.php");
        }

        public function updateAll() {

            // Trae peliculas de la API (array)
            $moviesArray = $this->apiDAO->getTopMovies();
            $genresArray = $this->apiDAO->getGenres();
            $movies = array();

            if($moviesArray && $genresArray) {

                $genres = $this->genreDAO->updateAll($genresArray);

                if(!empty($genres)) {   // Valido que se actualicen los generos
                    $movies = $this->movieDAO->updateAll($moviesArray);
                    if(!empty($moviesArray)){
                        echo "<script>alert('Movies Updated!');</script>";
                    }
                }
            }
            require_once(VIEWS_PATH . "admin.php");
        }

        function searchMovie($movie_name){

            $movie_name = strtolower($movie_name);
            $moviesInDb = $this->movieDAO->getAll();
            

            foreach($moviesInDb as $movieDb){
                $movieDbName = strtolower($movieDb->getTitle());
                if($movie_name == $movieDbName){

                    $movie = $movieDb;
                    require_once(VIEWS_PATH . "search-results.php");
                }
            }
            $errorMsg = 'No movies match the input ' . $movie_name .";"; 
            require_once(VIEWS_PATH . "search-results.php");
        }





     }


?>