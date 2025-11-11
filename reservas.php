<?php
session_start();

// 1. VERIFICACIÓN DE SESIÓN (Esto sigue igual)
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Se eliminó la sanitización de la variable
// $nombre_usuario_seguro = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Reservas - NetCoworking</title>
    <!-- (El CSS es el mismo que el de la app segura) -->
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #f9f9f9; }
        .navbar { background-color: #333; color: white; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { margin: 0; font-size: 20px; }
        .navbar a { text-decoration: none; background: #dc3545; color: white; padding: 8px 12px; border-radius: 4px; }
        .container { max-width: 1200px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .booking-grid h2 { border-bottom: 2px solid #007bff; padding-bottom: 10px; color: #333; }
        .room-category { margin-bottom: 30px; }
        .room-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .room-card { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .room-card img { width: 100%; height: 150px; object-fit: cover; }
        .room-card-content { padding: 15px; }
        .room-card-content h3 { margin-top: 0; color: #007bff; }
        .room-card-content p { font-size: 14px; color: #555; }
        .room-card-content .btn-book { display: block; width: calc(100% - 30px); text-align: center; padding: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px; }
    </style>
</head>
<body>

    <div class="navbar">
        <!--
          VULNERABILIDAD 6: XSS ALMACENADO (Stored XSS)
          Imprimimos el nombre de usuario (que viene de la sesión) directamente
          en el HTML. Si un usuario se loguea con el nombre "<script>alert(1)</script>",
          ese script se ejecutará en esta página.
        -->
        <h1>NetCoworking (Bienvenido, <?php echo $_SESSION['username']; ?>)</h1>
        <a href="logout.php">Cerrar Sesión</a>
    </div>
    
    <div class="container">
       <!-- (El resto del contenido HTML es el mismo) -->
       <div class="booking-grid">
            <div class="room-category">
                <h2>Salas de Reuniones</h2>
                <!-- ... (etc) ... -->
            </div>
        </div>
    </div>
    
</body>
</html>
