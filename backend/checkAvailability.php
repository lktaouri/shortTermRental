<?php
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Daten aus der Anfrage erfassen
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    try {
        // SQL-Query, um verfügbare Flats für den angegebenen Zeitraum abzurufen
        $sql = "SELECT * FROM flats 
                WHERE id NOT IN (
                    SELECT flat_id FROM bookings 
                    WHERE (start_date BETWEEN ? AND ?) OR (end_date BETWEEN ? AND ?)
                    OR (start_date <= ? AND end_date >= ?)
                )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$start_date, $end_date, $start_date, $end_date, $start_date, $end_date]);

        // Daten in ein assoziatives Array konvertieren
        $availableFlats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($availableFlats);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
