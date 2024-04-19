<?php
$servername = "172.30.249.3";
$username = "root";
$password = "admin";
$database = "mercado";

// Obtener datos del formulario
$Cedula = $_POST['Cedula'];
$NombreCompleto = $_POST['NombreCompleto'];
$Correo = $_POST['Correo'];
$Clave = $_POST['Clave'];
$IdRol = $_POST['IdRol'];
$Estado = $_POST['Estado'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Llamar al procedimiento almacenado
$sql = "CALL SP_REGISTRARUSUARIO(?, ?, ?, ?, ?, ?, @p_Resultado, @p_Mensaje)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $Cedula, $NombreCompleto, $Correo, $Clave, $IdRol, $Estado);
$stmt->execute();


// Obtener el resultado del procedimiento almacenado
$result = $conn->query("SELECT @p_IdUsuarioResultado AS IdUsuarioResultado, @p_Mensaje AS Mensaje");
$row = $result->fetch_assoc();
// Crear una respuesta en formato JSON
$response = array(
    'IdUsuarioResultado' => $row['IdUsuarioResultado'],
    'mensaje' => $row['Mensaje']
);

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión
$conn->close();
?>
