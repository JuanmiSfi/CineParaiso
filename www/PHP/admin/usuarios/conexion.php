<?php

$host 	= 'db';
$nom 	= 'admin';
$pass 	= 'AlumnadoIAW';
$db 	= 'CineParaiso';

$conn = mysqli_connect($host, $nom, $pass, $db);

if (!$conn) 
{
  die("Error en la conexión: " . mysqli_connect_error());
}	
?>