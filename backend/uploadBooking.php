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
        // SQL-Query für das Einfügen der Werte in die Datenbank
        $sql = "INSERT INTO bookings (start_date, end_date, flat_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$start_date, $end_date, $flat_id, $user_id]);

        // Redirect to checkout.php with flat_id only if insertion is successful
        header("Location: checkout.php?flat_id=" . urlencode($flat_id) . "&start_date=" . urlencode($start_date) . "&end_date=" . urlencode($end_date));
        exit; // Make sure no further code is executed after redirect
    } catch (PDOException $e) {
        // Handle the error appropriately
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
        exit; // Prevent further execution in case of error
    }
} else {
    // Handle invalid request method
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
    exit; // Prevent further execution for invalid request method
}
?>
