<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

$noreview = false;
$idusuario = $_SESSION['idusuario'] ?? 0;
$id_rol = $_SESSION['id_rol'] ?? 0;

if ($id_rol == 0 || $id_rol == 1) {
    http_response_code(404);
    include(__DIR__ . '/404.php'); 
    exit;
    
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
    <link rel="stylesheet" href="/PHP/admin/reviews/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="/index.php"><img src="/src/Logo.png" alt="logo"></a></div>
        </div>
        <div class="barra"></div>
    </header>
    <div class="volver">
        <a href="../../../admin.php"><i class="fa-solid fa-share fa-flip-horizontal"></i></a>
    </div>
    <div class='body'>
        <h2>Lista de Reviews</h2>
        <div class='poster'>
            <div class='reviews'>
                <div class='opinion'>
                    <?php
                    $sql = "SELECT p.poster,p.id,r.nota,p.titulo,r.id as id_review,r.review,r.fecha,u.usuario,r.id_usuario FROM review r,pelicula p,usuario u WHERE r.id_usuario = u.id AND r.id_pelicula = p.id AND r.vermastarde = 0 ORDER BY r.id DESC";
                    $consult = mysqli_query($conn, $sql);
                    $numerofilas = mysqli_num_rows($consult);
                    if ($numerofilas > 0) {
                        for ($i = 0; $i < $numerofilas; $i++) {
                            $fila = mysqli_fetch_assoc($consult);
                            $idreview = $fila['id_review'];
                            $idusuario = $fila['id_usuario'];
                            $poster = $fila['poster'];
                            $titulo = $fila['titulo'];
                            $usuario = $fila['usuario'];
                            $movieId = $fila['id'];
                            $nota = $fila['nota'];
                            $review = $fila['review'];
                            $fecha = $fila['fecha'];
                            if (!empty($review)) {
                                echo "<div class='review'>";
                                echo "<img src='https://image.tmdb.org/t/p/w500" . $poster . "' width='300'>";
                                echo "<div class='contenido'>";
                                echo "<h2>$titulo</h2>";
                                echo "<div class='estrellas'>";
                                echo "Review por el usuario: ";
                                echo "<b>$usuario</b>";
                                echo "<div class='fecha'>";
                                if (!empty($fecha)) {
                                    echo "Visto el $fecha";
                                }
                                echo "</div>"; // Cierra fecha
                                echo "</div>"; // Cierra estrllas
                                echo "<p>$review</p>";
                                echo "</div>"; // Cierra contenido
                                echo "<div class='botones'>";
                                echo "
			                    <a href=\"/../historial/Reviews.php?id=$idusuario\">Ver más reviews de $usuario</a> 
			                    <a href=\"eliminar.php?idreview=$idreview\" onClick=\"return confirm('¿Estás seguro de eliminar a la review de $fila[titulo], del usuario $usuario?')\">Eliminar</a>
			                        ";
                                echo "</div>"; //cierra botones
                                echo "</div>"; //Cierra review
                            }
                        }
                    } else {
                        $noreview = true;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class='sin-review'>
            <?php
            if ($noreview == true) {
                echo '<img src="/Perfil_usuario/ChatGPT_Image_29_mar_2025__21_36_56-removebg-preview.png">';
                echo "<p>¡Vaya! Parece que aun no han realizado ninguna review</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>