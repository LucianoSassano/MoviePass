<?php 
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    use DAO\PDO\MoviePDO as MovieDAO;
    use DAO\PDO\GenrePDO as GenreDAO;
    use DAO\PDO\ApiPDO as ApiDAO;
    use DAO\PDO\TheaterPDO as TheaterDAO;
    
    class MovieController{

        private $movieDAO;
        private $genreDAO;
        private $apiDAO;

        function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
            $this->apiDAO = new ApiDAO();
        }

        /**
         * Get theaters, with rooms, with shows from movie
         */
        public function getShows($movie_id) {

            $theatersDAO = new TheaterDAO();

            $theaters = $theatersDAO->getByMovie($movie_id);

            $movie = $this->movieDAO->get($movie_id);

            require_once(VIEWS_PATH . "movie-shows.php");
        }


        public function getAll() {
            $movies = $this->movieDAO->getAll();
            require_once(VIEWS_PATH . "movies.php");
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