<?php 
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    use DAO\JSON\MovieJSON as MovieDAO;
    use DAO\PDO\GenrePDO as GenreDAO;

    define("API_KEY","5c5b380ac89e5a3c6c206ccd2adda7f3");
    
    class MovieController{

        private $movieDAO;
        private $genreDAO;

        function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
        }


        public function getAll() {
            $movies = $this->movieDAO->getAll();
            require_once(VIEWS_PATH . "admin.php");
        }

        public function updateAll() {

            // Trae peliculas de la API (array)
            $moviesArray = $this->getTopMovies();
            $genresArray = $this->getGenres();
            $movies = array();

            if($moviesArray && $genresArray) {

                $genres = $this->genreDAO->updateAll($genresArray);

                if(!empty($genres)) {   // Valido que se actualicen los generos
                    $movies = $this->movieDAO->updateAll($moviesArray);
                }
            }
            require_once(VIEWS_PATH . "admin.php");
        }

        // Metodo privado que devuelve array de peliculas populares de la api
        private function getTopMovies() {

            $url = "https://api.themoviedb.org/3/movie/popular?api_key=" . API_KEY;
            $results = file_get_contents($url);
            $resultJSON = json_decode($results, true);
            $movieList = array();

            foreach($resultJSON['results'] as $movie) {
                $newMovie = new Movie();
                $newMovie->setId($movie['id']);
                $newMovie->setTitle($movie['original_title']);
                $newMovie->setOverview($movie['overview']);
                $newMovie->setPoster_path($movie['poster_path']);
                $newMovie->setLanguage($movie['original_language']);
                $newMovie->setAdult($movie['adult']);
                $newMovie->setVote_average($movie['vote_count']);

                // Convierte el array de ids de generos en array de obj genero
                $genres = $this->movieDAO->getGenreList($movie["genre_ids"]);

                $newMovie->setGenres($genres);


                array_push($movieList, $newMovie);
            }
            return $movieList;
        }

        public function getGenres(){

            $url="https://api.themoviedb.org/3/genre/movie/list?api_key=" . API_KEY;
            $results = file_get_contents($url);
            $resultJSON = json_decode($results,true);
            $genreList = array();

            foreach($resultJSON['genres'] as $genre){
                $newGenre = new Genre();
                $newGenre->setId($genre['id']);
                $newGenre->setName($genre['name']);

                array_push($genreList, $newGenre);
            }

            return $genreList;
        }




     }


?>