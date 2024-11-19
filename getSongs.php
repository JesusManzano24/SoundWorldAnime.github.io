<?php
include "config.php"; // Incluir configuración de la base de datos

// Obtener el ID de la playlist desde la URL
$playlist_id = isset($_GET['playlist_id']) ? intval($_GET['playlist_id']) : 0;

if ($playlist_id > 0) {
    $query = "SELECT id, title, artist FROM songs WHERE playlist_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $playlist_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $songs = [];
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }

    echo json_encode($songs); // Devolver los datos como JSON
} else {
    echo json_encode(["error" => "ID de playlist inválido"]);
}

$conn->close();
?>
