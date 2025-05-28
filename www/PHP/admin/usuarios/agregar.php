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
		<tr><th colspan="2" >Agregar usuario</th></tr>
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
                <td><input type="mail" name="email" value="" required></td>
            </tr>
            <tr> 
                <td>Contraseña</td>
                <td><input type="password" name="contraseña" value="" required></td>
            </tr>
            <tr> 	
               <td colspan="2" >
				  <?php echo "<a href=\"usuario.php?pag=$pagina\">Cancelar</a>";?>
				   <input type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este usuario');">
			</td>
            </tr>
        </table>
    </form>
 </div>
</body>
</html>
<?php

		if(isset($_POST['btnregistrar']))
{   
	$nombre 	= $_POST['nombre'];
	$apellidos 	= $_POST['apellido'];
    $usuario 	= $_POST['usuario'];
	$email 	= $_POST['email'];
    $password 	= $_POST['contraseña'];
    $PassCifrada = password_hash($password, PASSWORD_DEFAULT);

	$queryadd	= mysqli_query($conn, "INSERT INTO usuario(nombre, apellidos, usuario, email, contraseña) VALUES('$nombre','$apellidos','$usuario','$email','$PassCifrada')");
	
 	if(!$queryadd)
	{
		// echo "Error con el registro: ".mysqli_error($conn);
		 echo "<script>alert('DNI duplicado, intenta otra vez');</script>";
		 
	}else
	{
		echo "<script>window.location= 'usuario.php?pag=1' </script>";
	}
}
?>


