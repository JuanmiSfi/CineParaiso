<?php
include_once("conexion.php");

$pagina = $_GET['pag'];
$usuario = $_GET['usuario'];

mysqli_query($conn, "DELETE FROM usuario WHERE usuario='$usuario'");

header("Location:usuario.php?pag=$pagina");

?>