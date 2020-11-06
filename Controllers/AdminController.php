<?php

namespace Controllers;

use DAO\PDO\MoviePDO as MovieDAO;
use DAO\PDO\TheaterPDO as TheaterDao;


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

    function viewAnalytics(){

        require_once(VIEWS_PATH . "admin-analytics.php");
    }

    
}
