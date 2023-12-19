<?php
include 'db/conn.php'; // Stelle sicher, dass der Pfad zur conn.php korrekt ist

// Daten aus dem Formular erfassen
$name = $_POST['name'];
$preis = $_POST['preis'];
$location = $_POST['location'];
$owner_id = $_POST['owner_id'];

// Dateiupload und Speicherung im Serververzeichnis
$target_dir = "../frontend/pics/";
$file_name = basename($_FILES["bild"]["name"]);
$target_file = $target_dir . $file_name;


if (move_uploaded_file($_FILES["bild"]["tmp_name"], $target_file)) {
    try {
        // SQL-Query für das Einfügen der Werte in die Datenbank
        $sql = "INSERT INTO flats (name, price, photo,location, owner_id) VALUES (?, ?, ?, ?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([ $name, $preis, $file_name,$location, $owner_id]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Datei konnte nicht hochgeladen werden"]);
}
?>
