<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Über uns</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/myStyle.css">
</head>
<body>
    <header>
        <?php include 'includes/header.php';
              require_once '../backend/db/conn.php'  ; ?>
    </header>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Hello, world!</h1>
    </div>
    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
</body>
</html>
