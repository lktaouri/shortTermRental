<?php
include 'db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Daten aus dem Formular erfassen
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $flat_id = $_POST['flat_id']; // Die flat_id aus dem Formular erfassen
    $user_id = $_POST['user_id'];

    try {
        // SQL-Query für das Einfügen der Werte in die Datenbank
        $sql = "INSERT INTO bookings (start_date, end_date, flat_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$start_date, $end_date, $flat_id, $user_id]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
