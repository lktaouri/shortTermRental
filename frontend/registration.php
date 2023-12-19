<head>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/registrationstyle.css">
</head>
<body>
    <header>
        <?php include 'includes/header.php'; ?>>
    </header>
<div class="register-form">
    <h2>Register</h2>
    <form id="registrationForm">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" required>
        </div>
        <div class="form-group">
            <label for="paymentMethodId">Payment Method ID:</label>
            <input type="number" class="form-control" id="paymentMethodId" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registrationForm').submit(function(event) {
            event.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();
            var paymentMethodId = $('#paymentMethodId').val();

            $.ajax({
                type: 'POST',
                url: '../backend/registration.php',
                data: {
                    email: email,
                    password: password,
                    payment_method_id: paymentMethodId
                },
                success: function(response) {
                    // You can handle the server response here.
                    // For example, show a message or redirect the user.
                    alert(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors here
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>

