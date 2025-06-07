<?php
session_start();

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->load();

$idusuario = $_GET['id']??$_SESSION['idusuario'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['busqueda'] = $_POST['busqueda'];
    header("Location: consulta.php");
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
    <title>Cine Paraiso</title>
    <link rel="stylesheet" href="/CSS/watchlist.css" />

</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="index.php"><img src="/src/Logo.png" alt="logo"></a></div>
            <div class="buscador">
                <form action="consulta.php" method="POST">
                    <input type="text" name="busqueda" placeholder="Buscar en Cine Paraiso"></input>
                </form>
            </div>
            <div class="usuario"><a href="login.php">
                    <?php
                    if ($idusuario != 0) {
                        $sql = "SELECT * FROM usuario WHERE id = '$idusuario'";
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

    <body>
        <div class='peliculas'>
            <?php
            $sql = "SELECT COUNT(id) as pendientes FROM review WHERE id_usuario = $idusuario AND vermastarde = 1";
            $consulta = mysqli_query($conn, $sql);
            if (mysqli_num_rows($consulta) > 0) {
                $row = mysqli_fetch_assoc($consulta);
                $num = $row['pendientes'];
                if ($num >= 1) {
                    echo "<p>Tienes $num peliculas pendientes por ver </p>";
                } else {
                    echo "<p>Enhorabuena has visto todas tus peliculas pendientes </p>";
                }
            }
            ?>
        </div>
        <div class='poster'>
            <?php
            $sql = "SELECT p.poster,p.id FROM review r,pelicula p WHERE r.id_usuario = $idusuario  AND r.id_pelicula = p.id AND r.vermastarde = 1 ORDER BY r.id DESC";
            $consult = mysqli_query($conn, $sql);
            $numerofilas = mysqli_num_rows($consult);
            for ($i = 0; $i < $numerofilas; $i++) {
                $fila = mysqli_fetch_assoc($consult);
                $poster = $fila['poster'];
                $movieId = $fila['id'];
                echo "<a href='movie2.php?id=" . $movieId . "'>";
                echo "<img src='https://image.tmdb.org/t/p/w500" . $poster . "' width='300'>";
                echo "</a>";
            }
            ?>
        </div>
        
    </body>
</body>

</html>