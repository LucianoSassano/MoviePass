<?php

namespace Controllers;

use DAO\PDO\ShowPDO as ShowDAO;
use DAO\PDO\MoviePDO as MovieDAO;
use DAO\PDO\TheaterPDO as TheaterDAO;
use DAO\PDO\RoomPDO as RoomDAO;
use DAO\PDO\GenrePDO as GenreDAO;
use DateTime;
use Models\Show;

class ShowController
{
    private $showDAO;
    private $movieDAO;
    private $theaterDAO;
    private $roomDAO;
    private $genreDAO;

    function __construct()
    {
        $this->showDAO = new ShowDAO();
        $this->movieDAO = new MovieDAO();
        $this->theaterDAO = new TheaterDAO();
        $this->roomDAO = new RoomDAO();
        $this->genreDAO = new GenreDAO();
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

    function create($movie_id , $room_id, $theater_id){

        $movie = $this->movieDAO->get($movie_id);
        $room = $this->roomDAO->get($room_id);
        $theater = $this->theaterDAO->get($theater_id);

        // En la siguiente vista podria mostrar la data de la movie ya q voy a tener el objeto 
        require_once(VIEWS_PATH . "show-creation.php");
    }

    function add($date, $time, $price, $room_id, $movie_id) {

        if($date && $time && $price) {
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $dateTime = new DateTime("{$date} {$time}");  //fecha y hora de inicio del show
            $dateTime = date_format($dateTime, 'Y-m-d H:i:s');

            $movie = $this->movieDAO->get($movie_id);
            $movieDurationInMinutes = $movie->getDuration(); // duracion en minutos de la pelicula

            $endTime = new DateTime("{$date}{$time}");
            
            $endTime->modify("+{$movieDurationInMinutes} minutes"); // a la hora de inicio le sumamos la duracion de la pelicula
            
            $endTime->modify('+15 minutes'); // fecha y hora de finalizacion de la pelicula ya contemplados los 15 minutos entre pelicula y pelicula;
  
            
            $endTime = date_format($endTime, 'Y-m-d H:i:s' );
          
            
            $show = new Show($dateTime, $price);
            $show->setMovie($movie);
            $show->setEndTime($endTime);
       
            $this->showDAO->add($show, $room_id);

            $this->getActive();
        }else { echo "ERROR";}
    }

    function getActive() {
        $shows = $this->showDAO->getAll();
        $genres = $this->genreDAO->getAll();
        require_once(VIEWS_PATH . "shows-active.php");
    }

    function filter($genre_id) {

        if($genre_id){
            $shows = $this->showDAO->getByGenre($genre_id);
        }else {
            $shows = $this->showDAO->getAll();
        }
        
        $genres = $this->genreDAO->getAll();
        require_once(VIEWS_PATH . "shows-active.php");
    }

    function filterClientSide($genre_id) {

        if($genre_id){
            $shows = $this->showDAO->getByGenre($genre_id);
        }else{
            $shows = $this->showDAO->getAll();
        }
        
        $genres = $this->genreDAO->getAll();
        require_once(VIEWS_PATH . "index.php");
    }

}
