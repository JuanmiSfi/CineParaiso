<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "pma";
$password = "AlumnadoIAW";
$database = "CineParaiso";
// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);
// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
$usuario = $_SESSION['usuario'];
$foto = $_FILES['foto'];
echo $foto['tmp_name'];
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
            mysqli_query($conn, "UPDATE usuario SET fto_perfil = '$destino' WHERE usuario = '$usuario';");
           (move_uploaded_file($tmp_name, $destino));
           header("Location: modificar.php");
           exit();
        }else{
            header("Location: modificar.php");
            exit(); 
        }
?>
