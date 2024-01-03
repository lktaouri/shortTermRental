<?php
session_start();
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // SQL-Query to retrieve all bookings from the database
        $sql = "SELECT bookings.*, flats.price 
                FROM bookings 
                JOIN flats ON bookings.flat_id = flats.id WHERE user_id = :user_id"; // Placeholder for user_id
        $stmt = $pdo->prepare($sql);

        // Binding the session variable to the placeholder
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Convert data to an associative array
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($bookings);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
