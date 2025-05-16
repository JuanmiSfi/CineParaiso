<?php
session_start();
require __DIR__ .  '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$idusuario = $_SESSION['idusuario'] ?? 0;
$id_rol = $_SESSION['id_rol'] ?? 0;

$error=false;

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = 'db';
$username = 'admin';
$password = 'AlumnadoIAW';
$database = 'CineParaiso';
$API = $_ENV['API_KEY'];
// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);
// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
try {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cine Paraiso</title>
        <link rel="stylesheet" href="./CSS/styles.css" />
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
            <?php
            //Hacemos la conexión con la API, y hacemos uso de la referencia "MOVIES" haciendo uso del filtrado por semana
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.themoviedb.org/3/trending/movie/week?language=es-ES', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $API . '',
                    'accept' => 'application/json',
                ],
            ]);
            // Esto genera un archivo json que hay que decodificar, que pasa de ser un objeto a ser un array para poder recorrerlo 
            $info = json_decode($response->getBody(), true);
            // Comprobamos si hay información dentro del array siendo la variable info diferente a 0
            ?>
            <div class="contenedor">
                <p>Lo más visto</p>
                <div class="bloque">
                    <div class="Poster">
                        <?php
                        if ($info != 0) {
                            // Hacemos un for para recorrer la información 5 veces, ya que quiero que solamente muestre las 5 peliculas mas populares
                            for ($i = 0; $i < 5; $i++) {
                                $movie = $info['results'][$i];
                                $id_movie = $movie['id'];
                                $titulo = $movie['title'];
                                $poster = $movie['poster_path'];
                                $numeros = $i + 1;
                                echo "<div class='numeros_poster'>";
                                echo "<h2>$numeros</h2>";
                                echo "</div>"; //cierra numeros_pos
                                echo "<div class='Posters'>";
                                echo "<a href='movie2.php?id=" . $id_movie . "'/>";
                                echo '<img src=https://image.tmdb.org/t/p/w200' . $poster . 'alt="poster">';
                                echo "</a>";
                                echo "</div>"; //cierra poster
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="ayuda">
                <div class="peliculas">
                    <p>No sabes que ver hoy, Nosotros te ayudamos</p>
                    <?php
                    //Hacemos la conexión con la API, y hacemos uso de la referencia "MOVIES" haciendo uso del filtrado por semana
                    require_once('vendor/autoload.php');

                    $client = new \GuzzleHttp\Client();

                    $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $API . '',
                            'accept' => 'application/json',
                        ],
                    ]);
                    // Esto genera un archivo json que hay que decodificar, que pasa de ser un objeto a ser un array para poder recorrerlo 
                    $info = json_decode($response->getBody(), true);
                    // Comprobamos si hay información dentro del array siendo la variable info diferente a 0
                    if ($info != 0) {
                        // Hacemos un for para recorrer la información 5 veces, ya que quiero que solamente muestre las 5 peliculas mas populares
                        for ($i = 0; $i < 20; $i++) {
                            $movie = $info['results'][$i];
                            $id_movie = $movie['id'];
                            $titulo = $movie['title'];
                            $poster = $movie['poster_path'];
                            echo "<a href='movie2.php?id=" . $id_movie . "'/>";
                            echo '<img src=https://image.tmdb.org/t/p/w200' . $poster . 'alt="poster">';
                            echo "</a>";
                        }

                        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=2&sort_by=popularity.desc', [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $API . '',
                                'accept' => 'application/json',
                            ],
                        ]);
                        $info = json_decode($response->getBody(), true);
                        for ($i = 0; $i < 8; $i++) {
                            $movie = $info['results'][$i];
                            $id_movie = $movie['id'];
                            $titulo = $movie['title'];
                            $poster = $movie['poster_path'];
                            echo "<a href='movie2.php?id=" . $id_movie . "'/>";
                            echo '<img src=https://image.tmdb.org/t/p/w200' . $poster . 'alt="poster">';
                            echo "</a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </body>
    <?php
} catch (Exception $e) {
    $error = true;
}
    ?>
    <div class='sin-review'>
        <?php
        if ($error == true) {
            echo '<img src="/Perfil_usuario/ChatGPT_Image_29_mar_2025__21_36_56-removebg-preview.png">';
            echo "<p>¡Vaya! Parece que estamos de mantenimiento</p>";
        }
        ?>
    </div>
    </body>

    </html>