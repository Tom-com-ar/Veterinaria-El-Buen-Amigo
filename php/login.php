<?php
include 'conexion.php';

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT id, hash_pass, nombre FROM clientes WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hash_pass, $nombre);
    $stmt->fetch();
    if (password_verify($contrasena, $hash_pass)) {
    // Login correcto
    session_start();
    $_SESSION['cliente_id'] = $id;
    $_SESSION['cliente_nombre'] = $nombre;
    header('Location: ../home.html');
    exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
$stmt->close();
$conn->close();
?>