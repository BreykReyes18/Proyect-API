<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se enviaron el nombre de usuario y la contraseña
    if (isset($_POST['Cedula'], $_POST['Clave'])) {
        $Cedula = $_POST['Cedula'];
        $Clave = $_POST['Clave'];

        // Conectar a la base de datos (cambia estos valores según tu configuración)
        $servername = "localhost";
        $username_db = "root";
        $password_db = "admin";
        $dbname = "mercado";

        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        // Verificar si la conexión se realizó correctamente
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Preparar la consulta SQL para obtener el usuario de la base de datos
        $stmt = $conn->prepare("SELECT IdUsuario, Cedula, Clave FROM usuario WHERE Cedula = ?");
        $stmt->bind_param("s", $Cedula);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró un usuario con ese nombre de usuario
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
            if (password_verify($Clave, $row['Clave'])) {
                // Inicio de sesión exitoso
                $_SESSION['usuario'] = $row['Cedula'];
                $response = array(
                    "mensaje" => "Inicio de sesión exitoso",
                    "redireccionar" => "formulario.html" // Redirigir a la página de inicio
                );
            } else {
                // Contraseña incorrecta
                $response = array(
                    "mensaje" => "Contraseña incorrecta"
                );
            }
        } else {
            // Usuario no encontrado
            $response = array(
                "mensaje" => "Usuario no encontrado"
            );
        }

        // Cerrar la conexión a la base de datos
        $stmt->close();
        $conn->close();

        // Devolver la respuesta como JSON
        echo json_encode($response);
    }
}
?>
