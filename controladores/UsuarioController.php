<?php
// controladores/UsuarioController.php

require_once '../modelos/UsuarioModelo.php';

class UsuarioController {
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Acceso no permitido');
        }
        
        if (!isset($_POST['accion'])) {
            die('Acción no especificada');
        }
        
        $accion = $_POST['accion'];

        switch ($accion) {
            case 'registrar':
                $this->registrar();
                break;
            // Agrega más casos según sea necesario para otras acciones
            default:
                die('Acción no válida');
        }
    }

    public function registrar() {
        // Tu lógica para registrar un usuario aquí
        // Puedes acceder a $_POST['nombre'], $_POST['email'], etc. para obtener los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $usuarioModelo = new UsuarioModelo();

            // Verificar si el nombre de usuario ya existe en la base de datos
            if ($usuarioModelo->existeNombreUsuario($nombre)) {
                header('Location: ../vistas/mensaje.php?mensaje=El nombre de usuario ya está registrado');
                exit();
            }

            // Verificar si el correo electrónico ya existe en la base de datos
            if ($usuarioModelo->existeCorreoElectronico($email)) {
                header('Location: ../vistas/mensaje.php?mensaje=El correo electrónico ya está registrado');
                exit();
            }
            
            if ($usuarioModelo->registrarUsuario($nombre, $email, $password)) {
                
                header('Location: ../vistas/mensaje.php?mensaje=Usuario registrado exitosamente'); // Luego del envio del form redirije a la página del mensaje
                exit();

            } else {
                
                header('Location: ../vistas/mensaje.php?mensaje=Error al registrar usuario');
                exit();
            }

        }
    }
}

// Instancia del controlador para que se ejecute automáticamente al incluir este archivo
new UsuarioController();
?>

