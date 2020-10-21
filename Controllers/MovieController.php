<?php 
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    use DAO\MovieJSON as MovieDAO;

    define("API_KEY","5c5b380ac89e5a3c6c206ccd2adda7f3");
    
    class MovieController{

        private $movieDAO;

        function __construct()
        {
            $this->movieDAO = new MovieDAO();
        }

        public function updateAll() {

            // Trae peliculas de la API (array)
            $moviesArray = $this->getTopMovies();
            $movies = array();

            if($moviesArray) {
                $movies = $this->movieDAO->updateAll($moviesArray);
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
                $newMovie->setTitle($movie['original_title']);
                $newMovie->setOverview($movie['overview']);
                $newMovie->setPoster_path($movie['poster_path']);
                $newMovie->setLanguage($movie['original_language']);
                $newMovie->setAdult($movie['adult']);
                $newMovie->setVote_average($movie['vote_count']);

                // Setea un arreglo con las ids de los generos  |   Cambiar por listado de Obj Genre
                $newMovie->setGenres($movie['genre_ids']);

                array_push($movieList, $newMovie);
            }
            return $movieList;
        }

        // public function getPopular(){

        //     $url="https://api.themoviedb.org/3/movie/popular?api_key= " . API_KEY;
        //     $api_result = file_get_contents($url);
        //     $result_in_string = json_decode($api_result,true);
        //     $movies = array();

        //     foreach($result_in_string['results'] as $movie){
        //         $newMovie = new Movie();
        //         $newMovie->setTitle($movie['title']);
        //         $newMovie->setOverview($movie['overview']);
        //         $newMovie->setPoster_path($movie['poster_path']);
        //         $newMovie->setLanguage($movie['language']);
        //         $newMovie->setAdult($movie['adult']);
        //         $newMovie->setVote_average($movie['vote_average']);
        //         $genres = $movie['genre_ids'];
        //         $newMovie->setGenres($this->getGenre($genres));
        //         array_push($movies,$newMovie);
                

        //     }

        //     return $movies;

        // }

        public function getGenre($genreId){

            $url="https://api.themoviedb.org/3/genre/movie/list?api_key= " . API_KEY;
            $genres_raw = file_get_contents($url);
            $result_in_string = json_decode($genres_raw,true);
            $genres = array();

            foreach($genres as $genre){
                foreach($result_in_string as $result){
                    foreach($result as $genre_from_api){
                        if($genre == $genre_from_api['id']){
                            $newGenre = new Genre();
                            $newGenre->setDescription($genre_from_api['name']);
                            array_push($genres,$newGenre);
                        }
                    }
                }



            }

            return $genres;


        }




     }


?>