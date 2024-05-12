<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <!--- Cabecera --->
    <?php require "../partials/header.php"?>
    
    <h1>Login</h1>

    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <p style="color: red;">Credenciales incorrectas</p>
    <?php endif; ?>

    <form action="../controladores/UsuarioController.php" method="POST">

        <input type="text" name="nombre" id="nombre" placeholder="Enter your username">
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <input type="hidden" name="accion" value="iniciarSesion"> <!-- Agrega un campo oculto para indicar la acción -->
        <input type="submit" value="enviar">

    </form>
</body>
</html>