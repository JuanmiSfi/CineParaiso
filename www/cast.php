<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$idusuario = $_SESSION['idusuario'] ?? 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['busqueda'] = $_POST['busqueda'];
    header("Location: consulta.php");
    exit();
}
$movieId = $_GET['id'];

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
require_once('vendor/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Paraiso</title>
    <link rel="stylesheet" href="/CSS/cast.css" />

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
    <div class='contenedor'>
        <div class='peliculas'>
            <div class='actores-info'>
                <?php
                require_once('vendor/autoload.php');

                $client = new \GuzzleHttp\Client();

                $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/' . $movieId . '/credits?language=es-ES', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $API . '',
                        'accept' => 'application/json',
                    ],
                ]);
                $info = json_decode($response->getBody(), true);
                $actores = $info['cast'];
                $num_actores = count($actores);
                        if ($num_actores >= 20) {
                            for ($i = 0; $i <= 20; $i++) {
                                $id_actor = $actores[$i]['id'];
                                $nombre = $actores[$i]['name'];
                                $personaje = $actores[$i]['character'];
                                $fto_actor = $actores[$i]['profile_path'];
                                echo "<div class='info-actor'>";
                                echo "<a href='actor.php?id=" . $id_actor . "'>";
                                echo '<img src="https://image.tmdb.org/t/p/w138_and_h175_face/' . $fto_actor . '" />';
                                echo "</a>";
                                echo "<div class='nombre-personaje'>";
                                echo "<p>$nombre</p>";
                                echo "<p>$personaje</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            for ($i = 0; $i < $num_actores; $i++) {
                                $id_actor = $actores[$i]['id'];
                                $nombre = $actores[$i]['name'];
                                $personaje = $actores[$i]['character'];
                                $fto_actor = $actores[$i]['profile_path'];
                                echo "<div class='info-actor'>";
                                echo "<a href='actor.php?id=" . $id_actor . "'>";
                                echo '<img src="https://image.tmdb.org/t/p/w138_and_h175_face/' . $fto_actor . '" />';
                                echo "</a>";
                                echo "<div class='nombre-personaje'>";
                                echo "<p>$nombre</p>";
                                echo "<p>$personaje</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                ?>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
</body>

</html>