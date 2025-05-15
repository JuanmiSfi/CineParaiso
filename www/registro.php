<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/vendor/autoload.php';

$mail = new PHPMailer(true); // true activa excepciones para manejo de errores
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);

$mensaje = 0;
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
// Obtener datos del formulario
if (isset($_POST['registrar'])) {
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if ($password == $password2 && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Ciframos la contraseña para mas seguridad
        $PassCifrada = password_hash($password, PASSWORD_DEFAULT);
        // Comprobamos que no exista ya un usuario con el mismo nombre en el sistema
        $sql = "SELECT * FROM usuario WHERE usuario like '$usuario'";
        $resul = mysqli_query($conn, $sql);
        if (mysqli_num_rows($resul) == 0) {
            // Insertar datos en la base de datos
            $sql = "INSERT INTO usuario (usuario,email,contraseña) values ('$usuario','$correo','$PassCifrada')";
            if (mysqli_query($conn, $sql)) {
                $mail->isSMTP();
                $mail->Host = 'postfix';        // Nombre del contenedor de Postfix en docker-compose
                $mail->Port = 25;               // Puerto SMTP sin cifrado
                $mail->SMTPAuth = false;        // No usamos autenticación interna, Postfix ya lo hace
                $mail->SMTPSecure = false;      // No usamos SSL/TLS en local (solo si el relay lo requiere)

                // Emisor del correo
                $mail->setFrom('sfijuanmifp@gmail.com', 'Tu Sitio Web');

                // Receptor
                $mail->addAddress($correo, 'Usuario');

                // Contenido del correo
                $mail->isHTML(true);                                  // Permite HTML en el cuerpo
                $mail->Subject = 'Bienvenido a CineParaíso';
                $mail->Body    = 'Gracias por registrarte. ¡Disfruta del cine!';

                // Enviar
                $mail->send();










                header("Location: login.php");
                exit();
            } else {
                echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
            }
        } else {
            $mensaje = 1;
        }
    } else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = -2;
    } else {
        $mensaje = -1;
    }
}
// Cerrar conexión 
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineparaiso</title>
    <link rel="stylesheet" href="/CSS/registro.css" />
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
            <p>Registrate</p>
            <div class="bloque">
                <div class="formulario">
                    <form action="" method="POST">
                        <label for="Correo">
                            <h2>Correo:</h2>
                            <input type="email" name="correo" required>
                        </label><br>
                        <label for="Usuario">
                            <h2>Nombre de usuario:</h2>
                            <input type="text" name="usuario">
                        </label><br>
                        <label for="Password">
                            <h2>Contraseña<br></h2>
                            <input type="password" name="password">
                        </label><br>
                        <label for="Password2">
                            <h2>Repite la Contraseña<br></h2>
                            <input type="password" name="password2">
                        </label><br>
                        <label for="Boton" class="boton">
                            <input type='hidden' name='id' value=''>
                            <button type='submit' name='registrar'><span>Registrame!</span></button>
                        </label>
                    </form>
                </div>
                <?php
                if ($mensaje == 1) {
                    echo "<div class='error'><p>El nombre de usuario escogido ya existe en el sistema</p></div>";
                } else if ($mensaje == -1) {
                    echo "<div class='error'><p>La contraseña introducida no coincide</p></div>";
                } else {
                    echo "<div class='error'><p>El correo introducido no es</p></div>";
                }
                ?>
            </div>
        </div>
    </body>
</body>

</html>