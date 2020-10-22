<?php

namespace Controllers;

use DAO\MovieJSON as MovieDAO;
use DAO\TheaterJSON as TheaterDao;
use Models\Theater;

class AdminController
{

    private $movieDAO;
    private $theaterDao;

    function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->theaterDao = new TheaterDAO();
    }

    function dashboard()
    {
        $movies = $this->movieDAO->getAll();
        require_once(VIEWS_PATH . "admin.php");
    }

    function showTheaters()
    {
        $theaters = $this->theaterDao->getAll();
        require_once(VIEWS_PATH . "theaters.php");
    }

    function createTheater($name, $address)
    {
        if ($name && $address) {
            //valido la existencia del cine por la direccion si existe no grava el nuevo cine
            if($this->validate($address)){
                $newTheater = new Theater($name, $address);
                $this->theaterDao->add($newTheater);

                echo '<script>alert("Theater Creation Successfull")</script>'; 
            }
            else {
                $errorMsg = "Theater already exists";  // Esto se envia al creation.php y se muestra 
                require_once(VIEWS_PATH . "creation.php");
            }
        } 
    }
    public function validate($address)
    {
        return $this->theaterDao->getByAddress($address) == NULL ? true : false;
    }

    function createTheaterForm()
    {
        require_once(VIEWS_PATH . "creation.php");
    }

    function createShow()
    {
        require_once(VIEWS_PATH . "show.php");
    }

    function modifyTheater(){
        require_once(VIEWS_PATH ."theaterMod.php");
    }
}
