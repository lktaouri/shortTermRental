<?php  include 'includes/header.php'; ?>
<?php include 'includes/footer.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impressum</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/myStyle.css">
</head>
<body>
     <!--        Upload Form -->
     <div class="container mt-4">
        <h1>Neue Immobilie anlegen:</h1>
        <form id="newProductForm">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="preis" class="form-label">Preis:</label>
                <input class="form-control" id="preis" name="preis"required></input>
            </div>
            <div class="mb-3">
                <label for="bild" class="form-label">Bild hochladen:</label>
                <input type="file" class="form-control" id="bild" name="bild">
            </div>
            <div class="mb-3">
                <label for="owner_id" class="form-label">Owner-ID:</label>
                <input type="int" class="form-control" id="owner_id" name="owner_id" value="1">
            </div>
            <button type="button" id="newImmo" class="btn btn-primary">Neue Immobilie hinzufügen</button>
        </form>
    </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

     <!-- Custom JavaScript for AJAX call -->
     <script>
        $(document).ready(function() {
            $('#newImmo').click(function() {
                handleNewImmo();
            });
        });

        function handleNewImmo() {
            // Erfasse die Formulardaten
            let name = $('#name').val();
            let preis = $('#preis').val();
            let bild = $('#bild')[0].files[0];
            let owner_id = $('#owner_id').val();

            // Erstelle ein FormData-Objekt
            let formData = new FormData();
            formData.append('name', name);
            formData.append('preis', preis);
            formData.append('bild', bild);
            formData.append('owner_id', owner_id);

            // Sende die Daten per AJAX an den PHP-Endpunkt
            $.ajax({
                url: '../backend/uploadImmo.php', // Passe den Pfad an
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response); // Handle die Rückgabe des Servers
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    
</body>
<html>