<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$noreview = false;
$idusuario = $_GET['id'] ? $_GET['id'] : $_SESSION['idusuario'];
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
    <link rel="stylesheet" href="/CSS/historial/review.css" />
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
            <?php
            $sql = "SELECT usuario ,fto_perfil FROM usuario WHERE id = $idusuario";
            $consult = mysqli_query($conn, $sql);
            $solu = mysqli_fetch_assoc($consult);
            $usuario = $solu['usuario'];
            $fto_perfil = $solu['fto_perfil'];
            echo "<a href='./usuario.php?id=" . $idusuario . "'>";
            echo "<img src='$fto_perfil' alt='' />";
            echo "</a>";
            echo "<p>Reviews de <a href='usuario.php?id=" . $idusuario . "'>&nbsp;$usuario</a></p>";
            ?>
            <button type="submit" class="WatchList"><a href="/historial.php?id=<?php echo $idusuario; ?>" class="link">Peliculas</a></button>
            <button type="submit" class="WatchList"><a href="/historial/Reviews.php?id=<?php echo $idusuario; ?>" class="link">Reviews</a></button>
            <button type="submit" class="WatchList"><a href="/historial/Diario.php?id=<?php echo $idusuario; ?>" class="link">Diario</a></button>
        </div>
        <div class="barra2"></div>
        <div class='poster'>
            <?php
            $sql = "SELECT p.poster,p.id,r.nota,p.titulo,r.review,r.fecha,u.usuario FROM review r,pelicula p,usuario u WHERE r.id_usuario = $idusuario AND r.id_usuario = u.id AND r.id_pelicula = p.id AND r.vermastarde = 0 ORDER BY r.id DESC";
            $consult = mysqli_query($conn, $sql);
            $numerofilas = mysqli_num_rows($consult);
            if ($numerofilas > 0) {
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
            } else {
                $noreview = true;
            }
            ?>
        </div>
        <div class='sin-review'>
            <?php
            if ($noreview == true) {
                echo '<img src="/Perfil_usuario/ChatGPT_Image_29_mar_2025__21_36_56-removebg-preview.png">';
                echo "<p>¡Vaya! Parece que $usuario no ha visto aun ninguna pelicula</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>