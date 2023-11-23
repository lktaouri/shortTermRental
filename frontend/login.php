<?php include 'includes/header.php'; ?>
<style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
<?php include 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            event.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                type: 'POST',
                url: '../backend/login.php',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    // Handle the server response here.
                    // For example, show a message or redirect the user.
                    alert(response);
                    if (response.trim() === "Login successful!") {
                        window.location.href = 'index.php'; // Redirect to a welcome page or dashboard
                    }
                },
                error: function(xhr, status, error) {
                    // Handle any errors here
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>
