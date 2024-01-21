<?php

spl_autoload_register(function ($classname) {
    include "$classname.php";
});
        

$controller = new QuantifyYourselfController($_GET);

$controller->run();
