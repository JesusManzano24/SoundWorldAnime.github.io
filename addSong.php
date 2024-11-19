<?php
include "config.php"; // Incluir configuración de la base de datos

// Verificar si los datos fueron enviados por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = isset($_POST['title']) ? trim($_POST['title']) : "";
    $artist = isset($_POST['artist']) ? trim($_POST['artist']) : "";
    $playlist_id = isset($_POST['playlist_id']) ? intval($_POST['playlist_id']) : 0;

    if (!empty($title) && $playlist_id > 0) {
        $query = "INSERT INTO songs (playlist_id, title, artist) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $playlist_id, $title, $artist);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Canción agregada correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al agregar la canción"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    }
}

$conn->close();
?>
