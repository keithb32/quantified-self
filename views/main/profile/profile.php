<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <meta name="author" content="Keith Butler (kab7em)">
        <meta name="description" content="Quantify Yourself - your personal data tracker">
        <meta name="keywords" content="quantify yourself data tracker">        

        <title>Quantify Yourself</title>

        <link rel="icon" href="../../../assets/bar-chart.png">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous"> 
        <link href="../../../styles/main.css" rel="stylesheet">
        <script src="../../../scripts/profile.js" defer></script>
    </head>  
    
    <body>
        <!-- Navbar -->
        <div class="bg-light">
            <nav class="navbar navbar-expand-lg navbar-light container flex-row">
                         
                <!-- Logo -->
                <a class="nav-link" href="../index.php" role="button">
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
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../index.php?command=logout">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Main content-->
        <main class="container mt-5">

            <div class="row h-100">

                <!-- Profile sidebar -->
                <div class="col-8 col-md-4 mx-auto bg-light-subtle pb-5 mb-3">
                    <img id="profile-picture" class="mx-auto mt-5 mb-2" src="../../../assets/avatar.png" alt="avatar">
                    <p class="text-center px-0 display-6"><?= $name ?></p>
                    <p class="text-center px-0 fw-bold"><?= isset($year) ? "Member since $year" : ""?></p>
                    <hr>
                    <p class="text-center px-0 mb-2 fs-3">Summary</p>

                    <ul id="stats-list" class="mx-auto list-unstyled fs-5 fw-light">
                        <?= isset($numCounts) ? "<li>$numCounts counts</li>" : "" ?>
                        <?= isset($numRates) ? "<li>$numRates rates</li>" : "" ?>
                        <?= isset($numPercents) ? "<li>$numPercents percentages</li>" : "" ?>
                    </ul>
                </div>

                <!-- Profile Biography & Statistics-->
                <div class="col-8 mx-auto">
                    <section>
                        <h2>
                            Biography
                            <a id="editBioBtn" href="?command=editBio"><img src="../../../assets/pencil.png" class="edit-button" alt="pencil edit icon"></a>
                        </h2>
                        
                        <!-- Bio / Edit Bio form -->
                        <?php
                            $bioStr = isset($bio) ? $bio : "You do not currently have a bio. Click the pencil icon to add one!";

                            if ($action === "displayProfile"){
                                echo "<p id='bio' class='mb-4 fs-6'>$bioStr</p>";
                            }
                            elseif ($action == "editBio") {
                                echo "
                                    <form action='?command=updateBio' method='post'>
                                        <textarea id='bio' name='bio' class='w-100 form-control'>$bio</textarea>
                                        <div class='my-3'>
                                            <a href='?command=goToProfilePage' class='btn btn-outline-secondary'>Cancel edit</a>
                                            <button class='btn btn-outline-primary'>Save changes</button>
                                        </div>
                                    </form>
                                ";
                            }
                        ?>
                    </section>

                    <section>
                        <h2>
                            Featured Statistics
                        </h2>

                        <?php
                            if (!$countStats && !$rateStats && !$pctStats){
                                echo "<p class='lead my-2'>You currently don't have any featured statistics.</p>";
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
                </div>
            </div>
        </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
