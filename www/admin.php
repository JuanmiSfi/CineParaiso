<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$id_rol = $_SESSION['id_rol'] ?? 0;

if ($id_rol == 0 || $id_rol == 1) {
    header("Location: index.php");
    exit();
}


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

if (isset($_POST['cerrar'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineParaiso</title>
    <link rel="stylesheet" href="/CSS/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="index.php"><img src="/src/Logo.png" alt="logo"></a></div>
            <div class="usuario">
                    <form action="" method="POST">
                        <label for="Boton" class="boton">
                            <button type="submit" name="cerrar">Cerrar sesión</button>
                        </label>
                    </form>
            </div>
        </div>
        <div class="barra"></div>
    </header>
    <div class="volver">
        <a href="../../../index.php"><i class="fa-solid fa-share fa-flip-horizontal"></i></a>
    </div>
    <div class='menu'>
        <div class='usuarios'>
            <a href="/PHP/admin/usuarios/usuario.php">
            <div class="bloque">
                <img src="/Perfil_usuario/Usuarios.png">
            </div>
            <h2>Control de usuarios</h2>
            </a>
        </div>
        <div class="reviews">
            <a href="/PHP/admin/reviews/review.php">
            <div class="bloque">
                <img src="/src/ajustes.png">
            </div>
            <h2>Control de Reviews</h2>
            </a>
        </div>
        <div class="admin">
            <a href="/PHP/admin/ajuste.php">
            <div class="bloque">
                <img src="/Perfil_usuario/ChatGPT_Image_29_mar_2025__21_36_56-removebg-preview.png" alt="">
            </div>
            <h2>Consola de administración</h2>
            </a>
        </div>
    </div>
</body>

</html>