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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../../scripts/signup.js"></script>
    </head>  
    
    <body class="d-flex justify-content-between align-items-center">
        <div class="container d-flex justify-content-between align-items-center my-auto flex-wrap">

            <!-- Sign up -->
            <section class="mx-auto w-100">
                <div id="login-card" class="card border border-black mx-auto mt-3 px-5 shadow">
                
                    <h2 class="text-center my-3">Create your account</h2>
                    <?= isset($alert) ? $alert : null ?>
                    <form action="?command=register" class="mx-auto w-75 w-sm-100" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text" class="form-control" id="name" name="name" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input required type="email" class="form-control" id="email" name="email" aria-describedby="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input required type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-4">
                            <label for="confirm-password" class="form-label">Confirm password</label>
                            <input required type="password" class="form-control" name="passwordConfirm" id="confirm-password">
                        </div>
                        <button type="submit" id="signup-btn" class="btn btn-outline-primary px-5 d-block mx-auto w-75 text-decoration-none">Sign up</button>
                    </form>

                    <p class="text-center my-3">Already have an account? <a href="index.php">Sign in</a>.</p>
                </div>
            </section>
        </div>
    </body>
</html>
