<?php
    namespace Models;

    class Movie{
        
        private $movie_id;
        private $title;
        private $overview;
        private $poster_path;
        private $language;
        private $adult;
        private $vote_average;
        private $genres = [];
        private $duration;

       

        /**
         * Get the value of movie_id
         */ 
        public function getId()
        {
                return $this->movie_id;
        }

        /**
         * Set the value of movie_id
         *
         * @return  self
         */ 
        public function setId($movie_id)
        {
                $this->movie_id = $movie_id;

                return $this;
        }

        

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of overview
         */ 
        public function getOverview()
        {
                return $this->overview;
        }

        /**
         * Set the value of overview
         *
         * @return  self
         */ 
        public function setOverview($overview)
        {
                $this->overview = $overview;

                return $this;
        }

        /**
         * Get the value of poster_path
         */ 
        public function getPoster_path()
        {
                return $this->poster_path;
        }

        /**
         * Set the value of poster_path
         *
         * @return  self
         */ 
        public function setPoster_path($poster_path)
        {
                $this->poster_path = $poster_path;

                return $this;
        }

        /**
         * Get the value of language
         */ 
        public function getLanguage()
        {
                return $this->language;
        }

        /**
         * Set the value of language
         *
         * @return  self
         */ 
        public function setLanguage($language)
        {
                $this->language = $language;

                return $this;
        }

        /**
         * Get the value of adult
         */ 
        public function getAdult()
        {
                return $this->adult;
        }

        /**
         * Set the value of adult
         *
         * @return  self
         */ 
        public function setAdult($adult)
        {
                $this->adult = $adult;

                return $this;
        }

        /**
         * Get the value of vote_average
         */ 
        public function getVote_average()
        {
                return $this->vote_average;
        }

        /**
         * Set the value of vote_average
         *
         * @return  self
         */ 
        public function setVote_average($vote_average)
        {
                $this->vote_average = $vote_average;

                return $this;
        }

        /**
         * Get the value of genres
         */ 
        public function getGenres()
        {
                return $this->genres;
        }

        /**
         * Set the value of genres
         *
         * @return  self
         */ 
        public function setGenres($genres)
        {
                $this->genres = $genres;

                return $this;
        }

        


 

        /**
         * Get the value of duration
         */ 
        public function getDuration()
        {
                return $this->duration;
        }

        /**
         * Set the value of duration
         *
         * @return  self
         */ 
        public function setDuration($duration)
        {
                $this->duration = $duration;

                return $this;
        }
    }



?>