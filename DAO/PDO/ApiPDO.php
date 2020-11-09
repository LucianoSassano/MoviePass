<?php 

    namespace DAO\PDO;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    use DAO\PDO\MoviePDO as MovieDAO;
    use DAO\PDO\GenrePDO as GenreDAO;


    define("API_KEY","5c5b380ac89e5a3c6c206ccd2adda7f3");

    class ApiPDO {

        private $movieDAO;
        private $genreDAO;

        function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
        }


         // Metodo privado que devuelve array de peliculas populares de la api
         public function getTopMovies() {

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

                $urlDetails = "https://api.themoviedb.org/3/movie/". $movie['id'] ."?api_key=" . API_KEY;
                $resultsDetails = file_get_contents($urlDetails);
                $resultJSONDetails = json_decode($resultsDetails, true);
                $movieDetails = array();
                
                $newMovie->setDuration($resultJSONDetails['runtime']);

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