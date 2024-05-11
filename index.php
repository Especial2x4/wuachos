
<?php
// index.php

require_once 'controladores/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuarioController->registrar();
?>
