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

    function chooseRoom($theater_id, $movie_id)
    {
        $theater = $this->theaterDAO->get($theater_id);
        $movie_id = $movie_id;
        require_once(VIEWS_PATH . "chooseRoom.php");
    }

    function create($movie_id, $room_id, $theater_id)
    {

        $movie_id = $movie_id;
        $room_id = $room_id;
        $theater_id = $theater_id;

        // En la siguiente vista podria mostrar la data de la movie ya q voy a tener el objeto 
        require_once(VIEWS_PATH . "show-creation.php");
    }

    function add($date, $time, $price, $theater_id, $movie_id, $room_id)
    {

        if ($date && $time && $price) {
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $date = new DateTime("{$date} {$time}");  //fecha y hora de inicio del show
            $date = date_format($date, 'Y-m-d');

            $movie = $this->movieDAO->get($movie_id);
            $movieDurationInMinutes = $movie->getDuration(); // duracion en minutos de la pelicula

            $startTime = new DateTime("{$time}"); //hora de inicio de la funcion

            $startTime = date_format($startTime, 'H:i:s');

            $endTime = new DateTime("{$time}"); // hora de finalizacion de la funcion

            // si la duracion de la movie es menor a dos horas la funcion es de 2hrs
            // si la movie dura es mayor a dos hs pero menor a 2 horas y media la funcion dura 2 horas treinta 
            // si la funcion es mayor a estas dos entonces directamente es de 3 horas la funcion

            if ($movieDurationInMinutes < 120) {
                $endTime->modify('+2 hours');
            } else if ($movieDurationInMinutes > 120 && $movieDurationInMinutes < 150) {
                $endTime->modify('+2 hours');
                $endTime->modify('+30 minutes');
            } else {
                $endTime->modify('+3 hours');
            }

            // una vez seteada la duracion de la funcion se le agregan los 15 minutos entre funcion y funcion

            $endTime->modify('+15 minutes'); // fecha y hora de finalizacion de la pelicula ya contemplados los 15 minutos entre pelicula y pelicula;


            $endTime = date_format($endTime, 'H:i:s');


            $show = new Show($date, $price);
            $show->setMovie($movie);
            $show->setStartTime($startTime);  // es el mismo valor que date pero al guardar en nuestra db solo guarda el timepo y no la fecha.
            $show->setEndTime($endTime);
            $show->setTheater($this->theaterDAO->get($theater_id));
            $show->setRoom($this->roomDAO->get($room_id));


            $this->showDAO->add($show, $theater_id, $room_id);

            $this->getActive();
        } else {
            echo "ERROR";
        }
    }

    function getActive()
    {
        $shows = $this->movieDAO->getMoviesDistinct();
        $genres = $this->genreDAO->getAll();

        require_once(VIEWS_PATH . "shows-active.php");
    }

    function filter($genre_id)
    {

        if ($genre_id) {
            $shows = $this->showDAO->getByGenre($genre_id);
        } else {
            $shows = $this->showDAO->getAll();
        }

        $genres = $this->genreDAO->getAll();
        require_once(VIEWS_PATH . "shows-active.php");
    }

    function filterClientSide($genre_id)
    {

        if ($genre_id) {
            $shows = $this->showDAO->getByGenre($genre_id);
        } else {
            $shows = $this->showDAO->getAll();
        }

        $genres = $this->genreDAO->getAll();
        require_once(VIEWS_PATH . "index.php");
    }

    function showReservation($show_id){
        $show = $this->showDAO->get($show_id);
        
        require_once(VIEWS_PATH . "show-reservation.php");
    }

    function confirmReservation($show_id){

        require_once(VIEWS_PATH . "client-shows.php");

    }
}
