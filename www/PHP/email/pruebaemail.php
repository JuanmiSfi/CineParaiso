<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$idusuario = $_SESSION['idusuario'] ?? 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['busqueda'] = $_POST['busqueda'];
    header("Location: consulta.php");
    exit();
}
$actorId = $_GET['id'];

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
require_once('vendor/autoload.php');
$client = new \GuzzleHttp\Client();
?>

<?php

$response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=es-ES&page=1&sort_by=popularity.desc', [
  'headers' => [
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlODBmYjY4YzM2ZTExODRlZGRiYmY1MGEwNjQxMDcwZCIsIm5iZiI6MTc0NDEzNzM0NS43NTgwMDAxLCJzdWIiOiI2N2Y1NmM4MWVkZGVjMjhiMDNhZGUwMDEiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.TRT_T9QbIH1qJO2xLgccbI9V9e76U2lS-_D7rUs6yqA',
    'accept' => 'application/json',
  ],
]);

$movie = json_decode($response->getBody(), true);
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Vecifica tu cuenta de CineParaiso</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td>
        <table width="600" cellpadding="20" cellspacing="0">
          <tr>
            <td style="text-align: center; background-color:#f39a3f;">
              <img src="https://pruebacineparaiso.free.nf/src/Logo.png" alt="CineParaiso" style="height: 50px; margin: 10px; filter: drop-shadow(4px 5px 1px black);">
            </td>
          </tr>
          <tr>
            <td style= "background-color: #f7e5c6; ">
              <h2>Hola '.$usuario.', Este es tu resumen semanal</h2>
            
            </td>
          </tr>
          <tr>
            <td style= "background-color:rgb(249, 239, 223); ">
              <p style="text-align: center;">Basado en tus gustos nos gustaria recomendarte estas peliculas</p>
              <td>
                
              </td>
            </td>
          </tr>
          <tr>
            <td style= "background-color:rgb(249, 239, 223); ">
              <p style="text-align: center;">Estas son las peliculas populares entre tus amigos</p>
            
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>