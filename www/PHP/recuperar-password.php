<?php
session_start();



require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$mensaje = 0;

$codigo = $_GET['codigo'];

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
    $sql = "SELECT * FROM usuario WHERE codigo = $codigo";
    $resul = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resul) > 0) {
        $row = mysqli_fetch_assoc($resul);
        $idusuario = $row['id'];
        if ($_POST['pass1'] == $_POST['pass2']) {
            $codigo2 = rand(1000, 9999);
            $PassCifrada = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
            $sql = "UPDATE usuario set contraseña = '$PassCifrada', codigo = $codigo2 WHERE id=$idusuario";
            if (mysqli_query($conn, $sql)) {
                $mensaje = 1;
            }
        } else {
            $mensaje = 2;
        }
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
            <form action="" method="POST" class='recu'>
                    <p>Por favor Introduzca la Nueva Contraseña<br></p>
                    <input type="password" name="pass1">
                    <p>Repite la Contraseña<br></p>
                    <input type="password" name="pass2">
                <button type='submit' name='enviar' style="margin-bottom: 15px;"><span>Enviar!</span></button>
            </form>
            <?php
            if ($mensaje == 1) {
                echo "<p>La contraseña se ha cambiado correctamente</p>";
            } else if ($mensaje == 2) {
                echo "<p>Las contraseñas no coincide</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>