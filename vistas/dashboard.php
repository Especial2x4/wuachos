<?php

session_start();


// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // Si la sesión del usuario está establecida, no hay necesidad de redirigir, simplemente continúa mostrando el dashboard.
    
} else {
    // Si la sesión del usuario no está establecida, redirige al usuario al formulario de inicio de sesión.
    header('Location: login.php');
    exit();
}


// Obtener el usuario de la sesión
$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!--<h2>Bienvenido, <?php //echo $_SESSION['usuario']['nombre']; ?>!</h2>-->
    <h2>Bienvenido, <?php echo $usuario['nombre']; ?>!</h2>
    <!-- Contenido del dashboard aquí -->
    <p>Este es tu dashboard. Aquí puedes agregar contenido relevante para el usuario.</p>
    <p><a href="controladores/UsuarioController.php?accion=cerrarSesion">Cerrar sesión</a></p>
</body>
</html>
