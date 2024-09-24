<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de Sesion.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/ini.css" />
</head>
<body>
    <div class="login-box">
        
        <h1>Iniciar sesion aqui.</h1>
        <form method="POST" action="login.php">
            <label for="Nick">Usuario</label>
            <input type="text" id="Nick" name="Nick" placeholder="Ingresa tu Nick" required />
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required />
            <input type="submit" value="Iniciar sesion." />
            <a href="reghtml.php">No tienes una cuenta?</a>
        </form>
        <?php  
        if (isset($_SESSION['error'])) { 
            echo '<p style="color:red">' . $_SESSION['error'] . '</p>'; 
            unset($_SESSION['error']); 
        } 
        ?>
    </div>
    <script src="js/js.js"></script>
</body>
</html>
