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
        <?php include 'includes/header.php'; ?>
    </header>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Über uns</h1>
        <h2 class="text-center mb-4">Vision</h2>
        <p>Die Technische Fachhochschule Wien plant die Entwicklung eines Tools für die kurzfristige Vermietung von Immobilien. Dieses Projekt fällt in den Verantwortungsbereich der Softwareentwicklung und Datenanalyse. Die Vision besteht darin, eine Website zu erstellen, die alle Aspekte der kurzfristigen Immobilienvermietung verwalten kann, ähnlich wie Plattformen wie Airbnb und Booking. Zusätzlich soll eine Schnittstelle zu Airbnb und anderen Plattformen entwickelt werden, um Angebote automatisch zu synchronisieren. Das Projekt soll einen repräsentatives Beispiel für öffentliche Veranstaltungen bieten, um die Fähigkeiten der Studenten der Technischen Universität Wien zu präsentieren. Christoph Waller ist der Kontaktperson für dieses Projekt und kann unter waller@technikum-wien.at kontaktiert werden.</p>
        <h2 class="text-center mb-4">Team</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="pics/add.png" class="img-fluid" alt="Teammitglied 1">
                    <h2>Mohammed Laktaoui</h2>
                    <p>Requirements Engineer</p>
                    <p>Developer</p>
                    <p>Software Designer</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="pfad/zu/bild2.jpg" class="img-fluid" alt="Teammitglied 2">
                    <h2>Clemens Karner</h2>
                    <p>Requirements Engineer</p>
                    <p>Devops Engineer</p>
                    <p>Project Manager</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="pics/Arnold.jpg" class="img-fluid" alt="Teammitglied 3">
                    <h2>Ar Kovacs</h2>
                    <p>Requirements Engineer</p>
                    <p>Tester</p>
                    <p>SCRUM Master</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
</body>
</html>
