<?php 
include_once("conexion.php");
include_once("usuario.php");
$busqueda = $_GET['busqueda'] ?? null;

$pagina = $_GET['pag'];
$usuario = $_GET['usuario'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuario WHERE usuario='$usuario'");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
    $idusuario = $mostrar['id']; 
	$usunom 	= $mostrar['nombre'];
	$usuape 	= $mostrar['apellidos'];
    $usuario 	= $mostrar['usuario'];
    $pass = $mostrar['contraseña'];
	$email 	= $mostrar['email'];
    $BIO 	= $mostrar['bio'];
}

	
	if(isset($_POST['btnmodificar']))
{    
	$nombre = $_POST['nombre'];
	$apell = $_POST['apellido'];
	$user = $_POST['usuario'];
	$mail = $_POST['email'];
    if(isset($_POST['password'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }else{
        $password = $pass;
    }
	$bio = $_POST['bio'];
      
    $querymodificar = mysqli_query($conn, "UPDATE usuario SET nombre='$nombre',apellidos='$apell',usuario='$user',email='$mail', bio='$bio', contraseña = '$password' WHERE id = '$idusuario'");
	echo "<script>window.location= 'usuario.php?pag=$pagina' </script>";
    
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
        <table>
		<tr><th colspan="2">Modificar usuario</th></tr>
            <tr> 
                <td>Nombre</td>
                <td><input type="text" name="nombre" value="<?php echo $usunom;?>"></td>
            </tr>
			   <tr> 
                <td>Apellido</td>
                <td><input type="text" name="apellido" value="<?php echo $usuape;?>"></td>
            </tr>
        
            <tr> 
                <td>Nombre de Usuario</td>
                <td><input type="text" name="usuario" value="<?php echo $usuario;?>" required></td>
            </tr>
			  <tr> 
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email;?>"></td>
            </tr>
            <tr> 
                <td>Contraseña</td>
                <td><input type="text" name="password"></td>
            </tr>
			  <tr> 
                <td>Bio</td>
                <td><input type="text" name="bio" value="<?php echo $BIO;?>"></td>
            </tr>
            <tr>
				
                <td colspan="2">
				 <?php echo "<a href=\"usuario.php?pag=$pagina\">Cancelar</a>";?>
				<input type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este usuario?');">
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

