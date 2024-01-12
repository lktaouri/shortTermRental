<?php
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Daten aus der Anfrage erfassen
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $location = isset($_GET['location']) ? $_GET['location'] : '';

    try {
        // SQL-Query, um verfügbare Flats für den angegebenen Zeitraum abzurufen
        $sql = "SELECT * FROM flats 
                WHERE id NOT IN (
                    SELECT flat_id FROM bookings 
                    WHERE (start_date BETWEEN ? AND ?) OR (end_date BETWEEN ? AND ?)
                    OR (start_date <= ? AND end_date >= ?)
                )";

        // Wenn die Location vorhanden ist, füge den Location-Filter hinzu
        if ($location !== '') {
            $sql .= " AND location LIKE ?";
        }

        $stmt = $pdo->prepare($sql);

        // Wenn die Location vorhanden ist, füge den Location-Wert zum Parameter-Array hinzu
        $params = [$start_date, $end_date, $start_date, $end_date, $start_date, $end_date];
        if ($location !== '') {
            $params[] = '%' . $location . '%';
        }

        $stmt->execute($params);

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
