
<?php
// modelos/UsuarioModelo.php

require_once '../configuracion/database.php';

class UsuarioModelo {
    
    private $conexion; // variable que va a almacenar la conexión a la base de datos

    public function __construct() {
        
        global $conexion;
        $this->conexion = $conexion;
    
    }

    public function existeNombreUsuario($nombre){

        $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE nombre = :nombre";
        $stmt = $this->conexion->prepare($sql); // prepara la consulta
        $stmt->bindParam(':nombre', $nombre); // vincula la variable nombre dentro de la consulta
        $stmt->execute(); // ejecuta la consulta
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // se almacena el resultado de la consulta en un array asociativo
        return $resultado['total'] > 0;
    }

    public function existeCorreoElectronico($email) {
        
        $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE email = :email";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] > 0;
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
