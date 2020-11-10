<?php

namespace Controllers;

use DAO\PDO\MoviePDO as MovieDAO;

class AdminController
{

    private $movieDAO;
  

    function __construct()
    {
        $this->movieDAO = new MovieDAO();
       
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
