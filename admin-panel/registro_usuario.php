<?php
$servername = "localhost";
$username = "root"; // Cambiar por el nombre de usuario de tu base de datos
$password = "admin"; // Cambiar por la contraseña de tu base de datos
$dbname = "mercadeo"; // Cambiar por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la llamada al procedimiento almacenado
$stmt = $conn->prepare("CALL SP_REGISTRARUSUARIO(?, ?, ?, ?, ?, ?, @p_IdUsuarioResultado, @p_Mensaje)");
$stmt->bind_param("ssssii", $_POST['cedula'], $_POST['nombreCompleto'], $_POST['correo'], $_POST['clave'], $_POST['rol'], $_POST['estado']);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Obtener los resultados de las variables de salida
    $result = $conn->query("SELECT @p_IdUsuarioResultado AS IdUsuarioResultado, @p_Mensaje AS Mensaje");
    $row = $result->fetch_assoc();
    $response = array(
        "idUsuarioResultado" => $row['IdUsuarioResultado'],
        "mensaje" => $row['Mensaje']
    );
    echo json_encode($response);
} else {
    echo "Error al ejecutar el procedimiento almacenado: " . $stmt->error;
}

// Cerrar la conexión
$conn->close();
?>
