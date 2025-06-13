<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$error=-1;

$idusuario = $_SESSION['idusuario'];
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

// Obtiene los datos actuales del alumno
$sql = "SELECT * FROM usuario WHERE id = {$_SESSION["idusuario"]}";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nombre = $row['nombre'];
    $apellidos = $row['apellidos'];
    $usuario = $row['usuario'];
    $email = $row['email'];
    $bio = $row['bio'];
    $fto = $row['fto_perfil'];
}
?>
<?php
if (isset($_POST['modificar'])) {
    try{
        if (strlen($_POST['bio']) > 200) {
                throw new Exception("La biografía no puede tener más de 200 caracteres.");
            }
    $sql = "UPDATE usuario SET nombre = '$_POST[nombre]', apellidos = '$_POST[apellidos]', email = '$_POST[email]', bio = '$_POST[bio]' WHERE usuario = '$usuario'";
    if (mysqli_query($conn, $sql)) {
        header("Location: usuario.php?id=" . $idusuario . "");
        exit();
    } else {
        $error = 2;
        mysqli_close($conn);
    }
}catch (Exception $e){
    $error = 1;
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Paraiso</title>
    <link rel="stylesheet" href="/CSS/modificar.css" />
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
            <div class="bloque">
                <div class="formulario1">
                    <h1>Modificar tus credenciales de usuario</h1>
                    <?php echo "<img src='$fto' alt='' id='fto' />"; ?>
                    <form action="foto.php" method="POST" enctype="multipart/form-data">
                        <label for="fto_perfil">
                            <input type="file" name="foto" id="img">
                            <input type="submit" name="modificar" value="Subir imagen" id="boton-imagen" /><br>
                        </label>
                    </form>
                </div>
                <div class="formulario2">
                    <form action='' METHOD="POST" name="mod">
                        <label for="nombre">
                            <p>Nombre:</p>
                        </label>
                        <input type="text" name="nombre" value="<?php echo $nombre; ?> " /><br>
                        <label for="apellidos">
                            <p>apellidos:</p>
                        </label>
                        <input type="text" name="apellidos" value="<?php echo $apellidos; ?>" /><br>
                        <label for="Correo">
                            <p>Correo electronico:</p>
                        </label>
                        <input type="text" name="email" value="<?php echo $email ?>" /><br>
                        <label for="biografia">
                            <p>Biografia:</p>
                        </label>
                        <textarea name="bio" id="bio"><?php echo $bio; ?></textarea><br>
                        <?php
                        if($error == 1){
                            echo "<p style='color:#962508';>No se puede actualizar porque la biografia supera los 200 caracteres permitidos</p>";
                        }else if($error == 2){
                            echo "<p>No se puede actualizar el perfil, prueba mas tarde</p>";
                        }
                        ?>
                        <input type="submit" name="modificar" value="Modificar" id="boton" /><br>
                        <p><a href="PHP/recuperar-password.php">Cambiar contraseña</a></p>
                    </form>
                </div>
                <p><a href="usuario.php?id=<?php echo $idusuario ?>">click para salir sin hacer cambios.</a></p>
            </div>
        </div>
        </div>
    </body>
</body>

</html>