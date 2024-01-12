<?php
// Start the session
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/myStyle.css">
<style>
        .header {
            background-color: #031a30;
            color: #ffffff;
            padding: 0;
            width: 100%;
            text-align: center;
            position: fixed;
            top: 0;
            z-index: 1030;
        }
    </style>

<title>Short Term Rental</title>
  </head>
  <body>
      <header>
        <div class="header">
          <!-- Linkes Bild -->
        <img src="pics/projektlogo.png" alt="Linkes Bild" class="navbar-brand"  style="width: 50px; height: 70px;">
              <a class="navbar-brand" href="index.php">Startseite</a>
              <?php
        // Check if the user is logged in and has the role of 'admin'
        if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'ADMIN') {
            echo '<a class="navbar-brand" href="upload_immo.php">Immobilien hinzufügen</a>';
        }
        ?>
              <?php
        if(isset($_SESSION['user_id'])) {
          echo '<a class="navbar-brand" href="booking_management.php">Meine Buchungen</a>';
        }
        if(!isset($_SESSION['user_id'])) {
          echo '<a class="navbar-brand" href="registration.php">Registrierung</a>
                <a class="navbar-brand" href="login.php">Login</a>';
        }
        ?>
              <?php
        // Display logout link only if the user is logged in
        if(isset($_SESSION['user_id'])) {
            echo '<a class="navbar-brand" id="logoutLink" href="#">Logout</a>';
        }
        ?>  

        <!-- Rechtes Bild -->
        <img src="pics/projektlogo.png" alt="Rechtes Bild" class="navbar-brand"  style="width: 50px; height: 70px;">    

      </div>
        
      </header>

      <script>
  $(document).ready(function() {
    $('#logoutLink').on('click', function(e) { // Corrected this line
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '../backend/logout.php',
        success: function(response) {
          // Handle the response here. For example, redirect to login page
          alert('Logged out successfully');
          window.location.href = 'login.php';
        },
        error: function() {
          alert('Logout failed');
        }
      });
    });
  });
</script>
