<?php
include_once("conexion.php");

$idreview = $_GET['idreview'];

mysqli_query($conn, "DELETE FROM review WHERE id=$idreview");

header("Location:review.php");

?>