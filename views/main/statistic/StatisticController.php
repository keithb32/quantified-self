<?php

class StatisticController {
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
        $command = "statistic";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "showStatistics":
                $this->showStatistics();
                break;
            case "showStatisticTypes":
                $this->showStatisticTypes();
                break;
            case "createCountStatistic":
                $this->createCountStatistic();
                break;
            case "newCountStatistic":
                $this->newCountStatistic();
                break;
            case "editCountStatistic":
                $this->editCountStatistic($_GET["statId"]);
                break;
            case "updateCountStatistic":
                $this->updateCountStatistic($_GET["statId"]);
                break;
            case "deleteCountStatistic":
                $this->deleteCountStatistic($_GET["statId"]);
                break;
            case "createPctStatistic":
                $this->createPctStatistic();
                break;
            case "newPctStatistic":
                $this->newPctStatistic();
                break;
            case "editPctStatistic":
                $this->editPctStatistic($_GET["statId"]);
                break;
            case "updatePctStatistic":
                $this->updatePctStatistic($_GET["statId"]);
                break;
            case "deletePctStatistic":
                $this->deletePctStatistic($_GET["statId"]);
                break;
            case "createRateStatistic":
                $this->createRateStatistic();
                break;
            case "newRateStatistic":
                $this->newRateStatistic();
                break;
            case "editRateStatistic":
                $this->editRateStatistic($_GET["statId"]);
                break;
            case "updateRateStatistic":
                $this->updateRateStatistic($_GET["statId"]);
                break;
            case "deleteRateStatistic";
                $this->deleteRateStatistic($_GET["statId"]);
                break;
            default:
                $this->showStatistics();
                break;
        }
    }

    // Display statistics page
    public function showStatistics(){
        $name = $_SESSION["name"];
        $countStats = $this->db->query("select * from count_statistic where creatorId = $1", $_SESSION["userId"]);
        $rateStats = $this->db->query("select * from rate_statistic where creatorId = $1", $_SESSION["userId"]);
        $pctStats = $this->db->query("select * from pct_statistic where creatorId = $1", $_SESSION["userId"]);

        $countStats = $countStats ? $countStats : [];
        $rateStats = $rateStats ? $rateStats : [];
        $pctStats = $pctStats ? $pctStats : [];

        include("statistics.php");
    }

    // Display statistics type page
    public function showStatisticTypes(){
        include("statistic_types.php");
    }

    // Display add count statistic page
    public function createCountStatistic(){
        include("add_count_statistic.php");
    }

    public function newCountStatistic(){
        $description = isset($_POST["countDescription"]) ? "Number of " . $_POST["countDescription"] : "";
        $isFeatured = isset($_POST["featured"]) ? 'TRUE' : 'FALSE' ;
        $tags = isset($_POST["tags"]) ? Database::array_to_pg_string(explode(" ", $_POST["tags"])) : [];
        $value = isset($_POST["countValue"]) ? $_POST["countValue"] : 0;
        $creatorId = $_SESSION["userId"];

        if (!$description || !$value){
            $alert = '<div class="alert alert-warning" role="alert">Make sure to enter a description and value.</div>';
        }

        $this->db->query("insert into count_statistic (description, featured, tags, value, creatorId) values ($1, $2, $3, $4, $5)",
            $description,
            $isFeatured,
            $tags,
            $value,
            $creatorId                
        );

        header("Location: ?command=showStatistics");
    }

    public function editCountStatistic($statId){
        $countStatistic = $this->db->query("select * from count_statistic where id = $1", $statId);
        $description = str_replace("Number of ", "", $countStatistic[0]["description"]);
        $value = $countStatistic[0]["value"];
        $tags = Database::format_pg_arr_string($countStatistic[0]["tags"]);
        $featured = $countStatistic[0]["featured"] === "t" ? "checked" : "";        

        include("edit_count_statistic.php");
    }

    public function updateCountStatistic($statId){
        $description = isset($_POST["countDescription"]) ? "Number of " . $_POST["countDescription"] : "";
        $isFeatured = isset($_POST["featured"]) ? 'TRUE' : 'FALSE' ;
        $tags = isset($_POST["tags"]) ? Database::array_to_pg_string(explode(" ", $_POST["tags"])) : [];
        $value = isset($_POST["countValue"]) ? $_POST["countValue"] : 0;        

        $this->db->query("update count_statistic set description = $1, featured = $2, tags = $3, value = $4 where id = $5",
        $description,
        $isFeatured,
        $tags,
        $value,
        $statId);

        header("Location: ?command=showStatistics");
    }

    public function deleteCountStatistic($statId){
        $this->db->query("delete from count_statistic where id = $1", $statId);

        header("Location: ?command=showStatistics");
    }

    // Display add percent statistic page
    public function createPctStatistic(){
        include("add_percent_statistic.php");
    }

    public function newPctStatistic(){
        $description = isset($_POST["pctDescription"]) ? "Percentage of " . $_POST["pctDescription"] : "";
        $isFeatured = isset($_POST["featured"]) ? 'TRUE' : 'FALSE' ;
        $tags = isset($_POST["tags"]) ? Database::array_to_pg_string(explode(" ", $_POST["tags"])) : [];
        $numeratorValue = isset($_POST["pctNumeratorValue"]) ? $_POST["pctNumeratorValue"] : 0;
        $denominatorValue = isset($_POST["pctDenominatorValue"]) ? $_POST["pctDenominatorValue"] : 0;
        $creatorId = $_SESSION["userId"];

        if (!$description || !$numeratorValue || $denominatorValue) {
            $alert = '<div class="alert alert-warning" role="alert">Make sure to enter a description and value.</div>';
        }
        elseif($denominatorValue > $numeratorValue){
            $alert = '<div class="alert alert-warning" role="alert">Denominator cannot be greater than the numerator.</div>';
        }

        $this->db->query("insert into pct_statistic (description, featured, tags, numerator, denominator, creatorId) values ($1, $2, $3, $4, $5, $6)",
            $description,
            $isFeatured,
            $tags,
            $numeratorValue,
            $denominatorValue,
            $creatorId                
        );

        header("Location: ?command=showStatistics");
    }

    public function editPctStatistic($statId){
        $pctStatistic = $this->db->query("select * from pct_statistic where id = $1", $statId);
        $description = str_replace("Percentage of ", "", $pctStatistic[0]["description"]);
        $numerator = $pctStatistic[0]["numerator"];
        $denominator = $pctStatistic[0]["denominator"];
        $tags = Database::format_pg_arr_string($pctStatistic[0]["tags"]);
        $featured = $pctStatistic[0]["featured"] === "t" ? "checked" : "";        

        include("edit_percent_statistic.php");
    }

    public function updatePctStatistic($statId){
        $description = isset($_POST["pctDescription"]) ? "Percentage of " . $_POST["pctDescription"] : "";
        $isFeatured = isset($_POST["featured"]) ? 'TRUE' : 'FALSE' ;
        $numerator = isset($_POST["pctNumeratorValue"]) ? $_POST["pctNumeratorValue"] : 0;
        $denominator = isset($_POST["pctDenominatorValue"]) ? $_POST["pctDenominatorValue"] : 0;
        $tags = isset($_POST["tags"]) ? Database::array_to_pg_string(explode(" ", $_POST["tags"])) : [];

        $this->db->query("update pct_statistic set description = $1, featured = $2, tags = $3, numerator = $4, denominator = $5 where id = $6",
        $description,
        $isFeatured,
        $tags,
        $numerator,
        $denominator,
        $statId);

        header("Location: ?command=showStatistics");
    }

    public function deletePctStatistic($statId){
        $this->db->query("delete from pct_statistic where id = $1", $statId);

        header("Location: ?command=showStatistics"); 
    }

    // Display add rate statistic page
    public function createRateStatistic(){
        include("add_rate_statistic.php");
    }

    public function newRateStatistic(){
        $description = isset($_POST["rateDescription1"]) && isset($_POST["rateDescription2"]) ? $_POST["rateDescription1"] . " per " . $_POST["rateDescription2"] : "";
        $isFeatured = isset($_POST["featured"]) ? 'TRUE' : 'FALSE' ;
        $tags = isset($_POST["tags"]) ? Database::array_to_pg_string(explode(" ", $_POST["tags"])) : [];
        $numeratorValue = isset($_POST["rateNumeratorValue"]) ? $_POST["rateNumeratorValue"] : 0;
        $denominatorValue = isset($_POST["rateDenominatorValue"]) ? $_POST["rateDenominatorValue"] : 0;
        $creatorId = $_SESSION["userId"];

        if (!$description || !$numeratorValue || $denominatorValue) {
            $alert = '<div class="alert alert-warning" role="alert">Make sure to enter a description and value.</div>';
        }

        $this->db->query("insert into rate_statistic (description, featured, tags, numerator, denominator, creatorId) values ($1, $2, $3, $4, $5, $6)",
            ucfirst($description),
            $isFeatured,
            $tags,
            $numeratorValue,
            $denominatorValue,
            $creatorId                
        );

        header("Location: ?command=showStatistics");
    }

    public function editRateStatistic($statId){
        $rateStatistic = $this->db->query("select * from rate_statistic where id = $1", $statId);
        $description1 = preg_replace('/per .+/', "", $rateStatistic[0]["description"]);
        $description2 = trim(preg_replace('/.+ per/', "", $rateStatistic[0]["description"]));
        $numerator = $rateStatistic[0]["numerator"];
        $denominator = $rateStatistic[0]["denominator"];
        $tags = Database::format_pg_arr_string($rateStatistic[0]["tags"]);
        $featured = $rateStatistic[0]["featured"] === "t" ? "checked" : "";        

        include("edit_rate_statistic.php");
    }

    public function updateRateStatistic($statId){
        $description = isset($_POST["rateDescription1"]) && isset($_POST["rateDescription2"]) ? $_POST["rateDescription1"] . " per " . $_POST["rateDescription2"] : "";
        $isFeatured = isset($_POST["featured"]) ? 'TRUE' : 'FALSE' ;
        $numerator = isset($_POST["rateNumeratorValue"]) ? $_POST["rateNumeratorValue"] : 0;
        $denominator = isset($_POST["rateDenominatorValue"]) ? $_POST["rateDenominatorValue"] : 0;
        $tags = isset($_POST["tags"]) ? Database::array_to_pg_string(explode(" ", $_POST["tags"])) : []; 

        $this->db->query("update rate_statistic set description = $1, featured = $2, tags = $3, numerator = $4, denominator = $5 where id = $6",
        $description,
        $isFeatured,
        $tags,
        $numerator,
        $denominator,
        $statId);

        header("Location: ?command=showStatistics");
    }

    public function deleteRateStatistic($statId){
        $this->db->query("delete from rate_statistic where id = $1", $statId);

        header("Location: ?command=showStatistics"); 
    }

}
