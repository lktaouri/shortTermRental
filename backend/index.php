<?php
    include("db/conn.php");

    try {

        // Query to retrieve all flats
        $location = isset($_GET['location']) ? $_GET['location'] : '';

        if ($location !== '') {
            $sql = "SELECT * FROM flats WHERE location LIKE :location";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['location' => '%' . $location . '%']);
        } else {
            $sql = "SELECT * FROM flats";
            $stmt = $pdo->query($sql);
        }
    
        $flats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Returning data in JSON format
        header('Content-Type: application/json');
        echo json_encode($flats);

    } catch (PDOException $e) {
        // Error handling
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
?>
