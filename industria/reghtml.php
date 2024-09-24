<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>registro</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="css/reg.css" />
  </head>
  <body>
    <div class="login-box">
      
      <h1>Registrar aqui.</h1>
      <form method="post">
        <!-- USERNAME INPUT -->
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" placeholder="Ingrese Nombre" required/>
        <label for="Apellido">Apellido</label>
        <input type="text" name="Apellido" placeholder="Ingrese Apellido" required/>
        <!-- PASSWORD INPUT -->
        <label for="DNI">DNI</label>
        <input type="text" name="DNI"placeholder="Ingrese DNI" required/>

        <label for="Correo">Correo</label>
        <input type="email" name="Correo" placeholder="Ingrese Correo" required />
        <label for="Nick">Nombre del usuario</label>
        <input type="text" name="Nick" placeholder="Ingrese nombre del usuario" required />
        <label for="password">Password</label>
        <input type="password" name="Password" placeholder="Ingrese Contraseña" required />
        <input type="submit" value="Registrar" />
        <a href="iniciohtml.php">Iniciar sesion.</a>
      </form>
    </div>
    
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servidor = "localhost";
    $usuario = "lumen";
    $clave = "1234";
    $base = "lumen_ejemplo";
    $conexion = mysqli_connect($servidor, $usuario, $clave, $base);
        

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $preparar = $conexion->prepare("INSERT INTO Registro (Nombre, Apellido, DNI, Correo, Nick, Password) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$preparar) {
        die("Error al preparar la consulta: " . $conexion->error);
    }
    $preparar->bind_param("ssssss", $Nombre, $Apellido, $DNI, $Correo, $Nick, $Password);
    
// Comentario para el que haga el backend (yo) Bv sobre bind_param: "s" para cadenas de caracteres, "i" para enteros, "d" para números con punto decimal, y "b" para objetos binarios como imágenes o archivos multimedia.

// por si se me olvida lo que es bind param , esta sentencia lo que hace es ¿ preparar una sentencia SQL con marcadores distintivos para los tipos de datos como integer , varchay , y asi sucesivamente

    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $DNI = $_POST['DNI'];
    $Correo = $_POST['Correo'];
    $Nick = $_POST['Nick'];
    $Password = $_POST['Password'];
    $preparar->execute();

    
    if ($preparar->affected_rows > 0) {
        //affected_arrows significa que si yo rellene los campos del registro y lo envie con el boton , lo que hara luego de esto es analizar si el numero de filas afectadas es mayor a 0 entonces dira que el registro se ha hecho correctamente o insertado como dice el echo. Aunque ese parametro comprueba el número de filas afectadas tras la ejecución de la sentencia SQL sin la necesidad de lo que dije de rellenar los campos y enviarlo con el boton anteriormente ya que es redundante :v
        
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $preparar->error;
    }

    $preparar->close();
    $conexion->close();
}
?>

    
    
    <script src="js/js.js"></script>
  </body>
</html>
