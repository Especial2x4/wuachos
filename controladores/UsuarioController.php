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
            
            case 'iniciarSesion':
                $this->iniciarSesion();
                break;
                // Agrega más casos según sea necesario para otras acciones
            default:
                die('Acción no válida');
        }
    }

    // Funciones de registro

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


    // Funciones de login

    public function iniciarSesion() {

        if ($_POST['accion'] === 'iniciarSesion') {
            $nombre = $_POST['nombre'];
            $password = $_POST['password'];
            
            //$usuarioController->iniciarSesion($nombre, $password);

            $usuarioModelo = new UsuarioModelo();
            $usuario = $usuarioModelo->verificarCredenciales($nombre, $password);

            if ($usuario) {
                // Iniciar sesión y redirigir al usuario a su página de inicio
                $_SESSION['usuario'] = $usuario;
                header('Location: ../vistas/mensaje.php??mensaje=Inicio de sesion exitoso');
                exit();
            } else {
                // Credenciales incorrectas, redirigir al usuario al formulario de inicio de sesión con un mensaje de error
                header('Location: ../vistas/mensaje.php??error=1');
                exit();
            }

            

        }

       
    }


    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    }



}

// Instancia del controlador para que se ejecute automáticamente al incluir este archivo
new UsuarioController();
?>

