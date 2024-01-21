<?php

class LandingController {
    private $input = [];
    private $db;

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
        $command = "welcome";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "signUp":
                $this->showSignUp();
                break;
            case "register":
                $this->register();
                break;
            case "login":
                $this->login();
                break;
            default:
                $this->showLogin();
                break;
        }
    }

    public function showLogin(){
        include("login.php");
    }

    public function showSignUp(){
        include("signup.php");
    }

    public function register(){
        $emailRegex = '/^[a-zA-Z0-9-_+]+[a-zA-Z0-9.-_+]*[a-zA-Z0-9-_+]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+[a-zA-Z0-9-.]*$/';
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConfirm = $_POST["passwordConfirm"];
        $date = date("Y-m-d");


        if (!$name || !$email || !$password || !$passwordConfirm){
            $alert = '<div class="alert alert-warning" role="alert">Please enter all fields.</div>';
        }

        elseif (!preg_match($emailRegex, $email)){
            $alert = '<div class="alert alert-warning" role="alert">Please enter an email with a dot-delimited domain, e.g. johndoe@gmail.com</div>';
        }

        elseif ($password !== $passwordConfirm){
            $alert = '<div class="alert alert-warning" role="alert">Please make sure your passwords are the same.</div>';
        }

        else {
            $usernameIsTaken = false;
            $emailIsTaken = false;

            if ($usernameIsTaken) {
                $alert = '<div class="alert alert-warning" role="alert">The username you entered is already taken.</div>';
            }
            elseif ($emailIsTaken){
                $alert = '<div class="alert alert-warning" role="alert">The email you entered is already taken.</div>';
            }
            else {
                // Start session
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;

                // Persist user in database
                $this->db->query("insert into users (name, email, password, acctcreationdate) values ($1, $2, $3, $4);",
                        $name, 
                        $email,
                        password_hash($password, PASSWORD_DEFAULT),
                        $date);

                // Save DBMS-generated userId in session
                $userRow = $this->db->query("select * from users where email = $1", $email);
                $_SESSION["userId"] = $userRow[0]["id"];

                setcookie("email", $email);

                header("Location: ../main/index.php");
            }
        }

        include("signup.php");
    }


    /**
     * Handle user registration and log-in
     */
    public function login() {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($email && $password){
            // Check if user is in database
            $res = $this->db->query("select * from users where email = $1;", $email);

            if (empty($res)) {
                $alert = '<div class="alert alert-warning" role="alert">Account does not exist or email is invalid.</div>';
            }
            else {
                $hashedPassword = $res[0]["password"];
                
                // User was in the database, verify password
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION["name"] = $res[0]["name"];
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["userId"] = $res[0]["id"];
                    setcookie("email", $email);
                    header("Location: ../main/index.php");
                } else {
                    $alert = '<div class="alert alert-warning" role="alert">Incorrect password.</div>';
                }
            }
        }
        else {
            $alert = '<div class="alert alert-warning" role="alert">Please enter all fields.</div>';
        }

        include("login.php");
    }
}
