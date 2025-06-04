<?php
session_start();
include_once("conexion.php");

$idusuario = $_SESSION['idusuario']??0;
$id_rol = $_SESSION['id_rol'] ?? 0;


if ($id_rol == 0 || $id_rol == 1) {
    header("Location: ../../../index.php");
    exit();
}

$pagina = $_GET['pag'];
$id = $_GET['id'];

if($idusuario == $id){
mysqli_query($conn, "DELETE FROM usuario WHERE id=$id");
session_destroy();
header("Location:/../../../index.php");
}else{
mysqli_query($conn, "DELETE FROM usuario WHERE id=$id");

header("Location:usuario.php?pag=$pagina");
}

?>