<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$idusuario = $_GET['id'] ? $_GET['id'] : $_SESSION['idusuario'];
$idusuario2 = $_GET['id'];


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

if (isset($_POST['cerrar'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Paraiso</title>
    <link rel="stylesheet" href="/CSS/usuario.css" />
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
                    if ($idusuario == $_SESSION['idusuario']) {
                        echo '
                <form action="" method="POST">
                        <label for="Boton" class="boton">
                            <button type="submit" name="cerrar">Cerrar sesión</button>
                        </label>';
                        echo "</form>";
                    } else {
                        $sql = "SELECT * FROM usuario WHERE id = $_SESSION[idusuario]";
                        echo "<a href='/usuario.php?id=" . $_SESSION['idusuario'] . "'>";
                        $resul = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($resul) > 0) {
                            $row = mysqli_fetch_assoc($resul);
                            $fto = $row['fto_perfil'];
                            echo "<img src='$fto' alt='' />";
                        }
                        echo "</a>";
                    }
                    ?>
                </a></div>
        </div>
        <div class="barra"></div>
    </header>

    <body>
        <div class="contenedor">
            <div class="info">
                <?php
                $sql = "SELECT u.*,e.* FROM usuario u, estadistica e WHERE u.id = $idusuario AND e.id_usuario = $idusuario";
                $resul = mysqli_query($conn, $sql);
                if (mysqli_num_rows($resul) > 0) {
                    $row = mysqli_fetch_assoc($resul);
                    $idusuario = $row['id'];
                    $usuario = $row['usuario'];
                    $nombre = $row['nombre'];
                    $fto = $row['fto_perfil'];
                    $bio = $row['bio'];
                    $num_seguidores = $row['n_seguidores'];
                    $num_pelis = $row['n_pelis_vistas'];
                    $num_siguiendo = $row['n_siguiendo'];
                    echo "<img src='$fto' alt='' id='fto'/>";
                    echo "<h3>$usuario</h3>";
                    echo "<p>$nombre</p>";
                    echo "<div class='bio'><p>$bio</p></div>";
                }
                ?>

            </div>
            <div class="actividad">
                <div class=nav1>
                    <?php
                    if ($idusuario == $_SESSION['idusuario']) {
                        echo "<button type='submit' class='modifi'><a href='modificar.php' class='link'>Modificar usuario</a></button>";
                    } else {
                        $sql = "SELECT COUNT(*) FROM siguen WHERE $idusuario=id_usuario AND $idusuario2=id_seguidor";
                        $resul = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($resul) > 0) {
                            echo "<button type='submit' class='follow'><a href='' class='link'>Seguir</a></button>";
                        } else {
                            echo "<button type='submit' class='follow'><a href='' class='link'>Siguiendo</a></button>";
                        }
                    }
                    echo "<div class='n_pelis'>";
                    echo "<h3>$num_pelis</h3>";
                    echo "<p>Peliculas vistas </p>";
                    echo "</div>";

                    echo "<div class='n_seguidores'>";
                    echo "<h3>$num_seguidores</h3>";
                    echo "<p>Seguidores</p> ";
                    echo "</div>";

                    echo "<div class='n_siguiendo'>";
                    echo "<h3>$num_siguiendo</h3>";
                    echo "<p>Siguiendo</p> ";
                    echo "</div>";
                    ?>
                </div>
                <div class="barra2"></div>
                <div class="navegador">
                    <button type="submit" class="WatchList"><a href="historial.php" class="link">Peliculas</a></button>
                    <button type="submit" class="WatchList"><a href="watchlist.php" class="link">WatchList</a></button>
                </div>
                <div class="ultima5">
                    <p><b>Actividad reciente</b></p>
                    <div class="bloque">

                        <?php
                        //Hacemos una consulta para el poster de las 5 ultimas pelicula
                        $sql = "SELECT p.poster, r.nota FROM review r,pelicula p WHERE r.id_usuario = $idusuario  AND r.id_pelicula = p.id AND r.vermastarde = 0 ORDER BY r.fecha DESC";
                        $consult = mysqli_query($conn, $sql);
                        $num_filas = mysqli_num_rows($consult);
                        if ($num_filas >= 5) {
                            for ($i = 0; $i < 5; $i++) {
                                echo '<div class="Poster">';
                                $fila = mysqli_fetch_assoc($consult);
                                $nota = $fila['nota'];
                                $poster = $fila['poster'];
                                echo "<img src='https://image.tmdb.org/t/p/w500" . $poster . "' width='300'>";
                                if (isset($nota)) {
                                    echo "<div class='nota'>";
                                    for ($j = 1; $j <= 5; $j++) {
                                        if ($nota >= $j) {
                                            echo "<i class='fas fa-star' id='estrellas'></i>";
                                        }
                                    }
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        } else {
                            for ($i = 0; $i < $num_filas; $i++) {
                                echo '<div class="Poster">';
                                $fila = mysqli_fetch_assoc($consult);
                                $nota = $fila['nota'];
                                $poster = $fila['poster'];
                                echo "<img src='https://image.tmdb.org/t/p/w500" . $poster . "' width='300'>";
                                if (isset($nota)) {
                                    echo "<div class='nota'>";
                                    for ($j = 1; $j <= 5; $j++) {
                                        if ($nota >= $j) {
                                            echo "<i class='fas fa-star' id='estrellas'></i>";
                                        }
                                    }
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="opion">
                    <?php
                    $sql = "SELECT * FROM review WHERE id_usuario = $idusuario AND vermastarde = 0 ORDER BY fecha DESC";
                    $resul = mysqli_query($conn, $sql);
                    $num_filas2 = mysqli_num_rows($resul);

                    ?>
                    <p>Ultimas reviews</p>
                    <div class="barra2"></div>
                    <?php
                    $sql = "SELECT p.poster,p.id,r.nota,p.titulo,r.review,r.fecha FROM review r,pelicula p WHERE r.id_usuario = $idusuario  AND r.id_pelicula = p.id AND r.vermastarde = 0 ORDER BY r.id DESC";
                    $consult = mysqli_query($conn, $sql);
                    $numerofilas = mysqli_num_rows($consult);
                    if ($num_filas >= 4) {
                        for ($i = 0; $i < 4; $i++) {
                            $fila = mysqli_fetch_assoc($consult);
                            $poster = $fila['poster'];
                            $titulo = $fila['titulo'];
                            $movieId = $fila['id'];
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
                                echo "<div class='estrellas'>";
                                for ($j = 1; $j <= 5; $j++) {
                                    if ($nota >= $j) {
                                        echo "<i class='fas fa-star' id='estrellas'></i>";
                                    }
                                }
                                echo "<div class='fecha'>";
                                if (!empty($fecha)) {
                                    echo "Visto el $fecha";
                                }
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
                            $titulo = $fila['titulo'];
                            $movieId = $fila['id'];
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
                                echo "<div class='estrellas'>";
                                for ($j = 1; $j <= 5; $j++) {
                                    if ($nota >= $j) {
                                        echo "<i class='fas fa-star' id='estrellas'></i>";
                                    }
                                }
                                echo "<div class='fecha'>";
                                if (!empty($fecha)) {
                                    echo "Visto el $fecha";
                                }
                                echo "</div>"; // Cierra fecha
                                echo "</div>"; // Cierra estrllas
                                echo "<p>$review</p>";
                                echo "</div>"; // Cierra contenido
                                echo "</div>"; //Cierra review
                            }
                        }
                    }
                    ?>
                    <button type="submit" class="WatchList"><a href="/historial/Reviews.php" class="link">Ver mas reviews</a></button>
                </div>
            </div>
        </div>
    </body>


</body>

</html>