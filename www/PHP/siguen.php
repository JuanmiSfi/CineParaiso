<?php 
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
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
if (!isset($_SESSION['idusuario']) || $_POST['idusuario']==0) {
    header("Location: ../login.php"); 
    exit();
}
$idusuario = $_POST['idusuario'];
$idusuario2= $_POST['idusuario2'];
$idusuario3= $_POST['usuariobase']??$idusuario2;

if(isset($_POST['follow'])){
    $sql="INSERT INTO siguen (id_usuario,id_sigue) values ($idusuario,$idusuario2)";
    $resul = mysqli_query($conn,$sql);
    if($resul>0){
        if ($_POST['DIR'] === 'siguiendo') {
            header("Location: ../PHP/usuario/siguiendo.php?id=" . $idusuario3);
            exit();
        }else if ($_POST['DIR'] === 'usuario') {
            header("Location: ../usuario.php?id=" . $idusuario2);
            exit();
        } elseif ($_POST['DIR'] === 'seguidores') {
            header("Location: ../PHP/usuario/seguidores.php?id=" . $idusuario3);
            exit();
        }
    }
}
if(isset($_POST['unfollow'])){
    $sql="DELETE FROM siguen where id_usuario=$idusuario AND id_sigue=$idusuario2";
    $resul = mysqli_query($conn,$sql);
    if($resul>0){
        if ($_POST['DIR'] === 'siguiendo') {
            header("Location: ../PHP/usuario/siguiendo.php?id=" . $idusuario3);
            exit();
        } elseif ($_POST['DIR'] === 'seguidores') {
            header("Location: ../PHP/usuario/seguidores.php?id=" . $idusuario3);
            exit();
        }elseif($_POST['DIR'] === 'usuario') {
            header("Location: ../usuario.php?id=" . $idusuario2);
            exit();
        }
    }
}
if(isset($_POST['suprimir'])){
    $sql="DELETE FROM siguen where id_usuario=$idusuario2 AND id_sigue=$idusuario";
    $resul = mysqli_query($conn,$sql);
    if($resul>0){
        if ($_POST['DIR'] === 'usuario') {
            header("Location: ../usuario.php?id=" . $idusuario2);
            exit();
        } elseif ($_POST['DIR'] === 'seguidores') {
            header("Location: ../PHP/usuario/seguidores.php?id=" . $idusuario3);
            exit();
        }
    }
}


?>