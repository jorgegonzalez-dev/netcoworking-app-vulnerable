<?php
session_start();
// Ya no generamos un token CSRF
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login INSEGURO - NetCoworking</title>
    <style>
        /* (El CSS es el mismo que el de la app segura) */
        body { font-family: sans-serif; display: grid; place-items: center; min-height: 90vh; background-color: #f4f4f4; }
        .login-container { background: #fff; border: 1px solid #ccc; padding: 25px 40px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .logo { max-width: 350px; margin-bottom: 20px; }
        form div { margin-bottom: 15px; text-align: left; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 300px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="Logo NetCoworking" class="logo">
        
        <form action="procesar_login.php" method="POST">
            <h2>Acceso a Reservas</h2>
            
            <?php
            // VULNERABILIDAD 5 (PARTE B): XSS REFLEJADO
            // Si la URL trae un parámetro "error", lo imprimimos
            // directamente en el HTML sin usar htmlspecialchars().
            // Un atacante puede poner código <script> en la URL y será ejecutado.
            if (isset($_GET['error'])) {
                echo '<p class="error">' . $_GET['error'] . '</p>';
            }
            ?>
    
            <div>
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <!-- 
              VULNERABILIDAD 1 (PARTE B): SIN PROTECCIÓN CSRF
              Se eliminó el campo <input type="hidden" name="csrf_token" ...>
            -->
            
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
