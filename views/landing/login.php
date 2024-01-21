<!-- Resources used:

1. Bootstrap v5.3.2 (https://getbootstrap.com/docs/5.3/getting-started/introduction/)
2. Pixabay - for royalty-free images that do not require attribution (https://pixabay.com/)

URL: https://cs4640.cs.virginia.edu/kab7em/quantify-yourself
-->

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

        <link rel="icon" href="../assets/bar-chart.png">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous"> 
        <link href="../../styles/main.css" rel="stylesheet">
        <link href="../../styles/landing.css" rel="stylesheet">
        <script src="../../scripts/login.js" defer></script>
    </head>  
    
    <body class="d-flex justify-content-between align-items-center">
        <div class="container d-flex justify-content-between align-items-center my-auto flex-wrap">
            <!-- Header-->
            <header id="header" class="text-center mx-auto">
                <h5 class="display-6">Welcome to</h5>
                <h1 class="display-2 fw-bold">Quantify Yourself</h1>
                <h6 class="display-6">Your personal data tracker ™</h6>

                <div class="my-4">
                    <img src="../../assets/line-graph.png" alt="line graph" class="mx-3" height="100" width="100">
                    <img src="../../assets/bar-chart.png" alt="bar chart" class="mx-3" height="100" width="100">
                    <img src="../../assets/pie-chart.png" alt="pie chart" class="mx-3 d-none d-sm-inline-block" height="100" width="100">
                </div>
            </header>

            <!-- Login -->
            <section class="mx-auto">
                <div id="login-card" class="card border border-black mx-auto mt-3 px-5 shadow">
                    <h2 class="text-center my-3">Sign in</h2>
                    <?= isset($alert) ? $alert : null ?>
                    <form action="?command=login" class="mx-auto", method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <input required type="email" class="form-control" id="email" name="email" aria-describedby="email">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input required type="password" class="form-control" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-outline-primary text-decoration-none d-block w-50 mx-auto px-3">Login</button>
                    </form>
                    
                    <p class="text-center my-3">Don't have an account? <a href="?command=signUp">Sign up</a>.</p>
                </div>
            </section>
        </div>
        <div class="fixed-bottom m-2 d-none d-sm-block">
            <form action="">
                <input type="color" id="color-picker" value="#53cbfb">
                <input type="submit" class="align-top" id="reset-bg-btn" value="Reset">
            </form>
        </div>
    </body>
</html>
