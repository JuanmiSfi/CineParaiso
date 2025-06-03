<?php
session_start();
require_once __DIR__ . '/..//../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..//../');
$dotenv->load();


$idusuario = $_GET['id'] ? $_GET['id'] : $_SESSION['idusuario'];
$noreview = false;
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
    <link rel="stylesheet" href="/PHP/usuario/seguidores.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="/../../index.php"><img src="/src/Logo.png" alt="logo"></a></div>
            <div class="buscador">
                <form action="/../../consulta.php" method="POST">
                    <input type="text" name="busqueda" placeholder="Buscar en Cine Paraiso"></input>
                </form>
            </div>
            <div class="usuario"><a href="/../../login.php">
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
                        echo "<img src='./Perfil_usuario/Usuarios.png' alt='' />";
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
            echo "<a href='/../../usuario.php?id=" . $idusuario . "'>";
            echo "<img src='/../../$fto_perfil' alt='' />";
            echo "</a>";
            echo "<p>Seguidores de <a href='/../../usuario.php?id=" . $idusuario . "'>&nbsp;$usuario</a></p>";
            ?>
            <button type="submit" class="Seguidores"><a href="/PHP/usuario/seguidores.php?id=<?php echo $idusuario; ?>" class="link">Seguidores</a></button>
            <button type="submit" class="Seguidores"><a href="/PHP/usuario/siguiendo.php?id=<?php echo $idusuario; ?>" class="link">siguiendo</a></button>
        </div>
        <div class="barra2"></div>
        <div class="contenedor-follow">
            <div class='follow'>
                <?php
                $sql = "SELECT u.usuario,u.fto_perfil,s.id_sigue,s.id_usuario FROM siguen s, usuario u WHERE $idusuario = s.id_sigue  AND id_usuario = u.id ";
                $consult = mysqli_query($conn, $sql);
                $numerofilas = mysqli_num_rows($consult);
                if ($numerofilas > 0) {
                    for ($i = 0; $i < $numerofilas; $i++) {
                        echo "<div class='followe'>";
                        $fila = mysqli_fetch_assoc($consult);
                        $idseguidor = $fila['id_usuario'];
                        $sigue = $fila['usuario'];
                        $fto = $fila['fto_perfil'];
                        echo "<div class='usuarios'>";
                        echo "<a href='/../../usuario.php?id=" . $idseguidor . "'>";
                        echo "<img src='/../../$fto' alt='' />";
                        echo "</div>"; //usuarios
                        echo "<div class='info'>";
                        echo "<p>$sigue</p>";
                        echo "</div>"; //info
                        echo "<div class='boton'>";
                        $sql = "SELECT COUNT(*) FROM siguen WHERE id_usuario=$idseguidor AND $_SESSION[idusuario]=id_sigue";
                        $resul = mysqli_query($conn, $sql);
                        $sigue = mysqli_fetch_row($resul);
                        if ($sigue[0] != 0) {
                            echo '<form action="/PHP/siguen.php" method="POST">';
                            echo "<input type='hidden' name='idusuario' value='" . $_SESSION['idusuario'] . "'>";
                            echo "<input type='hidden' name='idusuario2' value='" . $idseguidor . "'>";
                            echo "<input type='hidden' name='DIR' value='seguidores'>";
                            echo "<button type='submit' name='suprimir' class='suprimir'>Suprimir</button>";
                            echo '</form>';
                        }else if($sigue[0] == 0 && $idseguidor!=$_SESSION['idusuario']){
                            echo '<form action="/PHP/siguen.php" method="POST">';
                            echo "<input type='hidden' name='idusuario' value='" . $_SESSION['idusuario'] . "'>";
                            echo "<input type='hidden' name='idusuario2' value='" . $idseguidor . "'>";
                            echo "<input type='hidden' name='DIR' value='seguidores'>";
                            echo "<button type='submit' name='follow' class='seguir'>seguir</button>";
                            echo '</form>';
                        }
                        echo "</div>"; //boton
                        echo "</div>"; //followe
                    }
                } else {
                    $noreview = true;
                }
                ?>
                <div class='sin-review'>
                    <?php
                    if ($noreview == true) {
                        echo '<img src="/Perfil_usuario/ChatGPT_Image_29_mar_2025__21_36_56-removebg-preview.png">';
                        echo "<p>¡Vaya! Parece que $usuario no sigue a nadie</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>