<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mensaje = 0;
$idusuario = $_SESSION['idusuario'] ?? 0;
$id_rol = $_SESSION['id_rol'] ?? 0;

if ($idusuario != 0) {
    header("Location: usuario.php?id=" . $idusuario . "");
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
<?php
if (isset($_POST['iniciar'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
    $resul = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resul) > 0) {
        $row = mysqli_fetch_assoc($resul);
        $idusuario = $row['id'];
        $passcifrada = $row['contraseña'];
        $id_rol = $row['id_rol'];
        $verificado = $row['verificado'];
        if ($verificado == 1) {
            if (password_verify($password, $passcifrada) && $id_rol == 1) {
                $_SESSION['idusuario'] = $idusuario;
                $_SESSION['id_rol'] = $id_rol;
                header("Location: usuario.php?id=" . $idusuario . "");
                exit();
            } else if (password_verify($password, $passcifrada) && $id_rol == 2) {
                $_SESSION['idusuario'] = $idusuario;
                $_SESSION['id_rol'] = $id_rol;
                header("Location: admin.php?id=" . $idusuario . "");
                exit();
            } else {
                $mensaje = 1;
            }
        }else{
            header("Location: /PHP/verificacion.php?usuario=".$usuario."");
                exit();
        }
    }else{
        $mensaje = 3;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Paraiso</title>
    <link rel="stylesheet" href="/CSS/login.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="index.php"><img src="/src/Logo.png" alt="logo"></a></div>
        </div>
        <div class="barra"></div>
    </header>

    <body>
        <div class="contenedor">
            <p>Inicia sesión</p>
            <div class="bloque">
                <div class="login">
                    <form action="" method="POST">
                        <label for="usuario">
                            <h2>Usuario:</h2>
                            <input type="text" name="usuario">
                        </label><br>
                        <label for="contraseña">
                            <h2>Contraseña</h2>
                            <input type="password" name="password">
                        </label><br>
                        <label for="Boton" class="boton">
                            <input type='hidden' name='id' value=''>
                            <button type='submit' name='iniciar'><span>Inicia sesión</span></button>
                        </label>
                        <label for="recuperar">
                            <a href="PHP/recuperar-password-email.php">Has olividado tu contraseña click aqui</a>
                        </label><br>
                        <label for="registro" id="registro">
                            <p>¿No tienes cuenta?,<a href="registro.php">registraté</a>
                        </label>
                    </form>
                </div>
                <?php
                if ($mensaje == 1) {
                    echo "<div class='error'><p style='margin: bottom 15px;'>El usuario o la contraseña no son correctos</p></div>";
                }else if($mensaje == 3){
                    echo "<p style='margin: bottom 15px; text-align: center; color:black;'>No se encuentra el usuario proporcionado, puedes regristrate desde <a href='registro.php'>aquí</a></p>";
                }
                ?>
            </div>
        </div>
    </body>
</body>

</html>