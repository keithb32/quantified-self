<?php

class MainController {
    private $db;
    private $input = [];

    /**
     * Constructor
     */
    public function __construct($input) {
        session_start();
        $this->db = new Database();
        $this->input = $input;
    }


    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the home page.
     */
    public function run() {
        // Get the command
        $command = "home";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "goToProfilePage":
                $this->goToProfilePage();
                break;
            case "goToStatisticPage":
                $this->goToStatisticPage();
                break;
            case "getAllStatsJson":
                $this->getAllStatsJson();
                break;
            case "getCountsJson":
                $this->getCountsJson();
                break;
            case "getPercentsJson":
                $this->getPercentsJson();
                break;
            case "getRatesJson":
                $this->getRatesJson();
                break;
            case "logout":
                $this->logout();
                break;
            default:
                $this->showHome();
                break;
        }
    }

    public function showHome(){
        $name = $_SESSION["name"];

        $countStats = $this->db->query("select * from count_statistic where creatorId = $1", $_SESSION["userId"]);
        $rateStats = $this->db->query("select * from rate_statistic where creatorId = $1", $_SESSION["userId"]);
        $pctStats = $this->db->query("select * from pct_statistic where creatorId = $1", $_SESSION["userId"]);

        $countStats = $countStats ? $countStats : [];
        $rateStats = $rateStats ? $rateStats : [];
        $pctStats = $pctStats ? $pctStats : [];

        include("home.php");
    }

    public function goToProfilePage(){
        header("Location: profile/index.php");
    }

    public function goToStatisticPage(){
        header("Location: statistic/index.php");
    }

    public function getAllStatsJson(){
        $countStats = $this->db->query("select * from count_statistic where creatorId = $1", $_SESSION["userId"]);
        $pctStats = $this->db->query("select * from pct_statistic where creatorId = $1", $_SESSION["userId"]);
        $rateStats = $this->db->query("select * from rate_statistic where creatorId = $1", $_SESSION["userId"]);

        $countStats = $countStats ? $countStats : [];
        $rateStats = $rateStats ? $rateStats : [];
        $pctStats = $pctStats ? $pctStats : [];

        $allStats = array_merge($countStats, $rateStats, $pctStats);
        header("Content-Type: application/json");
        echo(json_encode($allStats));
    }

    public function getCountsJson(){
        $countStats = $this->db->query("select * from count_statistic where creatorId = $1", $_SESSION["userId"]);
        $countStats = $countStats ? $countStats : [];
        header("Content-Type: application/json");
        echo(json_encode($countStats));
    }

    public function getPercentsJson(){
        $pctStats = $this->db->query("select * from pct_statistic where creatorId = $1", $_SESSION["userId"]);
        $pctStats = $pctStats ? $pctStats : [];

        header("Content-Type: application/json");
        echo(json_encode($pctStats));

    }

    public function getRatesJson(){
        $rateStats = $this->db->query("select * from rate_statistic where creatorId = $1", $_SESSION["userId"]);
        $rateStats = $rateStats ? $rateStats : [];
        header("Content-Type: application/json");
        echo(json_encode($rateStats));
    }

    /**
     * Log out the user
     */
    public function logout() {
        session_destroy();
        session_start();
        header("Location: ../../index.php");
    }
}
