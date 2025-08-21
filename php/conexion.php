<?php
/*
$host = "localhost"; 
$usuario = "elbuenamigo_base";
$contrasena = "Los3pelotudos";
$base_de_datos = "elbuenamigo_veterinaria"; 

ESTO ES PARA CUANDO LA SUBIMOS AL SERVER

*/

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Opcional: establecer charset a utf8
$conn->set_charset("utf8");

// Si todo está bien, puedes usar $conn en tus consultas
?>