<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$pag = $_GET['pag'] ?? 1;
$idusuario = $_SESSION['idusuario'];
$noreview = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['busqueda'] = $_POST['busqueda'];
    header("Location: /consulta.php");
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
    <title>Sobre CineParaiso</title>
    <link rel="stylesheet" href="styles-about.css" />
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
                    if ($_SESSION['idusuario'] != 0) {
                        $sql = "SELECT * FROM usuario WHERE id = '$_SESSION[idusuario]'";
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
        <div class="contenido">
            <div class="hero">
                <h1>Bienvenido a Cineparaiso</h1>
                <p>Un espacio para cinéfilos hecho por cinéfilos.</p>
            </div>

            <div class="content">
                <h2>¿Qué es Cineparaiso?</h2>
                <p>
                    Cineparaiso es el rincón ideal para amantes del cine que quieren algo más que ver películas: quieren vivirlas, compartirlas y encontrarlas fácilmente.
                    Inspirado por la pasión cinéfila de plataformas como <i><a href="https://letterboxd.com">Letterboxd</a></i> y la practicidad de <a href="https://letterboxd.com"><i>JustWatch</i></a>, Cineparaiso combina lo mejor de ambos mundos.
                </p>

                <h2>¿Por qué usar Cineparaiso?</h2>
                <ul>
                    <li>
                        <p>📽️Lleva un registro de lo que ves y de lo que quieres ver.</p>
                    </li>
                    <li>
                        <p>🎞️Descubre qué plataforma tiene la película que buscas.</p>
                    </li>
                    <li>
                        <p>🍿Comparte tu amor por el cine con otros usuarios que lo entienden.</p>
                    </li>
                    <li>
                        <p>🌍Explora géneros, décadas, directores, países... y deja que el cine te sorprenda.</p>
                    </li>
                </ul>

                <h2>En construcción constante</h2>
                <p>
                    Cineparaiso es un proyecto independiente, en constante evolución. Escuchamos a nuestra comunidad y seguimos construyendo
                    nuevas funciones para enriquecer la experiencia. Esto es solo el principio.
                </p>

                <p><strong>Tu próxima película favorita está a solo unos clics.</strong></p>
                <a href="/registro.php" class="boton"><button>Únete ahora</button></a>
            </div>
        </div>
    </div>
    <?php include(__DIR__ . "/../PHP/footer.php"); ?>
</body>

</html>