<?php

namespace Controllers;

use DAO\JSON\TheaterJSON as TheaterDAO;
use Models\Theater;

class TheaterController
{
    private $theaterDAO;

    function __construct()
    {
        $this->theaterDAO = new TheaterDAO();
    }

    function showAll()
    {
        $theaters = $this->theaterDAO->getAll();
        require_once(VIEWS_PATH . "theaters.php");
    }

    /**
     * Create methods
     */

    function createView()
    {
        require_once(VIEWS_PATH . "theater-creation.php");
    }

    function create($name, $address)
    {
        if ($name && $address) {
            //valido la existencia del cine por la direccion si existe no grava el nuevo cine
            if ($this->validate($address)) {
                $newTheater = new Theater($name, $address);
                $this->theaterDAO->add($newTheater);

                echo '<script>alert("Theater Creation Successfull")</script>';
                $successMsg = "Theater created successfully !";  // Esto se envia al creation.php y se muestra 
                require_once(VIEWS_PATH . "theater-creation.php");
            } else {
                $errorMsg = "Theater already exists";  // Esto se envia al creation.php y se muestra 
                require_once(VIEWS_PATH . "theater-creation.php");
            }
        } else {
            $errorMsg = "Complete all the fields";  // Esto se envia al creation.php y se muestra 
            require_once(VIEWS_PATH . "theater-creation.php");
        }
    }

    public function validate($address)
    {
        return $this->theaterDAO->getByAddress($address) == NULL ? true : false;
    }

    /**
     * Modify methods
     */
    function modifyView($id)
    {
        $theater = $this->theaterDAO->get($id);

        require_once(VIEWS_PATH . "theaterMod.php");
    }

    function modify($id, $name, $address)
    {

        if ($name && $address) { // Valido la data que viene

            $edited = new Theater($name, $address); // Instancio el theater
            $edited->setId($id);    // seteo el id con el que voy a buscar en el edit del dao

            $this->theaterDAO->edit($edited);   // edito en el dao

            $this->showAll();  // redirecciono a la lista de theaters
        } else {
            $errorMsg = "Complete all the fields";
            $theater = $this->theaterDAO->get($id);     // si la data viene vacia 
            require_once(VIEWS_PATH . "theaterMod.php"); // redirecciona al mismo formulario
        }
    }
}
