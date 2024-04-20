<?php
$conexion = new mysqli("localhost", "usuario", "contraseña", "basededatos");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$cedula = $_POST['cedula'];
$nombreCompleto = $_POST['nombreCompleto'];
$correo = $_POST['correo'];
$clave = $_POST['clave'];
$rol = $_POST['rol'];
$estado = $_POST['estado'];

$stmt = $conexion->prepare("CALL SP_REGISTRARUSUARIO(?, ?, ?, ?, ?, ?, ?, @p_IdUsuarioResultado, @p_Mensaje)");
$stmt->bind_param("ssssii", $cedula, $nombreCompleto, $correo, $clave, $rol, $estado);
$stmt->execute();
$stmt->close();

$result = $conexion->query("SELECT @p_IdUsuarioResultado AS IdUsuarioResultado, @p_Mensaje AS Mensaje");
$row = $result->fetch_assoc();
$response = array(
    "idUsuarioResultado" => $row['IdUsuarioResultado'],
    "mensaje" => $row['Mensaje']
);
echo json_encode($response);

$conexion->close();
?>
