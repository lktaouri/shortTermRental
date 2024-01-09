<?php
include("db/conn.php");

try {
    // Überprüfe, ob flat_id in der Anfrage vorhanden ist
    if (isset($_GET['flat_id'])) {
        $flat_id = $_GET['flat_id'];

        // Abfrage, um die Flat-Daten für die angegebene flat_id zu erhalten
        $sql = "SELECT * FROM flats WHERE id = :flat_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['flat_id' => $flat_id]);

        // Flat-Daten abrufen
        $flat = $stmt->fetch(PDO::FETCH_ASSOC);

        // Überprüfe, ob Flat-Daten gefunden wurden
        if ($flat) {
            // Daten in JSON-Format zurückgeben
            header('Content-Type: application/json');
            echo json_encode($flat);
        } else {
            // Fehlermeldung zurückgeben, wenn keine Flat-Daten gefunden wurden
            http_response_code(404);
            echo json_encode(['error' => 'Flat not found']);
        }
    } else {
        // Fehlermeldung zurückgeben, wenn keine flat_id in der Anfrage vorhanden ist
        http_response_code(400);
        echo json_encode(['error' => 'flat_id parameter is missing']);
    }
} catch (PDOException $e) {
    // Fehlerbehandlung
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>




