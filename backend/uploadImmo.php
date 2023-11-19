<?php
include 'db/conn.php'; // Stelle sicher, dass der Pfad zur conn.php korrekt ist

// Daten aus dem Formular erfassen
$id = $_POST['id'];
$name = $_POST['name'];
$preis = $_POST['preis'];
$owner_id = $_POST['owner_id'];

// Dateiupload und Speicherung im Serververzeichnis
$target_dir = "pictures/";
$target_file = $target_dir . basename($_FILES["bild"]["name"]);

if (move_uploaded_file($_FILES["bild"]["tmp_name"], $target_file)) {
    try {
        // SQL-Query für das Einfügen der Werte in die Datenbank
        $sql = "INSERT INTO flats (id, name, price, photo, owner_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id, $name, $preis, $target_file, $owner_id]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Datei konnte nicht hochgeladen werden"]);
}
?>
