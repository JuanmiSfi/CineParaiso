<?php 
include_once("conexion.php");
include_once("usuario.php");

$pagina = $_GET['pag'];
$usuario = $_GET['usuario'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuario WHERE usuario='$usuario'");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
	$id 	= $mostrar['id'];
    $nombre = $mostrar['nombre'];
    $apellidos = $mostrar['apellidos'];
    $usuario = $mostrar['usuario'];
    $email = $mostrar['email'];
    $fto_perfil = $mostrar['fto_perfil'];
}
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
        <img src="<?php echo $fto_perfil;?>" width= 100% class="foto_perfil">
        <table>
		<tr><th colspan="2">Ver usuario</th></tr>
            <tr> 
                <td>id: </td>
                <td><?php echo $id;?></td>
            </tr>
			   <tr> 
                <td>nombre: </td>
                <td><?php echo $nombre;?></td>
            </tr>
        
            <tr> 
                <td>apellidos: </td>
                <td><?php echo $apellidos;?></td>
            </tr>
			  <tr> 
                <td>usuario: </td>
                <td><?php echo $usuario;?></td>
            </tr>
			  <tr> 
                <td>Correo: </td>
                <td><?php echo $email;?></td>
            </tr>
            <tr> 
                <td>Contraseña: </td>
                <td><?php echo "Cambiar contraseña";?></td>
            </tr>
            <tr>
				
                <td colspan="2">
				 <?php echo "<a href=\"usuario.php?pag=$pagina\">Regresar</a>";?>
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>


	