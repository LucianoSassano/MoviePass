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


    function create($room_name, $room_capacity)
    {

        $room = new Room($room_name, $room_capacity);
        $this->roomDAO->add($room);
    }
}
