<?php

namespace Controllers;

use DAO\RoomJSON as RoomDAO;
use DAO\TheaterJSON as TheaterDAO;
use Models\Room;

class RoomController
{
    private $roomDAO;
    private $theaterDAO;

    function __construct()
    {
        $this->roomDAO = new RoomDAO();
        $this->theaterDAO = new TheaterDAO();
    }


    function createView($theater_id)
    {

        $theater = $this->theaterDAO->get($theater_id);
        require_once(VIEWS_PATH . "room-creation.php");
    }


    function create($name, $capacity, $theater_id)
    {

        $room = new Room($name, $capacity);
        $this->roomDAO->add($room);

        $theater = $this->theaterDAO->addRoom($theater_id, $room);
        
        $theaters = $this->theaterDAO->getAll();
        require_once(VIEWS_PATH . "theaters.php");
    }
}
