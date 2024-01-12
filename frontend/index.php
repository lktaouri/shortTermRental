<?php include 'includes/header.php'; ?>
<?php require_once '../backend/db/conn.php'; ?>

<script type="text/javascript">
    // Ensure PHP session is started before this
    var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
</script>

<div class="container mt-3">
    <form id="availability-form">
        <div class="mb-3">
            <label for="availability_start_date" class="form-label">Startdatum:</label>
            <input type="date" class="form-control" id="availability_start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="availability_end_date" class="form-label">Enddatum:</label>
            <input type="date" class="form-control" id="availability_end_date" name="end_date" required>
        </div>
        <!-- Neues Formularfeld für die Location -->
        <div class="mb-3">
            <label for="availability_location" class="form-label">Location:</label>
            <input type="text" class="form-control" id="availability_location" name="location">
        </div>
        <button type="button" class="btn btn-primary" onclick="checkAvailability()">Verfügbare Flats anzeigen</button>
    </form>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Verfügbare Flats</h1>
    <div id="available-flats-container" class="row">
        <!-- Verfügbare Flats werden hier angezeigt -->
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript for AJAX call and Event Handling -->
<script>
    function checkAvailability() {
    var start_date = $('#availability_start_date').val();
    var end_date = $('#availability_end_date').val();
    var location = $('#availability_location').val();

    $.ajax({
        url: '../backend/checkAvailability.php',
        type: 'GET',
        data: { start_date: start_date, end_date: end_date, location: location },
        dataType: 'json',
        success: function(availableFlats) {
            // Überprüfen Sie, ob die Antwort ein Array ist
            if (Array.isArray(availableFlats)) {
                // Display available flats
                $('#available-flats-container').empty();
                availableFlats.forEach(function(flat) {
                    var imagePath = 'pics/' + flat.photo;
                    var flatCard = `
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="${imagePath}" class="card-img-top" alt="${flat.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${flat.name}</h5>
                                    <p class="card-text">Price: ${flat.price}</p>
                                    <p class="card-text">Location: ${flat.location}</p>
                                    <a class="btn btn-primary" href="upload_booking.php?flat_id=${flat.id}">Buchen</a>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#available-flats-container').append(flatCard);
                });
            } else {
                console.error('Invalid response format. Expected an array.');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
    $(document).ready(function() {
        checkAvailability();
    });
</script>
</body>
</html>
