<?php

error_reporting(0);
ini_set("display_errors", 0);

spl_autoload_register(function ($classname) {
    include "$classname.php";
});

include "../../Database.php";
include "../../Config.php";

$controller = new MainController($_GET);

$controller->run();
