<?php
include_once("conexion.php");
include_once("usuario.php");

$pagina = $_GET['pag'];
?>
<html>

<head>
    <title>VaidrollTeam</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POST">
            <table>
                <tr>
                    <th colspan="2">Agregar usuario</th>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="nombre" value=""></td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td><input type="text" name="apellido" value=""></td>
                </tr>

                <tr>
                    <td>Nombre de Usuario</td>
                    <td><input type="text" name="usuario" value="" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="" required></td>
                </tr>
                <tr>
                    <td>Contraseña</td>
                    <td><input type="password" name="contraseña" value="" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a href=\"usuario.php?pag=$pagina\">Cancelar</a>"; ?>
                        <input type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este usuario');">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
<?php

if (isset($_POST['btnregistrar'])) {
    $nombre     = $_POST['nombre'];
    $apellidos     = $_POST['apellido'];
    $usuario     = $_POST['usuario'];
    $email     = $_POST['email'];
    $password     = $_POST['contraseña'];
    $PassCifrada = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usuario WHERE usuario like '$usuario'";
    $resul = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resul) == 0) {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO usuario (usuario,email,contraseña) values ('$usuario','$email','$PassCifrada')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>window.location= 'usuario.php?pag=1' </script>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
        }
    }
}
?>
