<?php
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

        // Prepare SQL query to select the user
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email_address = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Login successful
                // Start session, store user data, etc.

                echo "Login successful!";
            } else {
                // Password does not match
                echo "Invalid password.";
            }
        } else {
            // User does not exist
            echo "Invalid email .";
        }
    } else {
        echo "Invalid request method.";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>
