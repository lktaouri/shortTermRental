<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/myStyle.css">
</head>

<body>
<header>
    <?php include 'includes/header.php'; ?>
</header>
    <div class="login-form">
        <form method="post" id="login-form">
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="E-Mail" id="email" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" id="password" required="required">
            </div>
            <div class="form-group">
                <button type="button" id="loginBtn" class="btn1">Login</button>
            </div>
        </form>
        <p class="text-center" style="padding-top: 20px;"><a href="registration.php">No account? Sign up here!</a></p>
    </div>
    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
</body>
<script src="js/login.js"></script>

</html>