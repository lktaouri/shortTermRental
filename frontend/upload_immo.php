
<head>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/upload.css">
</head>
<body>
    <header>
        <?php include 'includes/header.php'; ?>
    </header>
     <!--        Upload Form -->
     <div class="upload-form">
    <h1>Neue Immobilie anlegen:</h1>
    <form id="newProductForm">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="preis" class="form-label">Preis:</label>
            <input type="int" class="form-control" id="preis" name="preis" required></input>
        </div>
        <div class="mb-3">
            <label for="bild" class="form-label">Bild hochladen:</label>
            <input type="file" class="form-control" id="bild" name="bild">
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location:</label>
            <input class="form-control" id="location" name="location" required></input>
        </div>
        <div class="mb-3">
            <label for="owner_id" class="form-label">Owner-ID:</label>
            <input type="int" class="form-control" id="owner_id" name="owner_id" value="1">
        </div>
        <button type="button" id="newImmo" class="btn btn-primary">Neue Immobilie hinzufügen</button>
    </form>
</div>

    <?php include 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
            let location=$('#location').val();
            let owner_id = $('#owner_id').val();

            // Erstelle ein FormData-Objekt
            let formData = new FormData();
            formData.append('name', name);
            formData.append('preis', preis);
            formData.append('bild', bild);
            formData.append('location', location);
            formData.append('owner_id', owner_id);

            // Sende die Daten per AJAX an den PHP-Endpunkt
            $.ajax({
                url: '../backend/uploadImmo.php', // Passe den Pfad an
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert("Immobilie erfolgreich angelegt");
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