<?php
$servidor="localhost";
$baseDeDatos="mercado";
$usuario="root";
$contraseña="";

try {

    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contraseña);
    echo "Conexión exitosa";

} catch (Exception $error) {

    echo $error->getMessage();
    
}
