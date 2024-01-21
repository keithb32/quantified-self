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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../../../scripts/percent_statistic.js"></script>
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

        <!-- Count Statistic Form -->
        <section class="container mt-5 w-50 w-sm-100">
            <h2 class="text-center my-3">Percentage Statistic</h2>
            <p class="lead text-center">Fill out the following information to edit your percentage.</p>

            <div class="bg-light border border-black rounded-3 px-3 py-2 w-100 mx-auto">
                <form action="?command=updatePctStatistic&statId=<?= $statId ?>" method="post">
                    <div class="form-group row py-3">
                        <label for="pctDescription" class="col-sm-3 col-form-label fw-bold">Description <br> (required)</label>
                        <div class="col-sm-9">
                            <p>Fill in the blank: Percentage of 
                                <span id="pctDescriptionPlaceholder" class="text-decoration-underline">____</span>
                            </p>
                            <input required type="text" class="form-control w-75 w-sm-100" id="pctDescription" name="pctDescription" 
                            value="<?= $description ?>" placeholder="e.g. attempted free throws made">
                        </div>
                    </div>
                    <div class="form-group row py-3">
                        <label for="pctNumeratorValue" class="col-sm-3 col-form-label fw-bold">Numerator value <br> (required)</label>
                        <div class="col-sm-9">
                            <p>Enter the partial quantity.</p>
                            <input required type="number" class="form-control w-auto" id="pctNumeratorValue" name="pctNumeratorValue" 
                            value="<?= $numerator ?>" placeholder="e.g. 10">
                        </div>
                    </div>
                    <div class="form-group row py-3">
                        <label for="pctDenominatorValue" class="col-sm-3 col-form-label fw-bold">Denominator value <br> (required)</label>
                        <div class="col-sm-9">
                            <p>Enter the overall quantity.</p>
                            <input required type="number" class="form-control w-auto" id="pctDenominatorValue" name="pctDenominatorValue" 
                            value="<?= $denominator ?>" placeholder="e.g. 20">
                        </div>
                    </div>
                    <div class="form-group row py-3">
                        <label for="tags" class="col-sm-3 col-form-label fw-bold">Tags</label>
                        <div class="col-sm-9">
                            <p>Enter a series of space-separated keywords to optimize searches for your statistic.</p>
                            <input type="text" class="form-control w-75 w-sm-100" id="tags" name="tags" 
                            value="<?= $tags ?>" placeholder="e.g. basketball sports games">
                        </div>
                    </div>
                    <div class="form-group row py-3">
                    <label for="tags" class="col-sm-3 col-form-label pt-1 fw-bold">Feature on profile?</label>
                        <div class="col-sm-9">
                            <input class="align-middle" type="checkbox" name="featured" <?= $featured ?>>
                        </div>
                    </div>
                    <div class="text-end">
                        <a onclick="history.back()" class="btn btn-outline-secondary px-3 mx-2">Cancel</a>
                        <button type="submit" class="btn btn-outline-primary px-4 mx-2">Save</button>
                    </div>
                </form>
            </div>
            <form action="?command=deletePctStatistic&statId=<?= $statId ?>" method="post">
                <button type="submit" class="btn btn-outline-danger mt-3 px-4">Delete</button>
            </form>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>

</html>
