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
        <link href="../../styles/main.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../../scripts/home.js"></script>
    </head>  
    
    <body>
        <!-- Navbar -->
        <div class="bg-light">
            <nav class="navbar navbar-expand-lg navbar-light container flex-row">
                                
                <!-- Logo -->
                <a class="nav-link" href="#" role="button">
                    <img src="../../assets/qys-bar-transparent.png" id="navbar-logo" alt="Quantify Yourself logo">
                </a>

                <!-- Hamburger menu for small screens -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Collapsible navbar items -->
                <div class="collapse navbar-collapse flex-grow-1" id="navbarSupportedContent">
                    <a class="nav-link nav-text px-4 py-2" href="#">Home</a>
                    <a class="nav-link nav-text px-4 py-2" href="?command=goToStatisticPage">Manage statistics</a>

                    <!-- Profile dropdown menu-->
                    <ul class="navbar-nav ms-auto ps-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-text dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= isset($_SESSION["name"]) ? $_SESSION["name"] : "{{username}}" ?>
                            </a>
                            <ul class="dropdown-menu mb-3 me-3">
                                <li><a class="dropdown-item" href="?command=goToProfilePage">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="?command=logout">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Stats cards -->
        <section class="container mt-5 w-50 w-sm-100">
            
            <div class="d-flex">
                <h2>Summary of statistics</h2>
                
                <!-- Profile dropdown menu-->
                <div class="dropdown ms-auto">
                    <button class="btn btn-secondary-outline dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Export as JSON
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="?command=getAllStatsJson">All statistics</a></li>
                        <li><a class="dropdown-item" href="?command=getCountsJson">Count statistics</a></li>
                        <li><a class="dropdown-item" href="?command=getPercentsJson">Percent statistics</a></li>
                        <li><a class="dropdown-item" href="?command=getRatesJson">Rate statistics</a></li>
                    </ul>
                </div>
            </div>


            <!-- Search bar -->
            <form class="d-flex" role="search">
                <div class="input-group">
                    <input class="form-control" id="statsSearch" name="stats-search" type="search" placeholder="Search for other statistics with a single tag e.g. 'reading'" aria-label="Search">
                </div>
            </form>

            <section id="initialStatsList">
                <!-- User statistic cards -->
                <?php
                    if (!$countStats && !$rateStats && !$pctStats){
                        echo "<p class='lead text-center my-5'>You currently don't have any statistics. Go to the Manage statistics tab to start tracking!</p>";
                    }

                    foreach ($countStats as $stat){
                        $description = $stat["description"];
                        $value = $stat["value"];
                        $tags = trim($stat["tags"], "{}");
                        
                        echo "
                            <section class='card my-2'>
                                <div class='d-flex flex-col justify-content-between align-items-center card-body px-4'>
                                    <div>
                                        <h4>$description</h4>
                                        <p class='my-3'>tags: $tags</p>
                                    </div>
                                    <div class='d-flex flex-col align-items-center'>
                                        <div class='d-inline-block px-2'>
                                            <h1>$value</h1>
                                        </div>
                                    </div>
                                </div>
                            </section>         
                        ";
                    }
                    foreach ($rateStats as $stat){
                        $description = $stat["description"];
                        $numerator = $stat["numerator"];
                        $denominator = $stat["denominator"];
                        $rate = round($numerator/$denominator, 1);
                        $tags = trim($stat["tags"], "{}");
                        
                        echo "
                            <section class='card my-2'>
                                <div class='d-flex flex-col justify-content-between align-items-center card-body px-4'>
                                    <div>
                                        <h4>$description</h4>
                                        <p class='my-3'>tags: $tags</p>
                                    </div>
                                    <div class='d-flex flex-col align-items-center'>
                                        <div class='d-inline-block px-2'>
                                            <h1>$rate</h1>
                                        </div>
                                    </div>
                                </div>
                            </section>         
                        ";
                    }
                    foreach ($pctStats as $stat){
                        $description = $stat["description"];
                        $numerator = $stat["numerator"];
                        $denominator = $stat["denominator"];
                        $pct = round($numerator / $denominator * 100, 1) . '%';
                        $tags = trim($stat["tags"], "{}");
                        
                        echo "
                        <section class='card my-2'>
                            <div class='d-flex flex-col justify-content-between align-items-center card-body px-4'>
                                <div>
                                    <h4>$description</h4>
                                    <p class='my-3'>tags: $tags</p>
                                </div>
                                <div class='d-flex flex-col align-items-center'>
                                    <div class='d-inline-block px-2'>
                                        <h1>$pct</h1>
                                    </div>
                                </div>
                            </div>
                        </section>         
                        ";
                    }
                ?>
            </section>
            
            <section id="searchStatsList"></section>
            
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>

</html>
