<?php
$servername = "localhost";
$username = "root"; // Cambiar por el nombre de usuario de tu base de datos
$password = "admin"; // Cambiar por la contraseña de tu base de datos
$dbname = "mercado"; // Cambiar por el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Preparar la llamada al procedimiento almacenado
$stmt = $conn->prepare("CALL SP_REGISTRARUSUARIO(?, ?, ?, ?, ?, ?, @p_IdUsuarioResultado, @p_Mensaje)");

// Verificar si la preparación fue exitosa
if ($stmt === false) {
    die("Error al preparar el procedimiento almacenado: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssii", $_POST['codigo'], $_POST['nombre'], $_POST['correo'], $_POST['clave'], $_POST['rol'], $_POST['estado']);

// Ejecutar el procedimiento almacenado
if ($stmt->execute()) {
    // Obtener el resultado del procedimiento almacenado
    $result = $conn->query("SELECT @p_IdUsuarioResultado AS IdUsuarioResultado, @p_Mensaje AS Mensaje");
    $row = $result->fetch_assoc();

    $response = array(
        "mensaje" => $row['Mensaje']
    );

    echo json_encode($response);
} else {
    echo "Error al ejecutar el procedimiento almacenado: " . $stmt->error;
}

// Cerrar la conexión
$conn->close();
?>
