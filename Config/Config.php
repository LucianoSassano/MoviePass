<?php namespace Config;
    define("ROOT", dirname(__DIR__) . "/");

    define("FRONT_ROOT", "/MoviePass/");
    define("VIEWS_PATH", "Views/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
    define("IMG_PATH", FRONT_ROOT.VIEWS_PATH . "images/");

    define("DB_HOST", "localhost");
    define("DB_NAME", "moviepass");
    define("DB_USER", "root");
    define("DB_PASS", "password");
?>