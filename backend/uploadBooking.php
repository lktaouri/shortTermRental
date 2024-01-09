<?php
session_start();
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Daten aus dem Formular erfassen
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $flat_id = $_POST['flat_id']; // Die flat_id aus dem Formular erfassen
    $user_id = $_SESSION['user_id'];

    try {
        // Überprüfen, ob die Wohnung für den gesamten Zeitraum verfügbar ist
        $sql = "SELECT id FROM bookings 
                WHERE flat_id = ? 
                AND ((start_date BETWEEN ? AND ?) OR (end_date BETWEEN ? AND ?))";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$flat_id, $start_date, $end_date, $start_date, $end_date]);
        $existingBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($existingBookings) > 0) {
            echo "<script>alert('Die Wohnung ist für den ausgewählten Zeitraum nicht verfügbar.'); window.location.href = 'index.php';</script>";
            exit; // Sicherstellen, dass kein weiterer Code nach der Weiterleitung ausgeführt wird
        }

        // SQL-Query für das Einfügen der Werte in die Datenbank
        $sql = "INSERT INTO bookings (start_date, end_date, flat_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$start_date, $end_date, $flat_id, $user_id]);

        // Überprüfen, ob die Buchung erfolgreich war
        if ($stmt->rowCount() > 0) {
            // Weiterleitung zu checkout.php mit den relevanten Daten
            header("Location: checkout.php?flat_id=" . urlencode($flat_id) . "&start_date=" . urlencode($start_date) . "&end_date=" . urlencode($end_date));
            exit; // Sicherstellen, dass kein weiterer Code nach der Weiterleitung ausgeführt wird
        } else {
            echo "<script>alert('Fehler bei der Buchung.');</script>";
        }
    } catch (PDOException $e) {
        // Fehler entsprechend behandeln
        echo "<script>alert('Fehler bei der Buchung: " . $e->getMessage() . "');</script>";
    }
} else {
    // Ungültige Anfrage-Methode behandeln
    echo "<script>alert('Ungültige Anfrage-Methode.');</script>";
}
?>
