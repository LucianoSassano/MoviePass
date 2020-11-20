<?php

namespace Controllers;

use DAO\PDO\MoviePDO as MovieDAO;
use DAO\PDO\TheaterPDO as TheaterDAO;
use DAO\PDO\GenrePDO as GenreDAO;

class AdminController
{

    private $movieDAO;
    private $theaterDAO;
    private $genreDAO;

    function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->theaterDAO = new TheaterDAO;
        $this->genreDAO = new GenreDAO();
       
    }

    function dashboard()
    {
        $movies = $this->movieDAO->getAll();
        
        require_once(VIEWS_PATH . "admin.php");
    }

    function profitAnalytics(){
        
        $theaters = $this->theaterDAO->getAll();
        require_once(VIEWS_PATH . "admin-analytics.php");
    }

    function ticketsAnalytics(){
        
        $theaters = $this->theaterDAO->getAll();
        require_once(VIEWS_PATH . "tickets-analytics.php");
    }

    function showAnalytics(){
        
        $theaters = $this->theaterDAO->getAll();
        require_once(VIEWS_PATH . "show-analytics.php");
    }

    function showTheaterAnalytics($theater_id){

        $shows = $this->movieDAO->getMoviesDistinctSingleTheater($theater_id);
        $genres = $this->genreDAO->getAll();
        require_once(VIEWS_PATH . "show-movie-analytics.php");
    }

    function getSingleShowRatio($movie_id, $theater_id){
  
        $movie_id = (int)$movie_id;
        $theater_id = (int)$theater_id;
        
        $theaterName = $this->theaterDAO->get($theater_id)->getName();
        

        $theaters = $this->theaterDAO->getByMovie($movie_id);
        $movie = $this->movieDAO->get($movie_id);;
    
        
        require_once(VIEWS_PATH . "movie-selection-analytics.php");
    }
    
}
