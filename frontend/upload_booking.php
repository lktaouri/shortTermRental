<body>
    <header>
        <?php include 'includes/header.php'; ?>>
    </header>
     <!--        Upload Form -->
     <div class="container mt-4">
        <h1>Neue Buchung anlegen:</h1>
        <form id="newProductForm">
            <div class="mb-3">
                <label for="start_date" class="form-label">Anreisedatum:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Abreisedatum:</label>
                <input type="date" class="form-control" id="end_date" name="end_date"required></input>
            </div>
           <!-- Hier wird die flat_id als hidden input Feld hinzugefügt -->
           <input type="hidden" id="flat_id" name="flat_id">
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="int" class="form-control" id="user_id" name="user_id" value="1">
            </div>
            <button type="button" id="newBooking" class="btn btn-primary">Buchung bestätigen</button>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

     <!-- Custom JavaScript for AJAX call -->
     <script>
        $(document).ready(function() {
            $('.flat-card').on('click', function() {
                let flatId = $(this).data('flat-id'); // Flat ID aus dem data-Attribut der Karte lesen
                $('#flat_id').val(flatId); // Setze die flat_id im hidden input Feld des Formulars
            });

            $('#newBooking').click(function() {
                handleNewBooking();
            });
        });

        function handleNewBooking() {
            // Erfasse die Formulardaten
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            let flat_id=$('#flat_id').val();
            let user_id = $('#user_id').val();

            // Erstelle ein FormData-Objekt
            let formData = new FormData();
            formData.append('start_date', start_date);
            formData.append('end_date', end_date);
            formData.append('flat_id', flat_id);
            formData.append('user_id', user_id);

            // Sende die Daten per AJAX an den PHP-Endpunkt
            $.ajax({
                url: '../backend/uploadBooking.php', // Passe den Pfad an
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert("Buchung erfolgreich angelegt");
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