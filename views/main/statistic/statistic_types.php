<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <meta name="author" content="Keith Butler (kab7em) and Justin Park (jhp8ed)">
        <meta name="description" content="Quantify Yourself - your personal data tracker">
        <meta name="keywords" content="quantify yourself data tracker">        

        <title>Quantify Yourself</title>

        <link rel="icon" href="../assets/bar-chart.png">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous"> 
        <link href="../../../styles/main.css" rel="stylesheet">
        <script src="../../../scripts/statistic_types.js" defer></script>
    </head>  
    
    <body>
        
        <!-- Navbar -->
        <div class="bg-light">
            <nav class="navbar navbar-expand-lg navbar-light container flex-row">
                                
                <!-- Logo -->
                <a class="nav-link" href="#" role="button">
                    <img src="../../../assets/qys-bar-transparent.png" id="navbar-logo" alt="Quantify Yourself logo">
                </a>

                <!-- Hamburger menu for small screens -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Collapsible navbar items -->
                <div class="collapse navbar-collapse flex-grow-1" id="navbarSupportedContent">
                    <a class="nav-link nav-text px-4 py-2" href="../index.php">Home</a>
                    <a class="nav-link nav-text px-4 py-2" href="../index.php?command=goToStatisticPage">Manage statistics</a>

                    <!-- Profile dropdown menu-->
                    <ul class="navbar-nav ms-auto ps-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-text dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= isset($_SESSION["name"]) ? $_SESSION["name"] : "{{username}}" ?>
                            </a>
                            <ul class="dropdown-menu mb-3 me-3">
                                <li><a class="dropdown-item" href="../index.php?command=goToProfilePage">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../index.php?command=logout">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>     

        <!-- Statistic Type cards -->
        <section class="container mt-5 w-50 w-sm-100">
            <h2 class="text-center my-3">Statistic Types</h2>
            <p class="lead text-center">Select the type of statistic you would like to add.</p>

            <div class="rounded-3 w-75 mx-auto">
                <a href="?command=createCountStatistic" class="text-decoration-none">
                    <div id="countType" class="card my-2 pb-2 statistic-type">
                        <div class="card-body">
                            <h5 class="card-title">Count Statistic</h5>
                            <p class="card-text">A total, e.g. "500 basketball shots made"</p>
                        </div>
                    </div>
                </a>

                <a href="?command=createRateStatistic" class="text-decoration-none">
                    <div id="rateType" class="card my-2 pb-3 statistic-type">
                        <div class="card-body">
                            <h5 class="card-title">Rate Statistic</h5>
                            <p class="card-text">A rate, e.g. "2.5 books read per week" or "24 points per game"</p>
                        </div>
                    </div>
                </a>

                <a href="?command=createPctStatistic" class="text-decoration-none">
                    <div id="pctType" class="card my-2 pb-3 statistic-type">
                        <div class="card-body">
                            <h5 class="card-title">Percentage Statistic</h5>
                            <p class="card-text">A fraction, e.g. "80% of attempted free throws made"</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>

</html>
