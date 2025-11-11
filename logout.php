<?php
session_start();

// Limpiamos todas las variables de sesión
$_SESSION = array();

// Destruimos la sesión
session_unset();
session_destroy();

// Redirigimos al login
header("Location: login.php?logout=true");
exit;
?>
