<head>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/registrationstyle.css">
</head>
<body>
    <header>
        <?php include 'includes/header.php'; ?>
    </header>

    <div class="container mt-3">
        <h1 class="text-center">Buchungsverwaltung</h1>
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Buchungen</h1>
        <div id="bookings-container" class="row"> 
            <!-- Buchungen werden hier angezeigt -->
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Custom JavaScript for AJAX call -->
    <script>
        $(document).ready(function() {
            function loadBookings() {
    $.ajax({
        url: '../backend/bookings.php',
        type: 'GET',
        dataType: 'json',
        success: function(bookings) {
            $('#bookings-container').empty();

            bookings.forEach(function(booking, index) {
                // Lade die Daten der Flat für das Bild
                $.ajax({
                    url: '../backend/getFlat.php',
                    type: 'GET',
                    data: { flat_id: booking.flat_id },
                    dataType: 'json',
                    success: function(flat) {
                        var imagePath = 'pics/' + flat.photo;

                        // Erstelle die Buchungskarte hier, nachdem du die Flat-Daten erhalten hast
                        var cardClass;
                            if (bookings.length === 1) {
                                cardClass = 'col-md-6 mx-auto'; // Zentrierte Ausrichtung, wenn es nur eine Buchung gibt
                            } else if (bookings.length === 2) {
                                cardClass = 'col-md-6'; // Aufteilung der Breite auf 50%, wenn es zwei Buchungen gibt
                            } else if (bookings.length === 3) {
                                cardClass = 'col-md-4'; // Aufteilung der Breite auf 33.33%, wenn es drei Buchungen gibt
                            } else {
                                cardClass = 'col-md-4'; // Default: Aufteilung der Breite auf 33.33% für mehr als drei Buchungen
                            }

                        var bookingCard = `
                            <div class="${cardClass}" data-booking-id="${booking.id}">
                                <div class="card">
                                    <img src="${imagePath}" class="card-img-top" alt="${flat.name}">
                                    <div class="card-body">
                                        <h5 class="card-title">Buchungsnummer: ${booking.id}</h5>
                                        <p class="card-text">Anreisedatum: ${booking.start_date}</p>
                                        <p class="card-text">Abreisedatum: ${booking.end_date}</p>
                                        <p class="card-text">Wohnungs_ID: ${booking.flat_id}</p>
                                        <p class="card-text">Benutzer_ID: ${booking.user_id}</p>
                                        <p class="card-text">Preis: ${booking.price} EUR</p>
                                        <a class="btn btn-danger btn-storno" href="#">Stornieren</a>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Füge die Buchungskarte dem Container hinzu
                        $('#bookings-container').append(bookingCard);

                        // Füge den Event-Handler für Stornierung hinzu
                        $('#bookings-container').on('click', '.btn.btn-danger.btn-storno', function(e) {
    e.preventDefault();
    var bookingId = $(this).closest('[data-booking-id]').data('booking-id');
    handleStorno(bookingId);
});

                        // Füge die mx-auto-Klasse für die zentrierte Ausrichtung hinzu, wenn es nur eine Buchung gibt
                        if (bookings.length === 2) {
                            $('.col-md-6').addClass('mx-auto');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        },
        error: function(xhr, status, error) {
            $('#bookings-container').html(`<p>Error: ${error}</p>`);
        }
    });
}

            function handleStorno(bookingId) {
                $.ajax({
                    url: '../backend/stornobooking.php',
                    type: 'POST',
                    data: { booking_id: bookingId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert("Buchung erfolgreich storniert");
                            location.reload();
                        } else {
                            alert("Stornierung fehlgeschlagen. " + response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Rufe die Funktion loadBookings auf, nachdem alles bereit ist
            loadBookings();
        });
    </script>

</body>
</html>
