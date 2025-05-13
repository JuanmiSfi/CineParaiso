<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->load();

$mensaje = 0;
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];
$API = $_ENV['API_KEY'];
// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);
// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
<?php
                // Obtener datos del formulario
                if (isset($_POST['registrar'])) {
                    $correo = $_POST['correo'];
                    $usuario = $_POST['usuario'];
                    $password = $_POST['password'];
                    // Ciframos la contraseña para mas seguridad
                    $PassCifrada = password_hash($password, PASSWORD_DEFAULT);
                    // Comprobamos que no exista ya un usuario con el mismo nombre en el sistema
                    $sql = "SELECT * FROM usuario WHERE usuario like '$usuario'";
                    $resul = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($resul) == 0) {
                        // Insertar datos en la base de datos
                        $sql = "INSERT INTO usuario (usuario,email,contraseña) values ('$usuario','$correo','$PassCifrada')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: login.php");
                            exit();
                        } else {
                            echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
                        }
                    } else {
                        $mensaje = 1;
                    }
                }
                // Cerrar conexión 
                mysqli_close($conn);
                ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineparaiso</title>
    <link rel="stylesheet" href="/CSS/registro.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="index.php"><img src="/src/Logo.png" alt="logo"></a></div>
        </div>
        <div class="barra"></div>
    </header>

    <body>
        <div class="contenedor">
            <p>Registrate</p>
            <div class="bloque">
                <div class="formulario">
                    <form action="" method="POST">
                        <label for="Correo">
                            <h2>Correo:</h2>
                            <input type="correo" name="correo">
                        </label><br>
                        <label for="Usuario">
                            <h2>Nombre de usuario:</h2>
                            <input type="text" name="usuario">
                        </label><br>
                        <label for="Password">
                            <h2>Contraseña<br></h2>
                            <input type="password" name="password">
                        </label><br>
                        <label for="Boton" class="boton">
                            <input type='hidden' name='id' value=''>
                            <button type='submit' name='registrar'><span>Registrame!</span></button>
                        </label>
                    </form>
                </div>
                <?php
                if($mensaje == 1){
                    echo "<div class='error'><p>El nombre de usuario escogido ya existe en el sistema</p></div>";
                }
                ?>
            </div>
        </div>
    </body>
</body>

</html>