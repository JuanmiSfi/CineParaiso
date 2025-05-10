<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->load();


$idusuario = $_SESSION['idusuario'];
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Foto actual</h2>
    <?php
    $sql = "SELECT * FROM usuario WHERE usuario LIKE '{$_SESSION["usuario"]}'";
    $resul = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resul) > 0) {
        $row = mysqli_fetch_assoc($resul);
        $fto = $row['fto_perfil'];
        echo "<img src='$fto' alt='' id='fto'/>";
    }
    ?>
    <form action="foto.php" method="POST" enctype="multipart/form-data">
        <label for="fto_perfil">
            <input type="file" name="foto" ><br>
            <input type="submit" name="modificar" value="Subir imagen" class="boton" /><br>
        </label>
    </form>
</body>
</html>