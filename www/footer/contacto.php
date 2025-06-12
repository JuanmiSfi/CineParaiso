<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$pag = $_GET['pag'] ?? 1;
$idusuario = $_SESSION['idusuario'];
$noreview = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['busqueda'] = $_POST['busqueda'];
    header("Location: /consulta.php");
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre CineParaiso</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="/index.php"><img src="/src/Logo.png" alt="logo"></a></div>
            <div class="buscador">
                <form action="/consulta.php" method="POST">
                    <input type="text" name="busqueda" placeholder="Buscar en Cine Paraiso"></input>
                </form>
            </div>
            <div class="usuario"><a href="/login.php">
                    <?php
                    if ($_SESSION['idusuario'] != 0) {
                        $sql = "SELECT * FROM usuario WHERE id = '$_SESSION[idusuario]'";
                        $resul = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($resul) > 0) {
                            $row = mysqli_fetch_assoc($resul);
                            $fto = $row['fto_perfil'];
                            echo "<img src='$fto' alt='' />";
                        }
                    } else {
                        echo "<img src='/Perfil_usuario/Usuarios.png' alt='' />";
                    }
                    ?>
                </a></div>
        </div>
        <div class="barra"></div>
    </header>

    <div class='body'>
        <div class="contenido">
            <div class="hero">
                <h1>Contactanos</h1>
                <p>Escribenos tu petición y nosotros nos pondremos en coctacto contigo</p>
            </div>

            <div class="content">
                <h2>Indica cual es tu correo electronico</h2>
                <p>
                   
                </p>

                <h2>¿Por qué usar Cineparaiso?</h2>

                <p><strong></strong></p>
                <a href="/registro.php" class="boton"><button class="boton">enviar!</button></a>
            </div>
        </div>
    </div>
    <?php include(__DIR__ . "/../PHP/footer.php"); ?>
</body>

</html>