<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();



$idusuario = $_SESSION['idusuario'] ?? 0;
$movieId = $_GET['id'];
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
    <link rel="stylesheet" href="/CSS/todas.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    <div class='body'>
        <div class='contenedor'>
            <div class="poster">
                <a href="/movie2.php?id=<?php echo $movieId; ?>">
                    <?php

                    use GuzzleHttp\Client;
                    use GuzzleHttp\Exception\RequestException;
                    $client = new Client();
                    try {
                        // Realizamos la solicitud a la API para obtener los detalles de la película por ID
                        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/' . $movieId . '?language=es-ES', [
                            'headers' => [
                                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlODBmYjY4YzM2ZTExODRlZGRiYmY1MGEwNjQxMDcwZCIsIm5iZiI6MTc0NDEzNzM0NS43NTgwMDAxLCJzdWIiOiI2N2Y1NmM4MWVkZGVjMjhiMDNhZGUwMDEiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.TRT_T9QbIH1qJO2xLgccbI9V9e76U2lS-_D7rUs6yqA',
                                'accept' => 'application/json',
                            ],
                        ]);
                        // Decodificamos el JSON recibido
                        $movie = json_decode($response->getBody(), true);
                        // Asignamos las propiedades a variables
                        $poster_path = $movie['poster_path'];
                        $title = $movie['title'];
                        $anio_lanzamiento = $movie['release_date'];
                        $anio = date("Y", strtotime($anio_lanzamiento));
                        // Error encontrado en la pelicula Capitana Marvel que al tener en la descripción unas comillas simples el sistema cierra la inserción y se buguea.
                        $overview = mysqli_real_escape_string($conn, $movie['overview']);
                        $release_date = $movie['release_date'];
                        // imprimimos el poster
                        echo "<img src='https://image.tmdb.org/t/p/w500" . $poster_path . "' alt='" . $title . "' width='300'>";
                        echo "</a>";
                    } catch (RequestException $e) {
                        // Si ocurre un error en la solicitud, captura la excepción y muestra el mensaje de error
                        echo "Se produjo un error en la solicitud: " . $e->getMessage();
                    }
                    ?>
            </div>
            <div class="opinion_amigos">
                <?php
                echo "<h2>Reviews de</h2>";
                echo "<div class='titulo'>";
                echo "<h2 id='titulo'>$title</h2>";
                echo "<h2>($anio)</h2>";
                echo "</div>";

                ?>
                <div class="barra2"></div>
                <div class="nav">
                    <h2><a href="/todas.php?id=<?php echo $movieId ?>">Reviews recientes</a></h2>
                    <h2 id='nav'><a href="/PHP/Movie/Review/amigos.php?id=<?php echo $movieId ?>" style='color:#f39a3f; text-decoration: underline;'>Reviews de amigos</a></h2>
                </div>
                <div class="barra2"></div>
                <?php
                $sql = "SELECT  p.id as id_pelicula,r.nota,p.titulo,r.review,r.fecha,u.usuario,u.id  as id_usuario,u.fto_perfil FROM review r,pelicula p, usuario u,siguen s WHERE r.id_usuario = u.id AND r.id_pelicula = $movieId AND p.id = $movieId AND r.vermastarde = 0 AND r.id_usuario = s.id_sigue AND s.id_usuario = $_SESSION[idusuario]  ORDER BY r.id DESC ";
                $consult = mysqli_query($conn, $sql);
                $num_filas = mysqli_num_rows($consult);
                if (mysqli_num_rows($consult) > 0) {
                    for ($i = 0; $i < $num_filas; $i++) {
                        include __DIR__ . "/../../../PHP/REVIEWS.php";
                    }
                } else {
                    echo "<p>Vaya parece que no hay reviews</p>";
                }
                
                ?>
                
            </div>

        </div>
    </div>
</body>

</html>