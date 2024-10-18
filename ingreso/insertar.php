<?php
$conexion = include('conexion.php'); // Asegúrate de que la conexión es correcta

// Obtener datos del formulario
$tipo_usuario = $_POST['tipo_usuario'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];

// Cifrar la contraseña
$contraseña_cifrada = password_hash($contraseña, PASSWORD_DEFAULT);

// Consulta para insertar el nuevo usuario
$insertar = "INSERT INTO Usuarios (tipo_usuario, nombre, email, contraseña) VALUES ('$tipo_usuario', '$nombre', '$email', '$contraseña_cifrada')";
$result = mysqli_query($conexion, $insertar);

if (!$result) {
    die("Error al agregar el usuario: " . mysqli_error($conexion));
}

echo "Usuario agregado correctamente.";
?>

<form action="index.html" method="get">
    <button type="submit">Regresar al Inicio</button>
</form>