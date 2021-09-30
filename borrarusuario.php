<?php
include ("conexion.php");
if (isset($_GET['id'])){//verifica que la variable id este definida 
	$id = $_GET['id'];
	$query = "DELETE FROM usuario WHERE id_usuario =$id";//borra dentro de la tabla afiliados el registro con el id que se haya seleccionado anteriormente 
	$result = mysqli_query($link,$query);
	if (!$result){
		die("fallo");
	}	
	header("Location: usuario.php");//si la consulta a sido ejecutada correctamente regresa a la pantalla de usuario
?>