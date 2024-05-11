
<?php
// modelos/UsuarioModelo.php

require_once 'configuracion/database.php';

class UsuarioModelo {
    
    private $conexion; // variable que va a almacenar la conexión a la base de datos

    public function __construct() {
        
        global $conexion;
        $this->conexion = $conexion;
    
    }

    public function registrarUsuario($nombre, $email, $password) {
        
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
}
?>
