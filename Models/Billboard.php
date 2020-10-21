<?php 
    namespace Models;

    class Billboard{

        private $Movies = [];

        /**
         * Get the value of Movies
         */ 
        public function getMovies()
        {
                return $this->Movies;
        }

        /**
         * Set the value of Movies
         */ 
        public function setMovies($Movies)
        {
                $this->Movies = $Movies;

                return $this;
        }
    }

?>