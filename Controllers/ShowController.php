<?php

namespace Controllers;

use DAO\ShowJSON as ShowDAO;
use DAO\MovieJSON as MovieDAO;
use DAO\TheaterJSON as TheaterDAO;
use DAO\RoomJSON as RoomDAO;
use Models\Show;

class ShowController
{
    private $showDAO;
    private $movieDAO;
    private $theaterDAO;
    private $roomDAO;

    function __construct()
    {
        $this->showDAO = new ShowDAO();
        $this->movieDAO = new MovieDAO();
        $this->theaterDAO = new TheaterDAO();
        $this->roomDAO = new RoomDAO();
    }

    // createView -> metodo seleccionar una pelicula para el armado de un show 

    function createView($id)
    {
        $movie = $this->movieDAO->get($id);
        $theaterList = $this->theaterDAO->getAll();
        require_once(VIEWS_PATH . "show.php");
    }

    function chooseRoom($theater_id, $movie_id) {
        $theater = $this->theaterDAO->get($theater_id);
        $movie_id = $movie_id;
        require_once(VIEWS_PATH . "chooseRoom.php");
    }

    function create($movie_id , $room_id){

        $movie = $this->movieDAO->get($movie_id);
        $room = $this->roomDAO->get($room_id);

        // En la siguiente vista podria mostrar la data de la movie ya q voy a tener el objeto guiño guiño
        require_once(VIEWS_PATH . "show-creation.php");
    }

    function add($date, $time, $price, $room_id, $movie_id) {

        if($date && $time && $price) {
            $show = new Show($date, $time, $price);
            $movie = $this->movieDAO->get($movie_id);
            $show->setMovie($movie);
            // var_dump($show->getMovie());     la pelicula esta creada bien
            $this->showDAO->add($show);

            $this->getActive();
        }else { echo "ERROR";}
    }

    function getActive() {
        $shows = $this->showDAO->getAll();
        require_once(VIEWS_PATH . "shows-active.php");
    }


}
