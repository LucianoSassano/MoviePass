<?php

namespace Controllers;

use DAO\ShowJSON as ShowDAO;
use DAO\MovieJSON as MovieDAO;
use DAO\TheaterJSON as TheaterDAO;
use Models\Show;

class ShowController
{
    private $showDAO;
    private $movieDAO;
    private $theaterDAO;

    function __construct()
    {
        $this->showDAO = new ShowDAO();
        $this->movieDAO = new MovieDAO();
        $this->theaterDAO = new TheaterDAO();
    }

    // createView -> metodo seleccionar una pelicula para el armado de un show 

    function createView($id)
    {
        $movie = $this->movieDAO->get($id);
        $theaterList = $this->theaterDAO->getAll();
        require_once(VIEWS_PATH . "show.php");
    }

    function createShow($movie_id , $theater_id){
        
        $movie = $this->movieDAO->get($movie_id);
        $theater = $this->theaterDAO->get($theater_id);
        //falta el room 
        
    }


}
