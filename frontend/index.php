        <?php include 'includes/header.php'; ?>
        <?php require_once '../backend/db/conn.php'; ?>
  
        <script type="text/javascript">
        // Ensure PHP session is started before this
        var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>
    <div class="container mt-3">
        <input type="text" id="searchBar" class="form-control" placeholder="Search by location">
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Our Flats</h1>
        <div id="flats-container" class="row"> 
            <!-- Flats will be displayed here -->
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for AJAX call and Event Handling -->
    <script>
    $(document).ready(function() {
        loadFlats('');

        $('#searchBar').on('input', function() {
            var searchQuery = $(this).val();
            loadFlats(searchQuery);
        });

        function loadFlats(query) {
            $.ajax({
                url: '../backend/index.php',
                type: 'GET',
                data: { location: query },
                dataType: 'json',
                success: function(flats) {
                    $('#flats-container').empty();
                    flats.forEach(function(flat) {
                        var imagePath = 'pics/' + flat.photo;
                        var flatCard = `
                            <div class="col-md-4 mb-3 d-flex align-items-stretch" data-flat-id="${flat.id}">
                                <div class="card">
                                    <img src="${imagePath}" class="card-img-top" alt="${flat.name}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">${flat.name}</h5>
                                        <p class="card-text mt-auto">Price: ${flat.price}</p>
                                        <p class="card-text mt-auto">Location: ${flat.location}</p>
                                        <a class="btn btn-primary" href="upload_booking.php">Buchen</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#flats-container').append(flatCard);
                    });
                },
                error: function(xhr, status, error) {
                    $('#flats-container').html(`<p>Error: ${error}</p>`);
                }
            });
        }

        // Corrected Event Delegation for Buchen Button
        $(document).on('click', '.btn-primary', function(e) {
            e.preventDefault();

            if (!isLoggedIn) {
                window.location.href = 'login.php'; // Redirect to login page
                return; // Stop further execution
            }

            var flatId = $(this).closest('.col-md-4').data('flat-id');
            window.location.href = `upload_booking.php?flat_id=${flatId}`;
        });
    });
    </script>
</body>
</html>
