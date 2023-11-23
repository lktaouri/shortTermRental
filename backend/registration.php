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
        $paymentMethodId = $_POST['payment_method_id'] ?? '';

        // Basic validation (should be more robust in production)
        if (empty($email) || empty($password) || empty($paymentMethodId)) {
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

        // Prepare SQL query
        $sql = "INSERT INTO users (email_address, password, payment_method_id) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Execute the query
        $stmt->execute([$email, $hashedPassword, $paymentMethodId]);

        echo "Registration successful!";
    } else {
        echo "Invalid request method.";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>
