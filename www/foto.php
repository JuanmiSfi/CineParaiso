<?php 
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->load();

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];
// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);
// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php"); 
    exit();
}
$idusuario = $_SESSION['idusuario'];

$foto = $_FILES['foto'];
$directorio_destino = "Perfil_usuario";

$tmp_name = $foto['tmp_name'];
    
    
        $img_file = $foto['name'];
        $img_type = $foto['type'];
        // Si se trata de una imagen   
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
 strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?
            $destino = $directorio_destino . '/' .  $img_file;
            mysqli_query($conn, "UPDATE usuario SET fto_perfil = '/$destino' WHERE id = '$idusuario';");
           (move_uploaded_file($tmp_name, $destino));
           header("Location: modificar.php");
           exit();
        }else{
            header("Location: modificar.php");
            exit(); 
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida imagen</title>
</head>
<body>
    
</body>
</html>