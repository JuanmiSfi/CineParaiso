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
$actorId = $_GET['id'];

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
<?php
// Añadimos los datos a la tabla actuan
                    $client = new \GuzzleHttp\Client();

                    $response = $client->request('GET', 'https://api.themoviedb.org/3/person/' . $idactor . '/movie_credits?language=es-ES', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $API . '',
                            'accept' => 'application/json',
                        ],
                    ]);

                    $consulta = json_decode($response->getBody(), true);
                    $pelis = $consulta['cast'];
                    if ($pelis) {
                        for ($i = 0; $i < count($pelis); $i++) {
                            $movieId = $pelis[$i]['id'];
                            $nombre_pelicula = $pelis[$i]['original_title'];
                            $titulo_completo = $pelis[$i]['original_title'];
                            $popularidad = $pelis[$i]['popularity'];
                            $movie_poster_path = $pelis[$i]['poster_path'];
                            
                        }
                    }
                    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Paraiso</title>
    <link rel="stylesheet" href="/CSS/actor.css" />

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
        <div class='actor'>
            <div class='actor-info'>
                <?php

                $client = new \GuzzleHttp\Client();

                $response = $client->request('GET', 'https://api.themoviedb.org/3/person/' . $actorId . '?language=es-Es', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $API . '',
                        'accept' => 'application/json',
                    ],
                ]);

                $info = json_decode($response->getBody(), true);
                $idactor = $info['id'];
                $nombre = $info['name'];
                $genero = $info['gender'];
                $fto_actor = $info['profile_path'];
                $bio = $info['biography'];
                $fecha_n = $info['birthday'];
                $fecha_d = $info['deathday'];
                echo "<div class='foto-actor'>";
                echo '<img src="https://image.tmdb.org/t/p/w300_and_h450_face/' . $fto_actor . '" />';
                echo "<h2><b>Información personal</b></h2>";
                echo "<h3>Sexo</h3>";
                if($genero == 1){
                    echo "Femenino";
                }else if($genero == 0){
                    echo "Masculino";
                }else{
                    echo "No definido";
                }
                echo "<h3>Fecha nacimiento</h3>";

                echo "</div>";
                echo "<div class='info'>";
                echo "<h2>$nombre</h2>";
                $bio_formateada = nl2br($bio);
                echo "<p>$bio_formateada</p>";
                ?>
                <h3>Conocido por:</h3>
                <div class='peliculas'>
                    
                </div> <!-- Cierra peliculas-->
            </div> <!--Cierra info-->
        </div>
    </div>
    </div>
    </div>
    </div>
</body>
</body>

</html>