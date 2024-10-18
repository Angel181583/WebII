<?php
$conexion = include('conexion.php');
$usuario = $_POST['usuario'];
$pass = $_POST['contrasena'];

$consultar = "SELECT * FROM Usuarios WHERE nombre = '$usuario'";
$result = mysqli_query($conexion, $consultar);

if (!$result) {
    die(json_encode(['status' => 'error', 'message' => 'Error en la consulta: ' . mysqli_error($conexion)]));
}

if (mysqli_num_rows($result) > 0) {
    $fila = mysqli_fetch_assoc($result);
    if (password_verify($pass, $fila['contraseña'])) {
        // Determinar el tipo de usuario y redirigir a la página correspondiente
        switch ($fila['tipo_usuario']) {
            case 'Ciudadano':
                $redirectUrl = 'home1.html';
                break;
            case 'Consultor':
                $redirectUrl = 'home2.html';
                break;
            case 'Administrador':
            default: // Por defecto, si es administrador o tipo desconocido
                $redirectUrl = 'home.html';
                break;
        }
        // Respuesta de éxito
        echo json_encode(['status' => 'success', 'message' => 'Acceso concedido', 'redirect' => $redirectUrl]);
    } else {
        // Respuesta de error de contraseña
        echo json_encode(['status' => 'error', 'message' => 'Acceso denegado: Usuario o contraseña incorrectos.']);
    }
} else {
    // Respuesta de error de usuario no encontrado
    echo json_encode(['status' => 'error', 'message' => 'Acceso denegado: Usuario o contraseña incorrectos.']);
}
