<?php

class QuantifyYourselfController {
    /**
     * Constructor
     */
    public function __construct($input) {
        session_start();
    }


    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run() {
        header("Location: views/landing/index.php");
    }
}
