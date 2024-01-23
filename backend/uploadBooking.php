<?php
session_start();
include 'db/conn.php';

// E-Mail-Funktion
function sendBookingNotification($start_date, $end_date) {
    $to = "k.arnold789@gmail.com"; 
    $subject = "Neue Buchung erhalten";
    $message = "Es wurde eine neue Buchung erhalten.\n\nDetails:\nStartdatum: $start_date\nEnddatum: $end_date";
    $headers = "From: k.arnold789gmail.com"; // Ersetze durch die echte Absender-E-Mail-Adresse


    if (mail($to, $subject, $message, $headers)) {
        echo "E-Mail wurde erfolgreich versendet.";
    } else {
        echo "Fehler beim Versenden der E-Mail.";
    }
}

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
            echo json_encode(["success" => false, "error" => "Die Wohnung ist für den ausgewählten Zeitraum nicht verfügbar."]);
        } else {
            // SQL-Query für das Einfügen der Werte in die Datenbank
            $sql = "INSERT INTO bookings (start_date, end_date, flat_id, user_id) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$start_date, $end_date, $flat_id, $user_id]);

            // Überprüfen, ob die Buchung erfolgreich war
            if ($stmt->rowCount() > 0) { 
                  // E-Mail-Benachrichtigung senden
                if(sendBookingNotification($start_date, $end_date)) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "error" => "Fehler beim Versenden der E-Mail."]);
                }
                
                // Weiterleitung zu checkout.php mit den relevanten Daten
                //header("Location: checkout.php?flat_id=" . urlencode($flat_id) . "&start_date=" . urlencode($start_date) . "&end_date=" . urlencode($end_date));

             

                exit; // Sicherstellen, dass kein weiterer Code nach der Weiterleitung ausgeführt wird
            } else {
                echo json_encode(["success" => false, "error" => "Fehler bei der Buchung."]);
            }
        }
    } catch (PDOException $e) {
        // Fehler entsprechend behandeln
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    // Handle invalid request method
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
