<?php 
    namespace Models;

    class Genre_x_Movie{


        private $id;
        private $movie_id;
        private $genre_id;

      

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of movie_id
         */ 
        public function getMovie_id()
        {
                return $this->movie_id;
        }

        /**
         * Set the value of movie_id
         *
         * @return  self
         */ 
        public function setMovie_id($movie_id)
        {
                $this->movie_id = $movie_id;

                return $this;
        }

        /**
         * Get the value of genre_id
         */ 
        public function getGenre_id()
        {
                return $this->genre_id;
        }

        /**
         * Set the value of genre_id
         *
         * @return  self
         */ 
        public function setGenre_id($genre_id)
        {
                $this->genre_id = $genre_id;

                return $this;
        }
    }


?>