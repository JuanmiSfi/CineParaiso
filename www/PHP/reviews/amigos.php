<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();


$pag = $_GET['pag'] ?? 1;
$idusuario = $_SESSION['idusuario'] ?? 0;
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
    <link rel="stylesheet" href="styles.css" />
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
        <div class="navegador">
            <p>Reviews de tus amigos</p>
        </div>
        <div class="barra2"></div>
        <div class="opinion">
            <?php
            if ($idusuario != 0) {
                $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_rew FROM review r, siguen s, pelicula p, usuario u WHERE u.id=s.id_sigue AND r.id_usuario = s.id_sigue AND s.id_usuario = $_SESSION[idusuario] AND p.id=r.id_pelicula AND r.vermastarde = 0");
                $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_rew'];
                $filasmax = 5;
                $sql = "SELECT p.poster,p.id as id_pelicula,u.id as id_usuario,r.nota,p.titulo,r.review,r.fecha,u.usuario,u.fto_perfil FROM review r, siguen s, pelicula p, usuario u WHERE u.id=s.id_sigue AND r.id_usuario = s.id_sigue AND s.id_usuario = $_SESSION[idusuario] AND p.id=r.id_pelicula AND r.vermastarde = 0 ORDER BY r.id DESC LIMIT " . (($pag - 1) * $filasmax)  . "," . $filasmax;
                $consult = mysqli_query($conn, $sql);
                $numerofilas = mysqli_num_rows($consult);
                if (mysqli_num_rows($consult) > 0) {
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
            ?>
            <div class="boton">
                <?php
                $filasmax = 5;

                // Calcular total de reviews
                $resultadoMaximo = mysqli_query($conn, "SELECT COUNT(*) as num_rew FROM review r, siguen s, pelicula p, usuario u WHERE u.id=s.id_sigue AND r.id_usuario = s.id_sigue AND s.id_usuario = $_SESSION[idusuario] AND p.id=r.id_pelicula AND r.vermastarde = 0");
                $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_rew'];

                // Calcular total de páginas
                $totalPaginas = ceil($maxusutabla / $filasmax);

                // Limitar $pag entre 1 y total de páginas
                echo "<div class='anterior'>";
                if (isset($_GET['pag'])) {
                    if ($_GET['pag'] > 1) {
                        echo "<a href='/PHP/reviews/amigos.php?id=$idusuario&pag=" . ($_GET['pag'] - 1) . "' class='todas' ><p>Anterior</p></a>";
                    } else {
                        echo "";
                    }
                }

                echo "</div>";
                echo "<div class='siguiente'>";
                if (isset($pag)) {
                    if ($pag < $totalPaginas) {
                        echo "<a href='/PHP/reviews/amigos.php?id=$idusuario&pag=" . ($pag + 1) . "' class='todas' ><p>Siguiente</p></a>";
                    } else {
                        echo "";
                    }
                } else {
                    echo "<a href='#' class='todas' ><p>Siguiente</p></a>";
                }

                echo "</div>";
                ?>
            </div>
        </div>
    </div>
</body>

</html>