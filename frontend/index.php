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
        <?php require_once '../backend/db/conn.php'; ?>
    </header>

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

    <!-- Custom JavaScript for AJAX call -->
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
                            <div class="col-md-4 mb-3 d-flex align-items-stretch">
                                <div class="card">
                                    <img src="${imagePath}" class="card-img-top" alt="${flat.name}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">${flat.name}</h5>
                                        <p class="card-text mt-auto">Price: ${flat.price}</p>
                                        <p class="card-text mt-auto">Price: ${flat.location}</p>
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
    });
    </script>

</body>
</html>
