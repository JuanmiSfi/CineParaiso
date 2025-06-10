<?php
session_start();
require __DIR__ .  '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$idusuario = $_SESSION['idusuario'] ?? 0;
$id_rol = $_SESSION['id_rol'] ?? 0;

$error = false;

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
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <div class="opinion">
                <?php
                if ($idusuario != 0) {
                    echo "<p>Popular entre tus amigos</p>";
                    $sql = "SELECT p.poster,p.id as id_pelicula,u.id as id_usuario,r.nota,p.titulo,r.review,r.fecha,u.usuario,u.fto_perfil FROM review r, siguen s, pelicula p, usuario u WHERE u.id=s.id_sigue AND r.id_usuario = s.id_sigue AND s.id_usuario = $_SESSION[idusuario] AND p.id=r.id_pelicula AND r.vermastarde = 0 ORDER BY r.id DESC ";
                    $consult = mysqli_query($conn, $sql);
                    $numerofilas = mysqli_num_rows($consult);
                    if (mysqli_num_rows($consult) > 0) {
                        if ($numerofilas > 3) {
                            for ($i = 0; $i < 3; $i++) {
                                $fila = mysqli_fetch_assoc($consult);
                                $poster = $fila['poster'];
                                $id_usuario = $fila['id_usuario'];
                                $usuario = $fila['usuario'];
                                $fto_perfil = $fila['fto_perfil'];
                                $titulo = $fila['titulo'];
                                $movieId = $fila['id_pelicula'];
                                $nota = $fila['nota'];
                                $review = $fila['review'];
                                $fecha = $fila['fecha'];
                                if (!empty($review)) {
                                    echo "<div class='review'>";
                                    echo "<a href='/movie2.php?id=" . $movieId . "'>";
                                    echo "<img src='https://image.tmdb.org/t/p/w500" . $poster . "' width='300'>";
                                    echo "</a>";
                                    echo "<div class='contenido'>";
                                    echo "<h2>$titulo</h2>";
                                    echo "<div class='user'>";
                                    echo "<a href='/usuario.php?id=" . $id_usuario . "'>";
                                    echo "<img src='$fto_perfil' alt='' />";
                                    echo "</a>";
                                    echo "<div class='estrellas'>";
                                    for ($j = 1; $j <= 5; $j++) {
                                        if ($nota >= $j) {
                                            echo "<i class='fas fa-star' id='estrellas'></i>";
                                        }
                                    }
                                    echo "<div class='fecha'>";
                                    echo "<p id='visto'>Visto por <a href='/usuario.php?id=" . $id_usuario . "' style='text-decoration: none;'>$usuario</a> </p>";
                                    if (!empty($fecha)) {
                                        $fechaconformato = date("d-m-Y", strtotime($fecha));
                                        echo "<p>$fechaconformato</p>";
                                    }
                                    echo "</div>"; // cierra user
                                    echo "</div>"; // Cierra fecha
                                    echo "</div>"; // Cierra estrllas
                                    echo "<p>$review</p>";
                                    echo "</div>"; // Cierra contenido
                                    echo "</div>"; //Cierra review
                                }
                            }
                        } else {
                            for ($i = 0; $i < $numerofilas; $i++) {
                                $fila = mysqli_fetch_assoc($consult);
                                $poster = $fila['poster'];
                                $id_usuario = $fila['id_usuario'];
                                $usuario = $fila['usuario'];
                                $fto_perfil = $fila['fto_perfil'];
                                $titulo = $fila['titulo'];
                                $movieId = $fila['id_pelicula'];
                                $nota = $fila['nota'];
                                $review = $fila['review'];
                                $fecha = $fila['fecha'];
                                if (!empty($review)) {
                                    echo "<div class='review'>";
                                    echo "<a href='/movie2.php?id=" . $movieId . "'>";
                                    echo "<img src='https://image.tmdb.org/t/p/w500" . $poster . "' width='300'>";
                                    echo "</a>";
                                    echo "<div class='contenido'>";
                                    echo "<h2>$titulo</h2>";
                                    echo "<div class='user'>";
                                    echo "<a href='/usuario.php?id=" . $id_usuario . "'>";
                                    echo "<img src='$fto_perfil' alt='' />";
                                    echo "</a>";
                                    echo "<div class='estrellas'>";
                                    for ($j = 1; $j <= 5; $j++) {
                                        if ($nota >= $j) {
                                            echo "<i class='fas fa-star' id='estrellas'></i>";
                                        }
                                    }
                                    echo "<div class='fecha'>";
                                    echo "<p id='visto'>Visto por <a href='/usuario.php?id=" . $id_usuario . "' style='text-decoration: none;'>$usuario</a> </p>";
                                    if (!empty($fecha)) {
                                        $fechaconformato = date("d-m-Y", strtotime($fecha));
                                        echo "<p>$fechaconformato</p>";
                                    }
                                    echo "</div>"; // cierra user
                                    echo "</div>"; // Cierra fecha
                                    echo "</div>"; // Cierra estrllas
                                    echo "<p>$review</p>";
                                    echo "</div>"; // Cierra contenido
                                    echo "</div>"; //Cierra review
                                }
                            }
                        }
                    }
                    echo '<a href="/PHP/reviews/amigos.php?id=' . $idusuario . '" class="WatchList">
                        <p id="amigos">Ver más reviews publicadas por tus amigos</p>
                        </a>';
                }
                ?>


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