<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$usuario =  $_GET['usuario'];

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

$sql = "SELECT id,codigo,verificado FROM usuario WHERE usuario = '$usuario'";
$resul = mysqli_query($conn, $sql);
if (mysqli_num_rows($resul) > 0) {
    $row = mysqli_fetch_assoc($resul);
    $idusuario = $row['id'];
    $codigo = $row['codigo'];
}


if (isset($_POST['verificar'])) {
    if ($_POST['codigo'] == $codigo) {
        $sql = "UPDATE usuario set verificado = 1 WHERE id = $idusuario";
        $resul = mysqli_query($conn, $sql);
        $mensaje = 1;
    } else {
        $mensaje = 2;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar</title>
    <link rel="stylesheet" href="/CSS/verifi.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="../index.php"><img src="/src/Logo.png" alt="logo"></a></div>
        </div>
        <div class="barra"></div>
    </header>
    <div class="contenedor">
        <div class="bloque">
            <p>Se ha envidado un codigo de verificacion a tu correo, ingreselo abajo para verificar la cuenta</p>
            <form action="" method="POST">
                <input type="text" name='codigo'>
                <button type='submit' name='verificar'><span>Verificar</span></button>
            </form>
            <?php
            if ($mensaje == 1) {
                echo "Codigo correcto puedes iniciar sesión";
                echo "<a href='../login.php'>Click Aqui para ir a el login</a>";
            } else if ($mensaje == 2) {
                echo "Codigo incorrecto";
            }

            ?>
        </div>
    </div>
</body>

</html>