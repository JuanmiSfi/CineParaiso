<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();
$pagina = $_GET['pagina'] ?? 1;
$error = false;
$idusuario = $_SESSION['idusuario'] ?? 0;


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
    <title>CineParaiso</title>
    <link rel="stylesheet" href="/PHP/admin/usuarios/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo"><a href="/../index.php"><img src="/src/Logo.png" alt="logo"></a></div>
        </div>
        <div class="barra"></div>
    </header>
    <div class="volver">
        <a href="../../../admin.php"><i class="fa-solid fa-share fa-flip-horizontal"></i></a>
    </div>
    <div class="cont">
        <form method="POST">
            <h1>Lista de usuarios</h1>
            <div class='nav'>

                <a href="usuario.php">Inicio</a>

                <?php echo "<a href=\"agregar.php?pag=$pagina\">Crear usuario</a>"; ?>
                <div class="search-container">
                    <input type="text" name="txtbuscar" class="search-input" placeholder="Buscar...">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </div>
            </div>
        </form>
        <?php

        $filasmax = 5;

        if (isset($_GET['pag'])) {
            $pagina = $_GET['pag'];
        } else {
            $pagina = 1;
        }

        if (isset($_POST['txtbuscar'])) {
            $buscar = $_POST['txtbuscar'];

            $sqlusu = mysqli_query($conn, "SELECT * FROM usuario where usuario = '" . $buscar . "'");
            if (mysqli_num_rows($sqlusu) <= 0) {
                $sqlusu = mysqli_query($conn, "SELECT * FROM usuario where id = " . $buscar . "");
            }
        } else {
            $sqlusu = mysqli_query($conn, "SELECT * FROM usuario ORDER BY id ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
        }

        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuario");

        $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_usuarios'];

        ?>
        <table>
            <tr>
                <th></th>
                <th>ID</th>
                <th>nombre</th>
                <th>apellidos</th>
                <th>usuario</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>

            <?php

            while ($mostrar = mysqli_fetch_assoc($sqlusu)) {

                echo "<tr>";
                echo "<td><img src=" . $mostrar['fto_perfil'] . " width='35px'></td>";
                echo "<td>" . $mostrar['id'] . "</td>";
                echo "<td>" . $mostrar['nombre'] . "</td>";
                echo "<td>" . $mostrar['apellidos'] . "</td>";
                echo "<td>" . $mostrar['usuario'] . "</td>";
                echo "<td>" . $mostrar['email'] . "</td>";
                echo "<td style='width:24%'>
			<a href=\"ver.php?usuario=$mostrar[usuario]&pag=$pagina\">Ver</a> 
			<a href=\"editar.php?usuario=$mostrar[usuario]&pag=$pagina\">Modificar</a> 
			<a href=\"eliminar.php?usuario=$mostrar[usuario]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[usuario]?')\">Eliminar</a>
			</td>";
            }

            ?>
        </table>
        <div style='text-align:right'>
            <br>
            <?php echo "Total de usuarios: " . $maxusutabla; ?>
        </div>
    </div>
    <div style='text-align:right'>
        <br>
    </div>
    <div class='botones' style="text-align:center">
        <?php
        if (isset($_GET['pag'])) {
            if ($_GET['pag'] > 1) {
        ?>
                <a href="usuario.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
            <?php
            } else {
            ?>
                <a href="#" style="pointer-events: none">Anterior</a>
            <?php
            }
            ?>

        <?php
        } else {
        ?>
            <a href="#" style="pointer-events: none">Anterior</a>
            <?php
        }

        if (isset($_GET['pag'])) {
            if ((($pagina) * $filasmax) <= $maxusutabla) {
            ?>
                <a href="usuario.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
            <?php
            } else {
            ?>
                <a href="#" style="pointer-events: none">Siguiente</a>
            <?php
            }
            ?>
        <?php
        } else {
        ?>
            <a href="usuario.php?pag=2">Siguiente</a>
        <?php
        }

        ?>
    </div>

    </form>
    </div>
</body>

</html>