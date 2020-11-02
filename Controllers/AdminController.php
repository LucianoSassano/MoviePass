<?php

namespace Controllers;

use DAO\PDO\MoviePDO as MovieDAO;
use DAO\JSON\TheaterJSON as TheaterDao;


use Models\Theater;

class AdminController
{

    private $movieDAO;
    private $theaterDAO;

    function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->theaterDAO = new TheaterDAO();
    
    }

    function dashboard()
    {
        $movies = $this->movieDAO->getAll();
        
        require_once(VIEWS_PATH . "admin.php");
    }

    
}
