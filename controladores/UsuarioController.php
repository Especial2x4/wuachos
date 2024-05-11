<?php
// controladores/UsuarioController.php

// NOTA: De momento no se va a validar los campos vacios del lado del servidor

require_once 'modelos/UsuarioModelo.php';

class UsuarioController {
    
    public function registrar() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $usuarioModelo = new UsuarioModelo();
            
            if ($usuarioModelo->registrarUsuario($nombre, $email, $password)) {
                
                header('Location: vistas/mensaje.php?mensaje=Usuario registrado exitosamente'); // Luego del envio del form redirije a la página del mensaje
            
            } else {
                
                header('Location: mensaje.php?mensaje=Error al registrar usuario');
            }
        } else {
            
            include 'vistas/registro.php';
        }
    }
}
?>
