<head>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/buchung.css">
</head>
<body>
    <header>
        <?php include 'includes/header.php'; ?>
    </header>
    <!-- Booking Form -->
    <div class="container mt-4 new-booking-form">
        <h1>Neue Buchung anlegen:</h1>
        <form id="newProductForm" action="../backend/uploadBooking.php" method="post">
            <div class="mb-3">
                <label for="start_date" class="form-label">Anreisedatum:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Abreisedatum:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <!-- Hidden field for flat_id -->
            <input type="hidden" id="flat_id" name="flat_id" value="<?php echo isset($_GET['flat_id']) ? htmlspecialchars($_GET['flat_id']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Weiter zur Zahlung</button>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            // Set flat_id in the hidden input field when a flat card is clicked
            $('.flat-card').on('click', function() {
                let flatId = $(this).data('flat-id');
                $('#flat_id').val(flatId);
            });
        });
    </script>
</body>
</html>

