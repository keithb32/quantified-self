<?php
class Database {
    private $dbConnector;

    /**
     * Reads configuration from the Config class above
     */
    public function __construct() {
        $db_host = Config::$db["host"];
        $db_user = Config::$db["user"];
        $db_database = Config::$db["database"];
        $db_password = Config::$db["pass"];
        $db_port = Config::$db["port"];

        $this->dbConnector = pg_connect("host=$db_host port=$db_port dbname=$db_database user=$db_user password=$db_password");
    }

    public function query($query, ...$params) {
        // Use safe querying
        $res = pg_query_params($this->dbConnector, $query, $params);

        // If there was an error, print it out
        if ($res === false) {
            echo pg_last_error($this->dbConnector);
            return false;
        }

        // Return an array of associative arrays (the rows
        // in the database)
        return pg_fetch_all($res);
    }

    public static function array_to_pg_string($array){
        $arrayString = "{" . implode(",", $array) . "}";
        return  $arrayString;
    }

    public static function format_pg_arr_string($str){
        $result = "";
        if (strlen($str) > 0){
            $result = substr($str, 1, -1);
        }
        $result = implode(" ", explode(",", $result));
        return $result;
    }
}
