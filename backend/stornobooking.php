<?php
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Überprüfen, ob 'booking_id' im POST-Datenarray gesetzt ist
    if (isset($_POST['booking_id'])) {
        // Daten aus dem Formular erfassen
        $booking_id = $_POST['booking_id'];

        try {
            // SQL-Query für die Stornierung
            $sql = "DELETE FROM bookings WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$booking_id]);

            echo json_encode(["success" => true]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Booking ID not provided"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
