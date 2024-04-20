<?php
$servername = "localhost";
$username = "root"; // Cambiar por el nombre de usuario de tu base de datos
$password = "admin"; // Cambiar por la contraseña de tu base de datos
$dbname = "mercado"; // Cambiar por el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$stmt = $conn->prepare("CALL SP_REGISTRARUSUARIO(?, ?, ?, ?, ?, ?, @p_IdUsuarioResultado, @p_Mensaje)");
$stmt->bind_param("ssssii", $_POST['cedula'], $_POST['nombre'], $_POST['correo'], $_POST['clave'], $_POST['rol'], $_POST['estado']);

if ($stmt->execute()) {
    $result = $conn->query("SELECT @p_IdUsuarioResultado AS IdUsuarioResultado, @p_Mensaje AS Mensaje");
    $row = $result->fetch_assoc();
    $response = array(
        "mensaje" => $row['Mensaje']
    );
    echo json_encode($response);
} else {
    echo "Error al ejecutar el procedimiento almacenado: " . $stmt->error;
}

$conn->close();
?>
