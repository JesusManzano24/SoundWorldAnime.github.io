<?php
// Incluye el archivo de configuración para la conexión a la base de datos
include 'config.php';

// Inicia la sesión
session_start();

// Verifica que los datos se hayan enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Valida que los campos no estén vacíos
    if (!empty($username) && !empty($password)) {
        // Consulta para buscar al usuario por nombre de usuario
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            // Verifica si se encontró un usuario
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $dbUsername, $dbPassword);
                $stmt->fetch();

                // Verifica la contraseña
                if (password_verify($password, $dbPassword)) {
                    // Autenticación exitosa
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $dbUsername;
                    echo "Inicio de sesión exitoso. ¡Bienvenido, $dbUsername!";
                } else {
                    echo "Contraseña incorrecta.";
                }
            } else {
                echo "Usuario no encontrado.";
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
