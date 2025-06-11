<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$actualizar =  false;
$movieId = $_GET['id'];
$idusuario = $_SESSION['idusuario'] ?? 0;
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
    <link rel="stylesheet" href="/CSS/movie2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        $sql = "SELECT * FROM usuario WHERE id = $idusuario";
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
        <div class="contendor">
            <div class="poster">
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
                    $poster_path = $movie['poster_path'] ?? 0;
                    $title = mysqli_real_escape_string($conn, $movie['title']);
                    $overview = mysqli_real_escape_string($conn, $movie['overview']);
                    $idgenero = array_column($movie['genres'], 'id');
                    $popularidad = $movie['popularity'];
                    $release_date = $movie['release_date'] ?? '1111-11-11';
                    $anio = date("Y", strtotime($release_date));
                    // imprimimos el poster
                    echo "<img src='https://image.tmdb.org/t/p/w500" . $poster_path . "' alt='" . $title . "' width='300' loading='lazy'>";
                } catch (RequestException $e) {
                    // Si ocurre un error en la solicitud, captura la excepción y muestra el mensaje de error
                    echo "Se produjo un error en la solicitud: " . $e->getMessage();
                }

                // Como en nuestra base de datos no tenemos la pelicula almacenada lo primero que haremos será almacenarla 
                $sql = "SELECT * FROM pelicula WHERE id=$movieId";
                $consulta = (mysqli_query($conn, $sql));
                //Si la consulta devuelve 0 columnas insertamos la pelicula
                if (mysqli_num_rows($consulta) == 0) {
                    $sql = "INSERT INTO pelicula (id,titulo,año,popularidad,poster) values($movieId,'$title','$release_date',$popularidad,'$poster_path')";
                    mysqli_query($conn, $sql);
                    foreach ($idgenero as $genero) {
                        $sql_genero = "INSERT INTO pertenece (id_pelicula, id_genero) VALUES ($movieId, $genero)";
                        mysqli_query($conn, $sql_genero);
                    }
                }
                ?>
                <?php
                // Si el usuario tiene ya una review hecha de esta pelicula que se imprima
                if (isset($idusuario)) {
                    $sql = "SELECT nota,vermastarde,review from review where id_usuario=$idusuario AND id_pelicula=$movieId";
                    $resul = (mysqli_query($conn, $sql));
                    $row = mysqli_fetch_assoc($resul);
                    if (isset($row['review'])) {
                        $review = $row['review'];
                    } else {
                        $review = ' ';
                    }
                    $nota = $row['nota'] ?? -1;
                    $vermastarde = $row['vermastarde'] ?? -1;
                } else {
                    $nota = -1;
                    $vermastarde = -1;
                }
                ?>
                <form action='' METHOD="POST" name="mod">
                    <div class="ver">
                        <button type="submit" name="estado" value="visto" id="ojo"><i class="fa-regular fa-eye" <?php if ($vermastarde == 0) echo "style='color: rgb(85, 36, 19)'"; ?>></i></button>
                        <button type="submit" name="estado" value="ver_mas_tarde" id="reloj"><i class="fa-regular fa-clock" <?php if ($vermastarde == 1) echo "style='color: rgb(85, 36, 19)'"; ?>></i></button>
                    </div>
                    <div class="clasificacion">
                        <input type="radio" name="puntuacion" id="radio5" value="5" id="estrella5" <?php if ($nota == 5) echo 'checked'; ?>>
                        <input type="radio" name="puntuacion" id="radio4" value="4" id="estrella4" <?php if ($nota == 4) echo 'checked'; ?>>
                        <input type="radio" name="puntuacion" id="radio3" value="3" id="estrella3" <?php if ($nota == 3) echo 'checked'; ?>>
                        <input type="radio" name="puntuacion" id="radio2" value="2" id="estrella2" <?php if ($nota == 2) echo 'checked'; ?>>
                        <input type="radio" name="puntuacion" id="radio1" value="1" id="estrella1" <?php if ($nota == 1) echo 'checked'; ?>>
                    </div>
            </div>
            <div class="info">
                <?php
                echo "<div class='titulo'>";
                echo "<h2 id='titulo'>$title</h2>";
                echo "</div>";
                echo "<h2>disponible en:</h2>";

                ?>
                <?php
                require_once('vendor/autoload.php');

                $client = new \GuzzleHttp\Client();

                $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/' . $movieId . '/watch/providers', [
                    'headers' => [
                        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlODBmYjY4YzM2ZTExODRlZGRiYmY1MGEwNjQxMDcwZCIsIm5iZiI6MTc0NDEzNzM0NS43NTgwMDAxLCJzdWIiOiI2N2Y1NmM4MWVkZGVjMjhiMDNhZGUwMDEiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.TRT_T9QbIH1qJO2xLgccbI9V9e76U2lS-_D7rUs6yqA', // ⚠️ reemplaza con tu token si es necesario
                        'accept' => 'application/json',
                    ],
                ]);

                $info = json_decode($response->getBody(), true);
                $pais = 'ES';
                // Como puede ser que una pelicula no este en servicios de streaming o no se encuentre disponible para comprar usamos ?? que es el operador de fusión nula en PHP y le damos el valor vacio
                $region = $info['results'][$pais] ?? [];
                $logo = $region['flatrate'] ?? [];
                $streaming = $region['flatrate'] ?? [];
                $comprar = $region['buy'] ?? [];
                if ($info != 0) {
                ?>
                <?php
                    if ($info != 0) {

                        echo "<div class='plataformas'>";

                        if (!empty($streaming)) {
                            $i = 0;
                            echo "<div class='box1'>";
                            foreach ($logo as $proveedor) {
                                $plataforma = $proveedor['logo_path'];
                                $nombreProveedor = strtolower($proveedor['provider_name']);

                                $urlsStreaming = [
                                    'netflix'               => 'https://www.netflix.com/',
                                    'netflix standard with ads' => 'https://www.netflix.com/',
                                    'amazon prime video'    => 'https://www.primevideo.com/',
                                    'max originals amazon channel' => 'https://www.primevideo.com/',
                                    'disney plus'           => 'https://www.disneyplus.com/',
                                    'hbo max'               => 'https://www.max.com/',
                                    'apple tv+'              => 'https://tv.apple.com/',
                                    'movistar plus+'             => 'https://ver.movistarplus.es/',
                                    'movistar plus+ ficción total'             => 'https://ver.movistarplus.es/',
                                    'skyshowtime' => 'https://www.skyshowtime.com/es',
                                    'filmin'                => 'https://www.filmin.es/',
                                    'max' => 'https://www.max.com/es',
                                    'tivify' => 'https://www.tivify.es/',
                                    'rakuten tv'            => 'https://rakuten.tv/es',
                                    'atresplayer premium'   => 'https://www.atresplayer.com/premium/',
                                    'paramount plus'        => 'https://www.paramountplus.com/',
                                    'starzplay'             => 'https://www.starzplay.es/',
                                    'discovery plus'        => 'https://www.discoveryplus.es/',
                                    'crunchyroll'           => 'https://www.crunchyroll.com/es',
                                    'mubi'                  => 'https://mubi.com/es',
                                ];

                                $urlDestino = $urlsStreaming[$nombreProveedor] ?? '';

                                echo '<a href="' . $urlDestino . '" target="_blank" rel="noopener noreferrer">';
                                echo '<img src="https://image.tmdb.org/t/p/original' . $plataforma . '" loading="lazy">';
                                echo '</a>';
                            }
                            echo "</div>"; // Cerrar box1
                        } else if (!empty($comprar)) {
                            echo "<div class='box2'>";
                            echo "<ul>";
                            foreach ($region['buy'] as $proveedor) {
                                echo "<li>{$proveedor['provider_name']}</li>";
                            }
                            echo "</ul>";
                            echo "</div>"; // Cerrar box2
                        } else {
                            echo "<p id='solocine'>No se encuentra disponible en Streaming</p>";
                        }

                        echo "</div>"; // Cerrar plataformas
                    }
                }
                ?>
                <div class="Review">
                    <div class="formulario2">
                        <h2>Review</h2>

                        <textarea name="review" id="review"></textarea>
                        <label for="boton" class="boton">
                            <button type='submit' name='subir'>Subir!</button>
                        </label>
                        </form>

                        <?php
                        // Para que no se repitan las review y tener control de ellas por si es una inserción o una actualización comprobaremos si en nuestra base de datos ya hay datos de ese usuario con esa pelicula
                        $sql = "SELECT * FROM review WHERE id_usuario='$idusuario' AND id_pelicula = '$movieId'";
                        $consulta = (mysqli_query($conn, $sql));
                        if (mysqli_num_rows($consulta) == 0) {
                            if (isset($_POST['subir'])) {
                                if (!empty($idusuario)) {
                                    if (isset($_POST['estado']) != 'visto') {
                                        $nota = isset($_POST['puntuacion']) ? $_POST['puntuacion'] : 'NULL';
                                        $sql = "INSERT INTO review (review,nota,vermastarde,fecha,id_pelicula,id_usuario) values ('$_POST[review]',$nota,0,CURRENT_TIMESTAMP,$movieId,$idusuario)";
                                        $existe = mysqli_query($conn, $sql);
                                        if ($existe) {
                                            echo "<p>Has sido registrado correctamente</p>";
                                        } else {
                                            echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
                                        }
                                    } else {
                                        $nota = isset($_POST['puntuacion']) ? $_POST['puntuacion'] : 'NULL';
                                        $sql = "INSERT INTO review (review,nota,vermastarde,fecha,id_pelicula,id_usuario) values ('$_POST[review]',$nota,0,CURRENT_TIMESTAMP,$movieId,$idusuario)";
                                        $existe = mysqli_query($conn, $sql);
                                        if ($existe) {
                                            echo "<p>Has sido registrado correctamente</p>";
                                        } else {
                                            echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
                                        }
                                    }
                                } else {
                                    echo "<p>Debes estar registrado para poder hacer una review</p>";
                                }
                            }
                            if (isset($_POST['estado'])) {
                                if (!empty($idusuario)) {
                                    if ($_POST['estado'] == 'visto') {
                                        $sql = "INSERT INTO review (vermastarde,id_pelicula,id_usuario) values(0,$movieId,$idusuario)";
                                        $existe = mysqli_query($conn, $sql);
                                        if ($existe) {
                                            $actualizar = true;
                                        }
                                    } else {
                                        $sql = "INSERT INTO review (vermastarde,id_pelicula,id_usuario) values(1,$movieId,$idusuario)";
                                        $existe = mysqli_query($conn, $sql);
                                        if ($existe) {
                                            $actualizar = true;
                                        }
                                    }
                                } else {
                                    echo "<p>Debes estar registrado para poder hacer una review</p>";
                                }
                            }
                        } else {
                            $row = mysqli_fetch_assoc($consulta);
                            $idreview = $row['id'];
                            $vermastarde = $row['vermastarde'];
                            if (isset($_POST['subir'])) {
                                // Si no tiene valor puntuacion, es decir no se ha selecionado ninguna estrella se establecerá por defecto null, esto funciona gracias a ? que es como un if pero en comprimido
                                $nota = isset($_POST['puntuacion']) ? $_POST['puntuacion'] : 'NULL';
                                if (!empty($_POST['review'])) {
                                    $sql = "UPDATE review set review = '$_POST[review]',nota = $nota, vermastarde = 0, fecha = CURRENT_TIMESTAMP WHERE id=$idreview";
                                } else {
                                    $sql = "UPDATE review set nota = $nota, vermastarde = 0, fecha = CURRENT_TIMESTAMP WHERE id=$idreview";
                                }
                                $existe = mysqli_query($conn, $sql);
                                if ($existe) {
                                    echo "<p>Tu review se ha publicado correctamente</p>";
                                } else {
                                    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
                                }
                            }
                            if (isset($_POST['estado'])) {
                                if ($_POST['estado'] == 'visto') {
                                    $sql = "UPDATE review set vermastarde = 0 WHERE id=$idreview";
                                    $existe = mysqli_query($conn, $sql);
                                    if ($existe) {
                                        $actualizar = true;
                                    }
                                } else {
                                    $sql = "UPDATE review set vermastarde = 1 , nota = NULL , review = NULL, fecha = NULL WHERE id=$idreview";
                                    $existe = mysqli_query($conn, $sql);
                                    if ($existe) {
                                        $actualizar = true;
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="reviews">
                    <?php
                    $sql = "SELECT  p.id as id_pelicula,r.nota,p.titulo,r.review,r.fecha,u.usuario,u.fto_perfil FROM review r,pelicula p, usuario u WHERE p.id = $movieId AND r.id_pelicula = p.id AND r.id_usuario = $idusuario AND $idusuario = u.id";
                    $consult = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($consult) > 0) {
                        $fila = mysqli_fetch_assoc($consult);
                        $movieId = $fila['id_pelicula'];
                        $usuario = $fila['usuario'];
                        $fto = $fila['fto_perfil'];
                        $nota = $fila['nota'];
                        $review = $fila['review'];
                        $fecha = $fila['fecha'];
                        if (!empty($review)) {
                            echo "<h2>Tu review sobre esta pélicula</h2>";
                            echo '<div class="barra2"></div>';
                            echo "<div class='opinion'>";
                            echo "<div class=info>";
                            echo "<img src='$fto' alt='' />";
                            echo "<div class='user'>";
                            echo "<h2>$usuario</h2>";
                            echo "<div class='estrellas'>";
                            for ($j = 1; $j <= 5; $j++) {
                                if ($nota >= $j) {
                                    echo "<i class='fas fa-star' id='estrellas'></i>";
                                }
                            }
                            echo "<div class='fecha'>";
                            if (!empty($fecha)) {
                                $fechaconformato = date("d-m-Y", strtotime($fecha));
                                echo "Visto el $fechaconformato";
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
                    <h2>Ultimas Reviews</h2>
                    <div class="barra2"></div>
                    <?php
                    if ($idusuario != 0) {
                        $sql = "SELECT  p.id as id_pelicula,r.nota,p.titulo,r.review,r.fecha,u.usuario,u.id  as id_usuario,u.fto_perfil FROM review r,pelicula p, usuario u WHERE r.id_pelicula = p.id AND r.id_usuario = u.id AND p.id = $movieId  ORDER BY r.id DESC";
                        $consult = mysqli_query($conn, $sql);
                        $num_filas = mysqli_num_rows($consult);
                        if ($num_filas >= 3) {
                            for ($i = 0; $i < 3; $i++) {
                                include __DIR__ . "/PHP/REVIEWS.php";
                            }
                            echo '<a href="todas.php?id=' . $movieId . '" class="todas"><p>Ver todas las Reviews</p></a>';
                        } else {
                            for ($i = 0; $i < $num_filas; $i++) {
                                include __DIR__ . "/PHP/REVIEWS.php";
                            }
                            echo "<a href='todas.php?id=" . $movieId . "' class='todas'><p>Ver todas las Reviews</p></a>";
                        }
                    ?>

                        <h2>Reviews de tus amigos</h2>
                        <div class="barra2"></div>
                    <?php
                        $sql = "SELECT p.id as id_pelicula,r.nota,p.titulo,r.review,r.fecha,u.usuario,u.id  as id_usuario,u.fto_perfil FROM review r,pelicula p, usuario u,siguen s WHERE r.id_usuario = u.id AND r.id_pelicula = $movieId AND p.id = $movieId AND r.vermastarde = 0 AND r.id_usuario = s.id_sigue AND s.id_usuario = $_SESSION[idusuario]  ORDER BY r.id DESC";
                        $consult = mysqli_query($conn, $sql);
                        $num_filas = mysqli_num_rows($consult);
                        if ($num_filas >= 3) {
                            for ($i = 0; $i < 3; $i++) {
                                include __DIR__ . "/PHP/REVIEWS.php";
                            }
                            echo '<a href="todas.php?id=' . $movieId . '" class="todas"><p>Ver todas las Reviews</p></a>';
                        } else {
                            for ($i = 0; $i < $num_filas; $i++) {
                                include __DIR__ . "/PHP/REVIEWS.php";
                            }
                            echo "<a href='todas.php?id=" . $movieId . "' class='todas'><p>Ver todas las Reviews</p></a>";
                        }
                    }

                    ?>
                </div>
            </div>
            <div class='actores'>
                <div class='reparto'>
                    <h2>Reparto</h2>
                </div>
                <div class="barra2"></div>
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
                    if ($actores) {
                        $num_actores = count($actores);
                        if ($num_actores >= 4) {
                            for ($i = 0; $i < 4; $i++) {
                                $id_actor = $actores[$i]['id'];
                                $nombre = $actores[$i]['name'];
                                $personaje = $actores[$i]['character'];
                                $fto_actor = $actores[$i]['profile_path'];
                                echo "<div class='info-actor'>";
                                echo "<a href='actor.php?id=" . $id_actor . "'>";
                                echo '<img src="https://image.tmdb.org/t/p/w138_and_h175_face/' . $fto_actor . '" loading="lazy">';
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
                                echo '<img src="https://image.tmdb.org/t/p/w138_and_h175_face/' . $fto_actor . '" loading="lazy">';
                                echo "</a>";
                                echo "<div class='nombre-personaje'>";
                                echo "<p>$nombre</p>";
                                echo "<p>$personaje</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                    } else {
                        echo "<p>No se ha encontrado cast para esta pelicula</p>";
                    }
                    ?>
                </div>
                <a href='cast.php?id=<?php echo $movieId; ?>'>
                    <p>Reparto completo</p>
                </a>
            </div>
        </div>
    </div>
</body>

</html>