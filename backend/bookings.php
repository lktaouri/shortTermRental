<?php
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // SQL-Query, um alle Buchungen aus der Datenbank abzurufen
        $sql = "SELECT bookings.*, flats.price 
                FROM bookings 
                JOIN flats ON bookings.flat_id = flats.id";
        $stmt = $pdo->query($sql);

        // Daten in ein assoziatives Array konvertieren
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($bookings);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
