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
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/person/' . $actorId . '/external_ids', [
    'headers' => [
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlODBmYjY4YzM2ZTExODRlZGRiYmY1MGEwNjQxMDcwZCIsIm5iZiI6MS43NDQxMzczNDU3NTgwMDAxZSs5LCJzdWIiOiI2N2Y1NmM4MWVkZGVjMjhiMDNhZGUwMDEiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.uRGiMicdSlhinc4hnY9eeWDeavyIbiBU-dT1RM33Ggk',
        'accept' => 'application/json',
    ],
]);

$info = json_decode($response->getBody(), true);
$imdb_id = $info['imdb_id'];
$wikidata_id = $info['wikidata_id'];
$facebook_id = $info['facebook_id'];
$instagram_id = $info['instagram_id'];
$tiktok_id =  $info['tiktok_id'];
$twitter_id = $info['twitter_id'];
$youtube_id = $info['youtube_id'];

$RSS = mysqli_query($conn, "SELECT * FROM redessociales WHERE id_actor = $actorId");
if (mysqli_num_rows($RSS) <= 0) {
    $stmt = $conn->prepare("INSERT into redessociales (id_actor, wikidata, facebook, instagram, tiktok, twitter, youtube)values (?,?,?,?,?,?,?)");
    $stmt->bind_param("issssss", $actorId, $wikidata_id , $facebook_id, $instagram_id, $tiktok_id, $twitter_id, $youtube_id);
    $stmt->execute();
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
                $nombre = mysqli_real_escape_string($conn, $info['name']);
                $genero = $info['gender'];
                $fto_actor = $info['profile_path'];
                $lugar_n = $info['place_of_birth'];
                $bio = $info['biography'];
                $fecha_n = $info['birthday'];
                $fecha_d = $info['deathday'];

                $sql = mysqli_query($conn, "SELECT * FROM actor WHERE id_actor=$actorId");
                if (mysqli_num_rows($sql) <= 0) {

                    $stmt = $conn->prepare("INSERT into actor (id_actor, genero, nombre, fto, bio, nacimiento, fallecimiento, lugar_de_nacimiento)values (?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("iissssss", $idactor, $genero, $nombre, $fto_actor, $bio, $fecha_n, $fecha_d, $lugar_n);
                    $stmt->execute();
                }


                echo "<div class='foto-actor'>";
                echo '<img src="https://image.tmdb.org/t/p/w300_and_h450_face/' . $fto_actor . '" loading="lazy">';
                echo "<h2><b>Información personal</b></h2>";

                echo "<h3>Sexo</h3>";
                if ($genero == 1) {
                    echo "<p>Femenino</p>";
                } else if ($genero == 2) {
                    echo "<p>Masculino</p>";
                } else {
                    echo "<p>No definido</p>";
                }
                echo "<h3>Fecha nacimiento</h3>";
                $fechaconformato = date("d-m-Y", strtotime($fecha_n));
                echo "<p>$fechaconformato</p>";
                if (isset($fecha_d)) {
                    echo "<h3>Fecha de fallecimiento</h3>";
                    $fechamuerte = date("d-m-Y", strtotime($fecha_d));
                    echo "<p>$fechamuerte</p>";
                }
                echo "<h3>Lugar de nacimiento</h3>";
                echo "<p>$lugar_n</p>";
                echo "</div>";
                echo "<div class='info'>";
                echo "<h2>$nombre</h2>";
                $bio_formateada = nl2br($bio);
                echo "<p>$bio_formateada</p>";
                ?>
                <h3>Conocido por:</h3>
                <div class='peliculas'>
                    <?php
                    // Añadimos los datos a la tabla actuan
                    $client = new \GuzzleHttp\Client();

                    $response = $client->request('GET', 'https://api.themoviedb.org/3/person/' . $actorId . '/movie_credits?language=es-ES', [
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
                            $nombre_pelicula = mysqli_real_escape_string($conn, $pelis[$i]['title']);
                            $popularidad = $pelis[$i]['popularity'];
                            $personaje = mysqli_real_escape_string($conn, $pelis[$i]['character']);
                            $movie_poster = $pelis[$i]['poster_path'];
                            $anio = $pelis[$i]['release_date'];
                            if (empty($anio)) {
                                $anio = '1111-11-11';
                            }
                            if (!empty($movie_poster)) {
                                echo "<a href='movie2.php?id=" . $movieId . "'>";
                                echo "<img src='https://image.tmdb.org/t/p/w500" . $movie_poster . "' width='150' loading='lazy'><br>";
                                echo "</a>";
                            }
                            $peli = mysqli_query($conn, "SELECT * FROM pelicula WHERE id=$movieId");
                            $actor = mysqli_query($conn, "SELECT * FROM Actuan WHERE id_actor=$actorId AND personaje = '$personaje' AND id_pelicula = $movieId");
                            if (mysqli_num_rows($peli) <= 0) {
                                mysqli_query($conn, "INSERT into pelicula(id,titulo,poster,año) values ($movieId,'$nombre_pelicula','$movie_poster','$anio')");
                            }
                            if (mysqli_num_rows($actor) <= 0) {
                                mysqli_query($conn, "INSERT into Actuan(id_pelicula,id_actor,titulo_pelicula,personaje) values ($movieId,$actorId,'$nombre_pelicula','$personaje')");
                            }
                        }
                    }
                    ?>
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