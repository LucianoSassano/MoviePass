<?php

namespace Controllers;

use DAO\ShowJSON as ShowDAO;
use Models\Show;

class ShowController
{
    private $showDAO;

    function __construct()
    {
        $this->showDAO = new ShowDAO();
    }

    function createShowView()
    {
        require_once(VIEWS_PATH . "show.php");
    }


}

?>