<?php
session_start();

$servidor = "localhost";
$usuario = "lumen";
$clave = "1234";
$base = "lumen_ejemplo";
$conexion = new mysqli($servidor, $usuario, $clave, $base);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = isset($_POST['Nick']) ? $_POST['Nick'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($nick && $password) {
        $stmt = $conexion->prepare("SELECT Password FROM Registro WHERE Nick = ?");
        $stmt->bind_param("s", $nick);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            if (password_verify($password, #$hashed_password
            )) {
                $_SESSION['Nick'] = $nick;
                header("Location: plantilla/index.html");
                exit();
            } else {
                $_SESSION['error'] = "Contraseña incorrecta";
            }
        } else {
            $_SESSION['error'] = "Nick no registrado";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
    }
}

$conexion->close();
header("Location: iniciohtml.php");
exit();
?>
