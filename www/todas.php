<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$idusuario = $_SESSION['idusuario']??0;
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
                <a href="movie2.php?id=<?php echo $movieId;?>">
                <?php
                require_once('vendor/autoload.php');

                use GuzzleHttp\Client;
                use GuzzleHttp\Exception\RequestException;

                // Verificamos que se haya pasado un id en la URL
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    echo "ID de película no proporcionado.";
                    exit;
                }
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

                // Como en nuestra base de datos no tenemos la pelicula almacenada lo primero que haremos será almacenarla 
                $sql = "SELECT * FROM pelicula WHERE id=$movieId";
                $consulta = (mysqli_query($conn, $sql));
                //Si la consulta devuelve 0 columnas insertamos la pelicula
                if (mysqli_num_rows($consulta) == 0) {
                    $sql = "INSERT INTO pelicula (id,titulo,año,descripcion,poster) values($movieId,'$title',$release_date,'$overview','$poster_path')";
                    $aniadir = (mysqli_query($conn, $sql));
                    if ($aniadir) {
                    } else {
                    }
                }
                ?>
            </div>
            <div class='review'>
            <?php
            echo "<div class='titulo'>";
            echo "<h2>$title</h2>";
            echo ""
            ?>
            <div class="barra2"></div>
                <?php
                $sql = "SELECT p.id,r.nota,p.titulo,r.review,r.fecha,u.usuario,u.id,u.fto_perfil FROM review r,pelicula p, usuario u WHERE r.id_usuario = u.id AND r.id_pelicula = $movieId AND p.id = $movieId AND r.vermastarde = 0 ORDER BY r.id DESC";
                $consult = mysqli_query($conn, $sql);
                $num_filas = mysqli_num_rows($consult);
                for ($i = 0; $i < $num_filas; $i++) {
                    $fila = mysqli_fetch_assoc($consult);
                    $movieId = $fila['id'];
                    $usuarioId = $fila['id'];
                    $usuario = $fila['usuario'];
                    $fto = $fila['fto_perfil'];
                    $nota = $fila['nota'];
                    $review = $fila['review'];
                    $fecha = $fila['fecha'];
                    if (!empty($review)) {
                        echo "<div class='opinion'>";
                        echo "<div class=info>";
                        echo "<a href='usuario.php?id=".$usuarioId."'>";
                        echo "<img src='$fto' alt='' />";
                        echo "</a>";
                        echo "<div class='user'>";
                        echo "<a href='usuario.php?id=".$usuarioId."'>";
                        echo "<h2>$usuario</h2>";
                        echo "</a>";
                        echo "<div class='estrellas'>";
                        for ($j = 1; $j <= 5; $j++) {
                            if ($nota >= $j) {
                                echo "<i class='fas fa-star' id='estrellas'></i>";
                            }
                        }
                        echo "<div class='fecha'>";
                        if (!empty($fecha)) {
                            $fechaconformato = date("d-m-Y", strtotime($fecha));
                            echo "<p>Visto el $fechaconformato</p>";
                        }
                        echo "</div>"; // cierra user
                        echo "</div>"; // Cierra fecha
                        echo "</div>"; // cierra info
                        echo "</div>"; // Cierra estrllas
                        echo "<p>$review</p>";
                        echo "</div>"; // Cierra opinion
                    }
                }
                ?>
            </div>
            <div class="opinion_amigos">
                <h2>Reviews de tus amigos</h2>
                <div class="barra2"></div>
            </div>
        </div>
    </div>
</body>

</html>