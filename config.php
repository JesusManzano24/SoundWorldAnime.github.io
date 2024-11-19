<?php
// Configuración de la base de datos
$host = "localhost"; // Servidor (en este caso, tu computadora local)
$user = "root";      // Usuario de MySQL (por defecto es "root")
$password = "2004";      // Contraseña del usuario (deja vacío si no tienes contraseña)
$dbname = "sound_world_anime"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
