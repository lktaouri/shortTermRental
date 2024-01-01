<?php
session_start(); // Start the session at the top of the script
include 'db/conn.php';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve data from POST request
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Basic validation (should be more robust in production)
        if (empty($email) || empty($password)) {
            echo "Please fill all the required fields.";
            exit;
        }

        // Check if the user already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email_address = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo "User already exists.";
            exit;
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query for user registration
        $sql = "INSERT INTO users (email_address, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);

        // Execute the query
        $stmt->execute([$email, $hashedPassword]);

        // Retrieve the newly created user's data for session
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email_address = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set session variables
        $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the user identifier in your database
        $_SESSION['user_email'] = $user['email_address']; // Store email
        $_SESSION['user_role'] = $user['role']; // Assuming 'role' is a column in your database

        echo "Registration successful!";
    } else {
        echo "Invalid request method.";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>
