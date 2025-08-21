<?php
include 'conexion.php';

// Recibe datos del formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

// Encriptar la contraseña
$hash_pass = password_hash($contrasena, PASSWORD_DEFAULT);

// Verificar si el email ya existe
$sql_check = "SELECT id FROM clientes WHERE email = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "El email ya está registrado.";
} else {
    // Insertar nuevo cliente
    $sql = "INSERT INTO clientes (nombre, apellido, email, hash_pass, telefono, direccion, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $email, $hash_pass, $telefono, $direccion);

    if ($stmt->execute()) {
    header('Location: ../home.html');
    exit();
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}
$stmt->close();
$conn->close();
?>