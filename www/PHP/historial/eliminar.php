<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$nom = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db = $_ENV['DB_NAME'];

$conn = mysqli_connect($host, $nom, $pass, $db);

$idreview = $_GET['idreview'];
$idusuario = $_GET['id'];
$pag = $_GET['pag'];

mysqli_query($conn, "DELETE FROM review WHERE id=$idreview");

header("Location:Reviews.php?id=$idusuario&pag=$pag");

?>