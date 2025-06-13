<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$pag = $_GET['pag'] ?? 1;
$idusuario = $_SESSION['idusuario'] ?? 0;
$noreview = false;

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
    <link rel="stylesheet" href="styles.css" />
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
                <h1>Contactanos</h1>
                <p>Escribenos tu petición y nosotros nos pondremos en coctacto contigo</p>
            </div>
            <div class="content">
                <form action="" method="POST">
                <div class="form-row">
                    <input type="text" name="first_name" placeholder="Nombre" required>
                    <input type="text" name="last_name" placeholder="Apellido" required>
                </div>

                <div class="form-row">
                    <input type="email" name="email" placeholder="Correo electronico" required>
                </div>

                <div class="select">
                    <select name="pets" id="pet-select">
                        <option value=""><p>Por favor escoja una opción</p></option>
                        <option value="Eliminar cuenta">Eliminar Cuenta</option>
                        <option value="Recuperar cuenta">Recuperar Cuenta</option>
                        <option value="Otra consulta">Otra consulta</option>
                    </select>
                </div>

                <textarea name="message" rows="5" placeholder="Mensaje" required></textarea>

                <button type="submit" class="boton">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php include(__DIR__ . "/../PHP/footer.php"); ?>
</body>

</html>