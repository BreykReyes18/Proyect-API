<?php
$servidor="localhost";
$baseDeDatos="mercado";
$usuario="root";
$clave="admin";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$clave);
    echo "Conexión exitosa";

} catch (Exception $error) {

    echo $error->getMessage();
    
}
