<?php

namespace Controllers;

use DAO\RoomJSON as RoomDAO;
use Models\Room;

class RoomController
{
    private $roomDAO;

    function __construct()
    {
        $this->roomDAO = new RoomDAO();
    }


}

?>