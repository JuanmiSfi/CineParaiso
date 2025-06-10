<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$pagina = $_GET['pagina'] ?? 1;
$error = false;
$idusuario = $_SESSION['idusuario'] ?? 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['busqueda'] = $_POST['busqueda'];
    header("Location: consulta.php");
    exit();
}
$busqueda = $_SESSION['busqueda'];

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

try {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cine Paraiso</title>
        <link rel="stylesheet" href="/CSS/consulta.css" />

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
            <div class='usuarios'>
                <?php
                $sql = "SELECT * FROM usuario WHERE usuario like '%$busqueda%'";
                $resul = mysqli_query($conn, $sql);
                $numcolumnas = mysqli_num_rows($resul);
                if (mysqli_num_rows($resul) > 0) {
                    for ($i = 0; $i < $numcolumnas; $i++) {
                        $row = mysqli_fetch_assoc($resul);
                        $fto = $row['fto_perfil'];
                        $usuario = $row['usuario'];
                        $id_usuario = $row['id'];
                        if ($usuario == 'admin') {
                            break;
                        } else {
                            if ($i == 0) {
                                echo "<p>Se han encontrado usuarios relacionados con esta busqueda:</p>";
                                echo "<div class='usuario-busqueda'>";
                            }
                        }
                        echo "<div class='foto'>";
                        echo "<a href='/usuario.php?id=" . $id_usuario . "'>";
                        echo "<img src='$fto' alt='' />";
                        echo "<p>$usuario</p>";
                        echo "</div>";
                        echo "</a>";
                    }
                    echo "</div>";
                    if ($usuario != 'admin') {
                        echo "<div class='barra2'></div>";
                    }
                }
                ?>
            </div>
            <?php
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.themoviedb.org/3/search/movie?query=' . $busqueda . '&include_adult=false&language=es-ES&page=' . $pagina . '', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $API . '',
                    'accept' => 'application/json',
                ],
            ]);
            $pelis = json_decode($response->getBody(), true);

            usort($pelis['results'], function ($a, $b) {
                $a_score = $a['vote_count'] * $a['popularity'];
                $b_score = $b['vote_count'] * $b['popularity'];
                return $b_score <=> $a_score;
            });
            ?>
            <div class='peliculas'>
                <?php
                foreach ($pelis['results'] as $movie) {
                    // Asignamos las propiedades de la película a variables
                    $total_paginas = $pelis['total_pages'] ?? 1;
                    $movie_id = $movie['id'];
                    $movie_title = $movie['title'];
                    $titulo_formateado = str_replace(':', ':<br>', $movie_title);
                    $movie_poster_path = $movie['poster_path'];
                    // Mostrar el póster y el nombre de la película
                    echo "<a href='movie2.php?id=" . $movie_id . "'>";
                    echo "<p>$titulo_formateado</p>";
                    echo "<img src='https://image.tmdb.org/t/p/w500" . $movie_poster_path . "' alt='" . $movie_title . "' width='150' loading='lazy'><br>";
                    echo "</a>";
                } ?>
            </div>
        </div>
        <div class='paginacion'>
            <?php
            if (!isset($total_paginas)) {
                $total_paginas = 1;
            }
            $max_links = 2; // Cantidad de páginas antes y después de la actual a mostrar
            $start = max(1, $pagina - $max_links);
            $end = min($total_paginas, $pagina + $max_links);
            echo "<div class='boton'>";
            if ($pagina > 1) {
                echo "<p><a href='consulta.php?busqueda=$busqueda&pagina=" . ($pagina - 1) . "'>‹‹‹ Anterior</a></p>";
            }
            echo "</div>";

            if ($start > 1) {
                echo "<p>...</p>";
            }

            for ($i = $start; $i <= $end; $i++) {
                if ($i == $pagina) {
                    echo "<p><strong>$i</strong></p>";
                } else {
                    echo "<p><a href='consulta.php?busqueda=$busqueda&pagina=$i'>$i</a></p>";
                }
            }

            if ($end < $total_paginas) {
                echo "<p>...</p>";
            }
            echo "<div class='boton'>";
            if ($pagina < $total_paginas) {
                echo "<p><a href='consulta.php?busqueda=$busqueda&pagina=" . ($pagina + 1) . "'>Siguiente ›››</a></p>";
            }
            echo "</div>";
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