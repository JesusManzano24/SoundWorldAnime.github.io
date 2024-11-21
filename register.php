<?php
// Incluye el archivo de configuración para la conexión a la base de datos
include 'config.php';

// Verifica que los datos se hayan enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Valida que los campos no estén vacíos
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Encripta la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Inserta los datos en la base de datos
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            if ($stmt->execute()) {
                echo "Registro exitoso. ¡Bienvenido, $username!";
            } else {
                echo "Error al registrar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$conn->close();
?>
