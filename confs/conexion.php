<?php
$servername = "172.30.249.47"; // Cambia esto si tu servidor MySQL está en otro lugar
$username = "root"; // Nombre de usuario de MySQL
$password = "admin"; // Contraseña de MySQL
$database = "prueba-ecommerce"; // Nombre de la base de datos a la que quieres conectarte

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch(PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
