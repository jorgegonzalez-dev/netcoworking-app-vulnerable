<?php
session_start();

// VULNERABILIDAD 1: SIN PROTECCIÓN CSRF
// Se eliminó la comprobación del token. Ahora un atacante puede
// forzar a un usuario a enviar este formulario desde otra web.

// 2. LÓGICA DE AUTENTICACIÓN INSEGURA
$usuario_form = $_POST['username'];
$password_form = $_POST['password'];

// VULNERABILIDAD 2: INYECCIÓN SQL (SQLi)
// El código está escrito como si fuera a una base de datos.
// Al concatenar la variable ($usuario_form) directamente en la consulta,
// un atacante puede "romper" el SQL.
// Un SAST (Semgrep) detectará esto inmediatamente.
$sql_query = "SELECT * FROM usuarios WHERE username = '" . $usuario_form . "' AND password = '" . $password_form . "'";

// VULNERABILIDAD 3: CONTRASEÑA EN TEXTO PLANO (Hardcoded)
// En lugar de un hash, la contraseña está escrita directamente en el código.
// SAST también alertará sobre esto.
if ($usuario_form === "admin" && $password_form === "admin123") {
    
    // VULNERABILIDAD 4: FIJACIÓN DE SESIÓN (Session Fixation)
    // Se ha eliminado (o comentado) la línea session_regenerate_id(true);
    // Un atacante puede "fijar" un ID de sesión antes del login.
    // session_regenerate_id(true); // <-- ESTA LÍNEA DE DEFENSA YA NO ESTÁ
    
    // Guardamos los datos del usuario en la sesión
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $usuario_form;
    
    // Redirigimos a la página de reservas
    header("Location: reservas.php");
    exit;
    
} else {
    // Autenticación fallida
    // VULNERABILIDAD 5 (PARTE A): XSS REFLEJADO
    // Reflejamos la entrada del usuario ($usuario_form) directamente en la URL.
    // La página login.php (siguiente archivo) mostrará este error sin sanear.
    header("Location: login.php?error=El usuario '" . $usuario_form . "' no existe");
    exit;
}
?>
