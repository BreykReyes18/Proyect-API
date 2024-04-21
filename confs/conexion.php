<?php
$servername = "172.30.249.3"; // Cambia esto si tu servidor MySQL está en otro lugar
$username = "root";
$password = "admin";
$database = "mercado";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "¡Conexión exitosa!";
}

// Cerrar la conexión
$conn->close();
?>