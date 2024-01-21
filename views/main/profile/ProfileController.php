<?php

class ProfileController {
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
     * parameter.  Default is the welcome page.
     */
    public function run() {
        // Get the command
        $command = "profile";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "showProfile":
                $this->showProfile();
                break;
            case "editBio":
                $this->editBio();
                break;
            case "updateBio":
                $this->updateBio();
                break;
            default:
                $this->showProfile();
                break;
        }
    }

    public function showProfile($userAction="displayProfile"){
        $name = $_SESSION["name"];
        
        $res = $this->db->query("select * from users where email = $1", $_SESSION["email"]);
        if (!empty($res)){
            $year = $res[0]["acctcreationdate"];  
            $bio = $res[0]["bio"];
        }

        $countStats = $this->db->query("select * from count_statistic where creatorId=$1", $_SESSION["userId"]);
        $rateStats = $this->db->query("select * from rate_statistic where creatorId=$1", $_SESSION["userId"]);
        $pctStats = $this->db->query("select * from pct_statistic where creatorId=$1", $_SESSION["userId"]);

        $countStats = $countStats ? $countStats : [];
        $rateStats = $rateStats ? $rateStats : [];
        $pctStats = $pctStats ? $pctStats : [];

        $numCounts = empty($countStats) ? 0 : sizeof($countStats);
        $numRates = empty($rateStats) ? 0 : sizeof($rateStats);
        $numPercents = empty($pctStats) ? 0 : sizeof($pctStats);

        $countStats = array_filter($countStats, 'isFeatured');
        $rateStats = array_filter($rateStats, 'isFeatured');
        $pctStats = array_filter($pctStats, 'isFeatured');


        $action = $userAction;

        include("profile.php");
    }

    
    public function editBio(){
        $this->showProfile("editBio");
    }

    public function updateBio(){
        $bio = $_POST['bio'];

        if(!empty($bio)){
            $res = $this->db->query("update users set bio = $1 where email = $2", $bio, $_SESSION["email"]);
        }
        
        header("Location: ?command=showProfile");
    }

    public function showEditFeaturedStatistics(){
        $this->showProfile("editFeaturedStatistics");
    }

    public function saveFeaturedStatisticsChanges(){
        $this->showProfile("editFeaturedStatistics");
    }
}

// Helper functions
function isFeatured($var){
    return boolval($var["featured"] === "t");
}
