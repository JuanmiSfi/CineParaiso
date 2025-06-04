<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../vendor/autoload.php';

$mail = new PHPMailer(true);
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$mail = new PHPMailer(true);

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

if (isset($_POST['enviar'])) {
    $sql = "SELECT * FROM usuario WHERE email like '$_POST[correo]'";
    $resul = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resul) > 0) {
        $row = mysqli_fetch_assoc($resul);
        $idusuario = $row['id'];
        $correo = $row['email'];
        include __DIR__ . "/email/password.php";
        $sql = "UPDATE usuario set codigo = $codigo WHERE id=$idusuario";
        if (mysqli_query($conn, $sql)) {
            $mail->send();
            $mensaje = 1;
        }
    }else{
        $mensaje = 2;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
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
            <p>Introduzca el correo de la cuenta que deseas recuperar</p>
            <form action="" method="POST">
                <input type="text" name='correo'>
                <button type='submit' name='enviar'><span>Enviar!</span></button>
            </form>
            <?php
            if ($mensaje == 1) {
                echo "<p>Se ha mandado un correo de recuperación de la contraseña al correo: <strong>$correo</strong></p>";
            }else if($mensaje == 2){
                echo "<p>No se ha encontra una cuenta relacionada con el siguiente correo: <strong>$_POST[correo]</strong></p>";
            }
            ?>
        </div>
    </div>
</body>

</html>